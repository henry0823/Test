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
					  			{!! nl2br($reply->content) !!}</label>
					  			<label style="font-size:small;color:#CCC;float:right">
								{{ $reply->created_at }}</label>
								</div>
					  		@endif					  				
						@endforeach

						<div>
							<label style="font-size:small;color:#CCC;float:right">
							{{ $comment->created_at }}</label>
							<a href="/{{ $user->name }}/comment/{{ $comment->id }}/reply" class="btn btn-xs btn-link">回覆</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<div class="row">
	    	<hr>
	    	<div class="col-md-10 col-md-offset-1">
	    		<div class="jumbotron" style="background-color: #FEE">
	    		{{ Form::open(array('action' => array('Guest\CommentController@store', $user->name), 'method' => 'post')) }}

	    		<label>{{ Auth::user()->name }}：</label><br>
	    		{{ Form::textarea('content', null, ['class' => 'form-control']) }}<br>
	    		{{ Form::submit('確定', ['class' => 'btn btn-sm btn-default']) }}

	    		{{ Form::close() }}
	    		</div>
	    	</div>
	    </div>						
	</div>
@endsection