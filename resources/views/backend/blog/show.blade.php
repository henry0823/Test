@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>部落格</h1>
				{{ Form::open(array('action' => array('Backend\BlogController@destroy', $blog->id), 'method' => 'delete')) }}
				<a href="/backend/blog/{{ $blog->id }}/edit">編輯</a>
				{{ Form::submit('刪除', ['class' => 'btn btn-link']) }}
				{{ Form::close() }}
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-10 col-md-offset-1">
	   			<blockquote style="border-left-color: #BCE">
		   			<h3 style="text-align: center;">{{ $blog->title }}</h3>
		   			<h5 style="font-size:small;color:#CCC;text-align: center;">{{ $blog->created_at }}
		   			</h5>
		   			{!! nl2br($blog->content) !!}
		  			<hr>
		  			<h3>留言</h3>
			  			@foreach($comments as $comment)
			  				<div class="jumbotron" style="background-color: #CEF;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px">

					  			<label>{{ $comment->name }}：</label><br>
				  				<label style="font-size: small;">
				  				{!! $comment->content !!}</label>
				  				<br>

					  			@foreach($replies as $reply)
					  				@if($comment->id == $reply->blog_comment_id)
					  					<div class="jumbotron" style="background-color: #FFC;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 10px;">
					  					<label>{{ $reply->name }}</label>
					  					<label style="font-size: small;">回覆</label>
					  					<br><label style="font-size: small;">
					  					{!! nl2br($reply->content) !!}</label><br>

						  				{{ Form::open(array('action' => array('Backend\BlogController@reply_destroy', $blog->id, $comment->id, $reply->id), 'method' => 'delete')) }}
						  				<a href="/backend/blog/{{ $blog->id }}/{{ $comment->id }}/reply/{{ $reply->id }}" class="btn btn-xs">
						  				編輯</a>
										{{ Form::submit('刪除', ['class' => 'btn btn-xs btn-link']) }}
										<label style="font-size:small;color:#CCC;float:right">
										{{ $reply->created_at }}</label>
						  				{{ Form::close() }}
					  					</div>
					  				@endif					  				
								@endforeach

					  			{{ Form::open(array('action' => array('Backend\BlogController@comment_destroy', $blog->id, $comment->id), 'method' => 'delete')) }}

					  			<a href="/backend/blog/{{ $blog->id }}/{{ $comment->id }}/reply" class="btn btn-xs">回覆</a>
					  			<a href="/backend/blog/{{ $blog->id }}/{{ $comment->id }}/edit" class="btn btn-xs">編輯</a>
								{{ Form::submit('刪除', ['class' => 'btn btn-xs btn-link']) }}

								<label style="font-size:small;color:#CCC;float:right">
								{{ $comment->created_at }}</label>
					  				
					  			{{ Form::close() }}
				  			</div>
			  			@endforeach
	    		</blockquote>
	    	</div>
	    </div>

	    <div class="row">
	    	<hr>
	    	<div class="col-md-10 col-md-offset-1">
	    		<div class="jumbotron" style="background-color: #CEF">
	    		{{ Form::open(array('action' => array('Backend\BlogController@comment_store', $blog->id), 'method' => 'post')) }}
	    		
	    		@if (Auth::guest())
		    		姓名：
		    		{{ Form::text('name', null, ['class' => 'form-control']) }}<br>
		    		內容：
		    	@else
		    		<label>{{ Auth::user()->name }}：</label><br>
		    	@endif

	    		{{ Form::textarea('content', null, ['class' => 'form-control']) }}
	    		<br>
	    		{{ Form::submit('確定', ['class' => 'btn btn-sm btn-default']) }}

	    		{{ Form::close() }}
	    		</div>
	    	</div>
	    </div>
	</div>
	
@endsection
