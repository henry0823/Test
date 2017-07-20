@extends('layouts.video')
@section('content')

<!-- 區域分類 -->
<h2 style="margin-bottom:10px;">{{ $sport }}</h2>
<div style="margin-left:2px;margin-bottom:10px;">
	@foreach($tv as $key => $t)
		<a href="/live/{{ $sport }}/{{ $key }}">{{ $key }}&nbsp</a>
	@endforeach
</div>

@endsection
