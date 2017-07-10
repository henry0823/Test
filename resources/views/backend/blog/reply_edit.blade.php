@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯回覆</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="jumbotron" style="background-color: #BCE">
		   			{{ Form::open(array('action' => array('Backend\BlogController@reply_update', $blog->id, $comment->id, $reply->id), 'method' => 'put')) }}
		   			
		   			@if($reply->name == null)
					  	姓名：{{ Form::text('name', '訪客：', ['class' => 'form-control']) }}<br>
					@else
	  					姓名：{{ Form::text('name', $reply->name, ['class' => 'form-control']) }}<br>
					@endif
						內容：<br>{{ Form::textarea('content', $reply->content, ['class' => 'form-control']) }}<br>

		   			{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
		   			<a href="/backend/blog/{{ $blog->id }}" class="btn btn-xs btn-default">
		   			上一頁</a>

		   			{{ Form::close() }}
	    	</div>
	    </div>
	</div>
	
@endsection
