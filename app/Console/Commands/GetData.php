<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ChannelService;
use App\Services\Parse;
use App\Data;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get data';
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

        $channel = new Parse();
        // 取得 index url 並指向
        $channel->setIndex();
        // 登入 取得 verify
        $channel->login();
        // 取得線路資訊
        $channel->getLine();
        // SSO 登入
        $channel->sso();
        // 取得Channel列表
        $channelList = json_encode($channel->getChannelList());

        $channel->getChannelXMLLink();
        // 取得播放線路XML
        $channel->getChannelXML();
        // 取得Channel k & t
        foreach($url as $u)
        {
            $channel->tvChannel = $u;
            $channel->getChannelKT();

            $channelLink = '';
            $channelLink = $channel->getChannelLink();
            $link[] = $channelLink['link'];
        }

        while($channelList == '{"channelList":null}')
        {
            return $this->handle();
        }

        $data = ['content' =>  preg_replace('/\s(?=)/', '', $channelList),
                 'updated_at' => \Carbon\Carbon::now('Asia/Taipei')];

        \DB::table('data')
            ->where('id', 1)
            ->update($data);

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
