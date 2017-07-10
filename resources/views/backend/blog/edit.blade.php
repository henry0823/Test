@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯部落格</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="jumbotron" style="background-color: #BCE">
		   			{{ Form::open(array('action' => array('Backend\BlogController@update', $blog->id), 'method' => 'put')) }}
		   			
		   			標題：<br>
		   			{{ Form::text('title', $blog->title, ['class' => 'form-control']) }}<br>
		   			內容：<br>
		   			{{ Form::textarea('content', $blog->content, ['class' => 'form-control']) }}
		   			<br>

		   			{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
		   			<a href="/backend/blog/{{ $blog->id }}" class="btn btn-xs btn-default">
		   			上一頁</a>

		   			{{ Form::close() }}
	    	</div>
	    </div>
	</div>
	
@endsection
