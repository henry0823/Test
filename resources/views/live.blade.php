<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
	<title>LIVE</title>
	<script type="text/javascript" src="sewise.player.min.js"></script>
</head>
<!-- 賽事列表 -->
<body>
	@foreach($sport as $key => $s)
		<a href="/live/{{ $sport[$key] }}">{{ $s }}</a>
	@endforeach
	<div style="float: left; width: 100%; padding: 10px 30px; "></div>
</body>
</html>
