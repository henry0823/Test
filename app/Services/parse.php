<?php
namespace App\Services;

ini_set('memory_limit','1024M');
date_default_timezone_set('Asia/Taipei');
header("Content-Type:text/html; charset=utf-8");

class Parse 
{
    public $cookie, $url, $turnUrl, $post, $get;
    public $txtUser, $txtPassword, $verify, $videoUrl, $pass, $videoRoomUrl;

    public function __construct($foo = null) 
    {
        $this->post = 1;
        $this->get = 0;
        // 暫時不改
        $this->pass = '10528813';
    }

      
    public function setIndex() 
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);

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
        $content = $this->_curl($header, $url, $this->get);
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
        $this->_curl($header, $url, $this->get);
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
    }

    public function getLine() 
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);

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
        $content = $this->_curl($header, $url, $this->get);
        $json = json_decode($content, true);
        $rand = rand(0, (@count($json)-1));
        $this->videoUrl = $json[$rand];
    }

    public function sso() 
    {
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $host = parse_url($this->videoUrl);

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
        $this->_curl($header, $url, $this->get);

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
        $this->videoRoomUrlecho = $this->_curl($header, $url, $this->get);
        $this->videoRoomUrlecho = str_replace('../', '', $this->videoRoomUrlecho);
    }

    public function getList() 
    {
        $return = '';
        $mtime = microtime();
        $mtime = explode(' ', $mtime);
        $host = parse_url($this->videoUrl);

        // 取得列表
        $header = array(
            'Accept:application/json, text/javascript, *; q=0.01',
            'Accept-Encoding:gzip, deflate, br',
            'Accept-Language:zh-TW,zh;q=0.8,en-US;q=0.6,en;q=0.4',
            'Connection:keep-alive',
            'Content-Type:application/json; charset=utf8',
            'Host:'.$host['host'],
            'Referer:'.$host['scheme'].'://'.$host['host'].'/'.$this->videoRoomUrlecho,
            'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36',
            'X-Requested-With:XMLHttpRequest'
        );

        $url = $host['scheme'].'://'.$host['host'].'/Page/ProFile/Ashx/TS_MatchOnLive_Ajax.ashx?flash=true&v='.$mtime[1].'&type=ChatRoom';
        $return = $this->_curl($header, $url, $this->get);
        return $return;
    }

    private function _curl($header, $url, $type, $postData = array()) 
    {
        $return = '';
        $resource = curl_init();
        curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
        curl_setopt($resource, CURLOPT_URL, $url);
        curl_setopt($resource, CURLOPT_POST, $type);
        curl_setopt($resource, CURLOPT_ENCODING, 1);
        if ($type == 1) {
          curl_setopt($resource, CURLOPT_POSTFIELDS, http_build_query($postData));
        }
        curl_setopt($resource, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($resource, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($resource, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($resource, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($resource);
        curl_close($resource);
        return $return;
    }
}
