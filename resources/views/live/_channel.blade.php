@extends('layouts.video')
@section('content')

<!-- 區域分類 -->
@foreach($tv as $key => $t)
	<b><a href="/live/{{ $sport }}/{{ $key }}">{{ $key }}</a></b>
@endforeach
	</script>
</div>

@endsection
