@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>留言板</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				@foreach($comments as $comment)
					<div class="jumbotron" style="background-color: #FEE;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px">
						<label>{{ $comment->name }}：</label><br>
						<label style="font-size: small;">
						{!! nl2br($comment->content) !!}</label>

						@foreach($replies as $reply)
					  		@if($comment->id == $reply->comment_id)
					  			<div class="jumbotron" style="background-color: #FFE;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 10px;">
					  			<label>{{ $reply->name }}</label>
					  			<label style="font-size: small;">回覆</label>
					  			<br><label style="font-size: small;">
					  			{!! nl2br($reply->content) !!}</label><br>
					  			<label style="font-size:small;color:#CCC;float:right">
								{{ $reply->created_at }}</label>

						  		{{ Form::open(array('action' => array('Backend\CommentController@reply_destroy', $comment->id, $reply->id), 'method' => 'delete')) }}
						  		<a href="/backend/comment/{{ $comment->id }}/reply/{{ $reply->id }}/edit" class="btn btn-xs">編輯</a>
								{{ Form::submit('刪除', ['class' => 'btn btn-xs btn-link']) }}
				  				{{ Form::close() }}
								</div>
					  		@endif					  				
						@endforeach
						
						<label style="font-size:small;color:#CCC;float:right">
						{{ $comment->created_at }}</label>
						{{ Form::open(array('action' => array('Backend\CommentController@destroy', $comment->id), 'method' => 'delete')) }}
						<a href="/backend/comment/{{ $comment->id }}/reply" class="btn btn-xs btn-link">回覆</a>
					  	<a href="/backend/comment/{{ $comment->id }}/edit" class="btn btn-xs">
						編輯</a>
						{{ Form::submit('刪除', ['class' => 'btn btn-xs btn-link']) }}
					  	{{ Form::close() }}
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
	    	<hr>
	    	<div class="col-md-10 col-md-offset-1">
	    		<div class="jumbotron" style="background-color: #FEE">
	    		{{ Form::open(array('action' => array('Backend\CommentController@store'), 'method' => 'post')) }}

	    		<label>{{ $user->name }}：</label><br>
	    		{{ Form::textarea('content', null, ['class' => 'form-control']) }}
  				<br>
	    		{{ Form::submit('確定', ['class' => 'btn btn-sm btn-default']) }}

	    		{{ Form::close() }}
	    		</div>
	    	</div>
	    </div>						
	</div>
@endsection