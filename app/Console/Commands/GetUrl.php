<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ChannelService;
use App\Services\Parse;
use App\Data;

class GetUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get url';
    protected $channelService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ChannelService $channelService)
    {
        parent::__construct();
        $this->channelService = $channelService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $detail = json_decode(Data::find(1)->content, true);
        $sports = $this->channelService->sidebar($detail);
        $channel = $this->channelService->sidebar_detail($sports, $detail);

        foreach($channel as $chan)
        {
            foreach($chan as $c)
            {
                $title[] = $c['zbTitle'];
                $url[] = $c['zbUrl'];
            }
        }
        
        while ($url == null) 
        {
            return $this->handle();
        }
      
        $video = new Parse();
        // 取得網址列
        // 取得 index url 並指向
        $video->setIndex();
        // 登入 取得 verify
        $video->login();
        // 取得線路資訊
        $video->getLine();
        // SSO 登入
        $video->sso();
        // 取得Channel列表
        $channelList = $video->getChannelList();

        $video->getChannelXMLLink();
        // 取得播放線路XML
        $video->getChannelXML();
        foreach($url as $u)
        {
            // 取得Channel k & t
            $video->getChannelKT();
        
            $video->tvChannel = $u;
            $channelLink = '';
            $channelLink = $video->getChannelLink();
            $link[] = $channelLink['link'];
        }
        // dd($link);
        while($link == null)
        {
            return $this->handle();
        }

        $result = json_encode(array_combine($title, $link));

        $data = ['content' =>  preg_replace('/\s(?=)/', '', $result),
                 'updated_at' => \Carbon\Carbon::now('Asia/Taipei')];

        \DB::table('data')
            ->where('id', 2)
            ->update($data);
    }
}
