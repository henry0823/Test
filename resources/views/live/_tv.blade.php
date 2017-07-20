@extends('layouts.video')
@section('content')

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
	<script type="text/javascript" src="/js/sewise.player.min.js"></script>
</head>
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
	<script type="text/javascript">
		SewisePlayer.setup({
			server: "live",
			type: "rtmp",
			autostart: "true",
			buffer: 1,
			streamurl: "rtmp://45.32.58.12/live_kao/{{ $tv[$chan] }}",
		    skin: "liveWhite",
		    claritybutton: "disable",
			title: "{{ $chan }}",
	        fallbackurls:{
	       		m3u8: "http://45.32.58.12/live_gtk/{{ $tv[$chan] }}.m3u8"
			}
		}, "player");
	</script>
</div>
<div style="float: left; width: 100%; padding: 10px 30px;"></div>

@endsection