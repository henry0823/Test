<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChannelService;
use App\Blog;

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
		$detail = json_decode(Blog::find(6)->content, true);
		$sport_count = count($detail['listmatchs']);

		for($i = 0; $i < $sport_count; $i++)
		{
		    $sport[] = ($detail['listmatchs'][$i]['ball'].' ');
		}
		return view('live', compact('sport'));
	}

	// 頻道分類
	public function video($sport)
	{	
		$detail = json_decode(Blog::find(6)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);
		echo 33333;

		return view('list', compact('sport', 'tv'));
	}

	// 播放器
	public function video_show($sport, $channel)
	{	
		$detail = json_decode(Blog::find(6)->content, true);
		$tv = $this->chanServ->channel($sport, $detail);

		return view('tv', compact('sport', 'tv', 'channel'));
	}

}