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

		return view('layouts.video', compact('sports'));
	}

	// 頻道分類
	public function video_channel($sport)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);
		$sports = $this->chanServ->sidebar($detail);

		return view('live._channel', compact('sport', 'tv', 'sports'));
	}

	// 播放器
	public function video_show($sport, $channel)
	{	
		$detail = json_decode(Data::find(1)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);
		$sports = $this->chanServ->sidebar($detail);

		return view('live._tv', compact('sport', 'tv', 'channel', 'sports'));
	}
}
