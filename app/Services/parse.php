<?php
namespace App\Services;

use SimpleXMLElement;

ini_set('memory_limit','1024M');
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");

class Parse 
{
    public $cookie, $url, $turnUrl, $post, $get;
    public $txtUser, $txtPassword, $verify, $videoUrl, $pass, $videoRoomUrl;
    public $tvChannel, $channelSource, $channelK, $channelT, $channelLineDefault, $channelUseLineDefault;

    public function __construct() {
        // init 存放位置
        $this->ini = "loginInfo.ini";
        // cookie 存放位置
        $this->cookie = 'cookie.txt';
        // 網頁位置
        $this->mainUrl = 'ju999.net';
        // 帳號
        $this->txtUser = 'kb66183';
        // 密碼
        $this->txtPassword = 'QAZwsx888';
        // 暫時不改
        $this->pass = '10528813';
        // 使用預設線路
        $this->channelUseLineDefault = 1;
        // 台灣預設使用WS線路比較快
        $this->channelLineDefault = 'WS'; 
    }

      
    public function setIndex() 
    {
        $mtime = explode(' ', microtime());

        // 取得 index url
        $header = array(
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*;q=0.8',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Host:'.$this->mainUrl,
            'If-None-Match:"'.$mtime[1].'"',
            'Upgrade-Insecure-Requests:1',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
        );

        $url = 'http://'.$this->mainUrl;
        $content = $this->_curl($header, $url, 'get');
        $content = str_replace(array('\r\n', '\r', ' ', '\n'), '', $content);
        $pattern_all = '/window.location=".*?";/';
        preg_match_all($pattern_all, $content, $matchall);
        $this->turnUrl = str_replace(array('window.location', '=', '"', ';'), '', $matchall[0][0]);

        // 指向 index url
        $header = array(
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Host:'.$this->mainUrl,
            'Referer:http://'.$this->mainUrl.'/',
            'Upgrade-Insecure-Requests:1',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'
            );

        $url = 'http://'.$this->mainUrl.$this->turnUrl;
        $this->_curl($header, $url, 'get');

        return array('turnUrl' => $this->turnUrl);
    }


    public function login() 
    {
        $postData = array(
            'txtUser' => $this->txtUser,
            'txtPassword' => $this->txtPassword
        );
        // Login
        $header = array(
            'Accept:*',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Content-Length:'.strlen(http_build_query($postData)),
            'Content-Type:application/x-www-form-urlencoded; charset=UTF-8',
            'Host:'.$this->mainUrl,
            'Origin:'.'http://'.$this->mainUrl,
            'Referer:http://'.$this->mainUrl.$this->turnUrl,
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = 'http://'.$this->mainUrl.'/LoadData/Pd.ashx';
        $content = $this->_curl($header, $url, $this->post, $postData);
        $pattern_all = '/&verify=.*?&ismobile/';
        preg_match_all($pattern_all, $content, $matchall);
        $this->verify = str_replace(array('&verify=', '&ismobile'), '', $matchall[0][0]);

        return array('verify' => $this->verify);
    }

    public function getLine() 
    {
        $mtime = explode(' ', microtime());

        // 取得線路
        $header = array(
            'Accept:*',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Host:'.$this->mainUrl,
            'Referer:http://'.$this->mainUrl.'/Platform/LoginBallPlatform.aspx?isphone=0&&gamenum=3',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = 'http://'.$this->mainUrl.'/LoadData/AutoLines.ashx?type=7&isphone=0&verify=&user=&mobilekf=1&gamenum=3&_='.$mtime[1];
        $content = $this->_curl($header, $url, 'get');
        $json = json_decode($content, true);
        $rand = array_rand($json, 1);
        $this->channelUrl = $json[$rand];

        return array('channelUrl' => $this->channelUrl);
    }

    public function sso() 
    {
        $mtime = explode(' ', microtime());
        $host = parse_url($this->channelUrl);

        // SSO
        $header = array(
            'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*;q=0.8',
            'Accept-Encoding:gzip, deflate, br',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Host:'.$host['host'],
            'Referer:http://'.$this->mainUrl.'/Platform/LoginBallPlatform.aspx?isphone=0&&gamenum=3',
            'Upgrade-Insecure-Requests:1',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36'
        );
        $url = $host['scheme'].'://'.$host['host'].'/Page/Index/Pd.aspx?user='.strtoupper($this->txtUser).'&verify='.$this->verify.'&ismobile=False&gamenum=3&time='.date("Y-m-d"."%20"."H:i:s").'&isaccess=True&pass='.$this->pass.'&homeUrl=http://'.$this->mainUrl;
            $this->_curl($header, $url, 'get');

        // SSO Verify
        $header = array(
            'Accept:*',
            'Accept-Encoding:gzip, deflate, br',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Host:'.$host['host'],
            'Referer:'.$host['scheme'].'://'.$host['host'].'/Page/Index/Pd.aspx?user='.strtoupper($this->txtUser).'&verify='.$this->verify.'&ismobile=False&gamenum=3&time='.date("Y-m-d"."%20"."H:i:s").'&isaccess=True&pass='.$this->pass.'&homeUrl=http://'.$this->mainUrl,
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = $host['scheme'].'://'.$host['host'].'/Page/Index/Ashx/Pd.ashx?v='.$mtime[1].'&NewMobilePhone=&user='.strtoupper($this->txtUser).'&verify='.$this->verify.'&ismobile=False&cashagent=&gamenum=3&isaccess=True&pass='.$this->pass.'&hostUrl=&lang=&homeUrl=http%3A%2F%2F'.$this->mainUrl.'&purseUrl=&liveChannel=&liveTitle=&gameId=&ball=&ta=&tb=';
        $this->channelRoomUrl = $this->_curl($header, $url, 'get');
        $this->channelRoomUrl = str_replace('../', '', $this->channelRoomUrl);

        return array('channelRoomUrl' => $this->channelRoomUrl);
    }

    public function getChannelList() 
    {
        $return = '';
        $mtime = explode(' ', microtime());
        $host = parse_url($this->channelUrl);

        // 取得Channel列表
        $header = array(
            'Accept:application/json, text/javascript, *; q=0.01',
            'Accept-Encoding:gzip, deflate, br',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Content-Type:application/json; charset=utf8',
            'Host:'.$host['host'],
            'Referer:'.$host['scheme'].'://'.$host['host'].'/'.$this->channelRoomUrl,
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = $host['scheme'].'://'.$host['host'].'/Page/ProFile/Ashx/TS_MatchOnLive_Ajax.ashx?flash=true&v='.$mtime[1].'&type=ChatRoom';
        $channelList = $this->_curl($header, $url, 'get');
        $channelList = json_decode($channelList, true);

        // 寫入登入資訊至 ini
        $this->writeLoginInfo(array(
            'channelUrl' => $this->channelUrl,
            'channelRoomUrl' => $this->channelRoomUrl
        ));

        return array('channelList' => $channelList);            
    }

    public function noLogin() 
    {
        $data = $this->readLoginInfo();
        $this->channelUrl = $data['channelUrl'];
        $this->channelRoomUrl = $data['channelRoomUrl'];
        $this->channelUseLineDefault = 1;
    }

    public function getChannelXMLLink() 
    {
        $host = parse_url($this->channelUrl);

        // 取得播放連結XML檔案
        $header = array(
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:ShockwaveFlash/26.0.0.137'
        );

        $url = $host['scheme'].'://'.$host['host'].'/Page/ProFile/vido/req.txt';
        $content = $this->_curl($header, $url, 'get');
        $link = trim($content);
        $link = explode(',' , $link);
        $rand = array_rand($link, 1);
        $this->xmlUrl = $link[$rand];

        return array('xmlUrl' => $this->xmlUrl);
    }

    public function getChannelXML() 
    {
        $return = '';
        $host = parse_url($this->channelUrl);

        // 取得播放線路XML
        $header = array(
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:ShockwaveFlash/26.0.0.137'
        );

        $url = $this->xmlUrl;
        $content = $this->_curl($header, $url, 'get');

        $chkArray = array('D_Line', 'L_Line', 'H_Line', 'S_Line', 'T_Line', 'OTHER_Line');
        $link = $channelSource = array();
        $content = new SimpleXMLElement($content);
        $i = 0;
        foreach($content->children() as $tagName => $contents) 
        {
            if (in_array($tagName, $chkArray)) 
            {
                $link[$i]['type'] = (string) $contents->attributes()->type;
                $link[$i]['folder'] = (string) $contents->attributes()->folder;
                $link[$i]['link'] = array();
                
                foreach ($contents->children() as $linlValue) 
                {
                    //在台灣 WS => ws02 比較快
                    $key = (string) $linlValue->attributes()->T;
                    @$link[$i]['link'][$key] = (string) $linlValue[1];
                }
            }
            $i++;
        }

        $randKey = array_rand($link, 1);
        if ($this->channelUseLineDefault == 1) 
        {
            $randSubKey = $this->channelLineDefault;
        } 
        else 
        {
            $randSubKey = array_rand($link[$randKey]['link'], 1);
        }

        $channelSource['folder'] = $link[$randKey]['folder'];
        $channelSource['link']['key'] = $randSubKey;
        $channelSource['link']['url'] = $link[$randKey]['link'][$randSubKey];

        $this->channelSource = $channelSource;
        return array('channelSource' => $this->channelSource);
    }

    public function getChannelKT() 
    {
        $return = '';
        $mtime = explode(' ', microtime());
        $host = parse_url($this->channelUrl);

        // 取得Channel k & t
        $header = array(
            'Accept:application/json, text/javascript, */*; q=0.01',
            'Accept-Encoding:gzip, deflate',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Content-Type:application/json; charset=utf8',
            'Host:'.$host['host'],
            'Referer:'.$host['scheme'].'://'.$host['host'].'/PageMobile/ProFile/TS_PhoneLiveChat.aspx',
            // 'User-Agent:Mozilla/5.0 (Linux; U; Android 2.2; en-gb; GT-P1000 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = $host['scheme'].'://'.$host['host'].'/PageMobile/ProFile/Ashx/TS_PhoneLiveChat.ashx?v='.$mtime[1].'&op=encry&Chl='.$this->tvChannel.'&Cdn='.$this->channelSource['link']['key'];
        $content = $this->_curl($header, $url, 'get');
        $json = json_decode($content, true);
        $this->channelK = $json['s_CdnKey'];
        $this->channelT = $json['s_TimeStamp'];

        return array(
            'channelK' => $this->channelK,
            'channelT' => $this->channelT
        );
    }

    public function getChannelLink() 
    {
        $link = "http://".$this->channelSource['link']['url']."/".$this->channelSource['folder']."/".$this->tvChannel."/playlist.m3u8?k=".$this->channelK."&t=".$this->channelT;

        return array('link' => $link);
    }
    
    private function _curl($header, $url, $type, $postData = array()) 
    {
        $transferType = ($type == 'get') ? (0) : (1); // 需要用 get 或是 post
        $return = '';
        $resource = curl_init();
        curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
        curl_setopt($resource, CURLOPT_URL, $url);
        curl_setopt($resource, CURLOPT_POST, $transferType);
        curl_setopt($resource, CURLOPT_ENCODING, 1);

        if ($transferType == 1) 
        {
            curl_setopt($resource, CURLOPT_POSTFIELDS, http_build_query($postData));
        }

        curl_setopt($resource, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($resource, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($resource, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($resource, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($resource);

        if(curl_getinfo($resource, CURLINFO_HTTP_CODE) != '200' && curl_getinfo($resource, CURLINFO_HTTP_CODE) != '302' && curl_getinfo($resource, CURLINFO_HTTP_CODE) != '0') 
        {
            exit('CURLINFO_HTTP_CODE = '.(curl_getinfo($resource, CURLINFO_HTTP_CODE)));
        }

        curl_close($resource);

        return $return;
    }

    // 寫入 登入資訊 至 ini 擋
    private function buildIniText($array, $out="")
    {
        $t = "";
        $q = false;

        foreach($array as $c => $d) 
        {
            if(is_array($d))
            {
                $t.=array_to_ini($d,$c);
            } 
            else 
            {
                if($c===intval($c)) 
                {
                    if(!empty($out)) 
                    {
                        $t.="\r\n".$out." = \"".$d."\"";
                        if($q!=2)$q=true;
                    } 
                    else 
                    {
                        $t.="\r\n".$d;
                    }
                } 
                else 
                {    
                    $t.="\r\n".$c." = \"".$d."\"";
                    $q=2;
                }
            }
        }

        if($q!=true && !empty($out)) return "[".$out."]\r\n".$t;
        if(!empty($out)) return  $t;

        return trim($t);
    }

    private function writeLoginInfo($data)
    {
        $iniText = $this->buildIniText($data);
        $file = fopen($this->ini,"w");
        fwrite($file,$iniText);
        fclose($file);
    }

    private function readLoginInfo()
    {
        return parse_ini_file($this->ini);
    }
}
