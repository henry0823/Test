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
			<h1>回覆</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="jumbotron" style="background-color: #BCE">
		   			{{ Form::open(array('action' => array('Guest\BlogController@reply_store', $user->name, $blog->id, $comment->id), 'method' => 'post')) }}
		   			
					  	<label>{{ $comment->name }}：</label><br>
						<label style="font-size: small;">
						{!! nl2br($comment->content) !!}
						</label>
						@foreach($replies as $reply)
							<div class="jumbotron" style="background-color: #BEF;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 10px;">
							<label>{{ $reply->name }}</label>
					  		<label style="font-size: small;">回覆</label>
					  		<br><label style="font-size: small;">
					  		{!! nl2br($reply->content) !!}</label><br>
					  		</div>
						@endforeach
					<hr>
					
		   			回覆：
		   			{{ Form::textarea('content', null, ['class' => 'form-control']) }}
		   			<br>

		   			{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
		   			<a href="/{{ $user->name }}/blog/{{ $blog->id }}" class="btn btn-xs btn-default">
		   			上一頁</a>

		   			{{ Form::close() }}
	    	</div>
	    </div>
	</div>
	
@endsection
