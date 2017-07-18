<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChannelService;
use App\Data;

class VideoController extends Controller
{
    protected $chanServ;

    public function __construct(ChannelService $channelService)
    {
        $this->chanServ = $channelService;
    }

	// 賽事列表
	public function video_list()
	{
		$detail = json_decode(Data::find(1)->content, true);
		$sports = $this->chanServ->sidebar($detail);
		$channel = $this->chanServ->sidebar_detail($sports, $detail);
        
		return view('layouts.video', compact('sports', 'channel'));
	}

	// 頻道分類
	public function video_channel($sport)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);
		$sports = $this->chanServ->sidebar($detail);
		$channel = $this->chanServ->sidebar_detail($sports, $detail);

		return view('live._channel', compact('sport', 'tv', 'sports', 'channel'));
	}

	// 播放器
	public function video_show($sport, $chan)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);
		$sports = $this->chanServ->sidebar($detail);
		$channel = $this->chanServ->sidebar_detail($sports, $detail);

		return view('live._tv', compact('sport', 'tv', 'chan', 'sports', 'channel'));
	}
}
