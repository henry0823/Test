@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>部落格</h1>
				<a href="/backend/blog/create">新增</a>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-10 col-md-offset-1">
	   			@foreach($blogs as $blog)
	   				<blockquote style="border-left-color: #BCE">
			   				<h3>{{ $blog->title }}</h3><br>
			   				{{ str_limit($blog->content, $limit = 100, $end = '...') }}
			   				<a href="/backend/blog/{{ $blog->id }}" class="btn btn-xs">
			   				繼續閱讀</a> 
			   				<hr>
		    		</blockquote>
				@endforeach
	    	</div>
	    </div>
	</div>
	
@endsection
