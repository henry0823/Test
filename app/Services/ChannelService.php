<?php

namespace App\Services;

class ChannelService
{
	public function sidebar($detail)
	{
		$sport_count = count($detail['channelList']['listmatchs']);
		
		for($i = 0; $i < $sport_count; $i++)
		{
		    $sports[] = ($detail['channelList']['listmatchs'][$i]['ball']);
		}
		return $sports;
	}

	public function sidebar_detail($sports, $detail)
	{
		foreach($sports as $key => $s)
		{
			$channel[] = ($detail['channelList']['listmatchs'][$key]['listmatch']);
		}
		return $channel;
	}

	public function channel($sport, $detail)
	{
		$foot_count = count($detail['channelList']['listmatchs'][0]['listmatch']);
		$us_count = count($detail['channelList']['listmatchs'][1]['listmatch']);
		$jp_count = count($detail['channelList']['listmatchs'][2]['listmatch']);
		$tw_count = count($detail['channelList']['listmatchs'][3]['listmatch']);
		$or_count = count($detail['channelList']['listmatchs'][4]['listmatch']);
		$ice_count = count($detail['channelList']['listmatchs'][5]['listmatch']);
		$basket_count = count($detail['channelList']['listmatchs'][6]['listmatch']);
		$cb_count = count($detail['channelList']['listmatchs'][7]['listmatch']);
		$usfoot_count = count($detail['channelList']['listmatchs'][8]['listmatch']);
		$tn_count = count($detail['channelList']['listmatchs'][9]['listmatch']);
		$hd_count = count($detail['channelList']['listmatchs'][10]['listmatch']);
		$other_count = count($detail['channelList']['listmatchs'][11]['listmatch']);

		if($sport == '足球')
		{
			for($i = 0; $i < $foot_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][0]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][0]['listmatch'][$i]['zbUrl']);
			    $foot = array_combine($title,$url);
			}
			return $foot;	
		}
		elseif($sport == '美棒')
		{
			for($i = 0; $i < $us_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][1]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][1]['listmatch'][$i]['zbUrl']);
			    $us = array_combine($title,$url);
			}
			return $us;	
		}
		elseif($sport == '日棒')
		{
			for($i = 0; $i < $jp_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][2]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][2]['listmatch'][$i]['zbUrl']);
			    $jp = array_combine($title,$url);
			}
			return $jp;	
		}
		elseif($sport == '台棒')
		{
			for($i = 0; $i < $tw_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][3]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][3]['listmatch'][$i]['zbUrl']);
			    $tw = array_combine($title,$url);
			}
			return $tw;	
		}
		elseif($sport == '其他棒球')
		{
			for($i = 0; $i < $or_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][4]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][4]['listmatch'][$i]['zbUrl']);
			    $or = array_combine($title,$url);
			}
			return $or;	
		}
		elseif($sport == '冰球')
		{
			for($i = 0; $i < $ice_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][5]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][5]['listmatch'][$i]['zbUrl']);
			    $ice = array_combine($title,$url);
			}
			return $ice;	
		}
		elseif($sport == '籃球')
		{
			for($i = 0; $i < $basket_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][6]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][6]['listmatch'][$i]['zbUrl']);
			    $basket = array_combine($title,$url);
			}
			return $basket;	
		}
		elseif($sport == '彩球')
		{
			for($i = 0; $i < $cb_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][7]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][7]['listmatch'][$i]['zbUrl']);
			    $cb = array_combine($title,$url);
			}
			return $cb;	
		}
		elseif($sport == '美足')
		{
			for($i = 0; $i < $usfoot_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][8]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][8]['listmatch'][$i]['zbUrl']);
			    $usfoot = array_combine($title,$url);
			}
			return $usfoot;	
		}
		elseif($sport == '網球')
		{
			for($i = 0; $i < $tn_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][9]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][9]['listmatch'][$i]['zbUrl']);
			    $tn = array_combine($title,$url);
			}
			return $tn;	
		}
		elseif($sport == '賽馬/賽狗')
		{
			for($i = 0; $i < $hd_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][10]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][10]['listmatch'][$i]['zbUrl']);
			    $hd = array_combine($title,$url);
			}
			return $hd;	
		}
		elseif($sport == '其他')
		{
			for($i = 0; $i < $other_count; $i++)
			{
			    $title[] = ($detail['channelList']['listmatchs'][11]['listmatch'][$i]['zbTitle']);
			    $url[] = ($detail['channelList']['listmatchs'][11]['listmatch'][$i]['zbUrl']);
			    $other = array_combine($title,$url);
			}
			return $other;	
		}
	}
}