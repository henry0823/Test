<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChannelService;
use App\Services\parse;
use App\Data;

class VideoController extends Controller
{
    protected $channelService;

    public function __construct(ChannelService $channelService, parse $parse)
    {
        $this->channelService = $channelService;
        $this->parse = $parse;
    }

	// 賽事列表
	public function video_list()
	{
		$detail = json_decode(Data::find(1)->content, true);
		$sports = $this->channelService->sidebar($detail);
		$channel = $this->channelService->sidebar_detail($sports, $detail);
        
		return view('layouts.video', compact('sports', 'channel'));
	}

	// 頻道分類
	public function video_channel($sport)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->channelService->channel($sport, $detail);
		$sports = $this->channelService->sidebar($detail);
		$channel = $this->channelService->sidebar_detail($sports, $detail);

		return view('live._channel', compact('sport', 'tv', 'sports', 'channel'));
	}

	// 播放器
	public function video_show(Request $request, $sport, $chan)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->channelService->channel($sport, $detail);
		$sports = $this->channelService->sidebar($detail);
		$channel = $this->channelService->sidebar_detail($sports, $detail);
		$link = json_decode(Data::find(2)->content, true);

		return view('live._tv', compact('sport', 'tv', 'chan', 'sports', 'channel', 'link'));
	}
}
