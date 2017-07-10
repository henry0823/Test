@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯留言</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CEF">
					{{ Form::open(array('action' => array('Backend\BlogController@comment_update'
					, $blog->id, $comment->id), 'method' => 'put')) }}

					姓名：
					{{ Form::text('name', $comment->name, ['class' => 'form-control']) }}
					內容：<br>
					{{ Form::textarea('content', $comment->content, ['class' => 'form-control']) }}<br>

					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/blog/{{ $blog->id }}" class="btn btn-xs btn-default">上一頁</a>

					{{ Form::close() }}
				</div>	
			</div>
		</div>
	</div>

@endsection