<?php

namespace App\Services;

class ChannelService
{
	public function channel($sport, $detail)
	{
		$tw_count = count($detail['listmatchs'][3]['listmatch']);

		if($sport == '台棒')
		{
			for($i = 0; $i < $tw_count; $i++)
			{
			    $title[] = ($detail['listmatchs'][3]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['listmatchs'][3]['listmatch'][$i]['zbUrl']);
			    $tw = array_combine($title,$url);
			}
			return $tw;	
		}
		else
		{
			echo 123;
			echo 234;
		}
	}
}