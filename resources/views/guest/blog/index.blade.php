@extends('layouts.guest')

@section('bar')
	<ul class="nav navbar-nav">
	    <li><a href="/{{ $user->name }}/user">個人資料</a></li>
	    <li><a href="/{{ $user->name }}/blog">部落格</a></li>
	    <li><a href="/{{ $user->name }}/comment">留言板</a></li>
	    <li><a href="/{{ $user->name }}/link">好友連結</a></li>         
    </ul>
@endsection

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>部落格</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-10 col-md-offset-1">
	   			@foreach($blogs as $blog)
	   				<blockquote style="border-left-color: #BCE">
			   				<h3>{{ $blog->title }}</h3><br>
			   				{{ str_limit($blog->content, $limit = 100, $end = '...') }}
			   				<a href="/{{ $user->name }}/blog/{{ $blog->id }}" class="btn btn-xs">
			   				繼續閱讀</a> 
			   				<hr>
		    		</blockquote>
				@endforeach
	    	</div>
	    </div>
	</div>
	
@endsection
