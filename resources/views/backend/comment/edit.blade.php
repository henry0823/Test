@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯留言</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="jumbotron" style="background-color: #FEE">
		   			{{ Form::open(array('action' => array('Backend\CommentController@update', $comment->id), 'method' => 'put')) }}
		   			
		   			姓名：<br>
		   			@if($comment->name == null)
		   				{{ Form::text('name', '訪客：', ['class' => 'form-control']) }}
		   			@else
		   				{{ Form::text('name', $comment->name, ['class' => 'form-control']) }}<br>
		   			@endif
		   			內容：<br>
		   			{{ Form::textarea('content', $comment->content, ['class' => 'form-control']) }}
		   			<br>

		   			{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
		   			<a href="/backend/comment" class="btn btn-xs btn-default">
		   			上一頁</a>

		   			{{ Form::close() }}
	    	</div>
	    </div>
	</div>
	
@endsection
