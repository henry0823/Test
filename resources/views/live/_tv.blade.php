@extends('layouts.video')

<?php

if($link[$chan] == "")
{
  	$title = "取得直撥失敗";
}
else
{
  	$title = $link[$chan];
  	echo "<center>".$title."</center>";
}
?>

@section('content')

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
	<script type="text/javascript" src="/js/sewise.player.min.js"></script>
</head>
<body>
	<!-- 細部分類 -->
	<h2 style="margin-bottom:10px;">{{ $sport }}</h2>
	<div style="margin-left:2px;margin-bottom:10px;">
		@foreach($tv as $key => $t)
			@if($key == $chan)
				<b><u><a href="/live/{{ $sport }}/{{ $key }}">{{ $key }}&nbsp</a></u></b>
			@else
				<a href="/live/{{ $sport }}/{{ $key }}">{{ $key }}&nbsp</a>
			@endif
		@endforeach
	</div>

	<div id="player" style="width: 90%; height: 100%;">
		<script>
      		var title = '<?=@$title;?>';
	      	if(title != '')
	      	{
	        	SewisePlayer.setup({
	          		server: "vod",
	          		type: "m3u8",
	          		autostart: "true",
	          		poster: "http://jackzhang1204.github.io/materials/poster.png",
	          		videourl: "{!! $link[$chan] !!}",
	              	skin: "vodWhite",
	              	title: title,
	              	claritybutton: "disable",
	              	lang: "zh_CN"
	        	}, "player");        
	    	}
    	</script>
	</div>
	 
 		經過秒數：<div id="Sec"></div>
 		換算分鐘數：<div id="Min"></div>

	<script>
	    var c=0;
	    var t;
	    function timedCount() {
	        document.getElementById('Sec').innerText = c;
	        document.getElementById('Min').innerText = parseInt(c / 60);
	        c = c + 10;
	        t = setTimeout("timedCount()",10000)
	    }
	    timedCount();
	</script>
</body>

@endsection