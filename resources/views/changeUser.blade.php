@extends('layouts.style')
@section('content')
<!-- 隨機登入 -->
<div class="container">
	<div>
	    <form action="/changeUser/backend" method="get">
	        <input type="text" name="user">
	        <input type="submit" value="ok">
	    </form>
	</div>
	<div>
		<form action="/changeUser/backend/user" method="get">
	    	<input type="submit" name="random" value="隨機登入">
	    </form>
	</div>
</div>

@endsection