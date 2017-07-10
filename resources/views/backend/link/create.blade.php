@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>新增好友</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					{{ Form::open(array('action' => 'Backend\LinkController@store'
					, 'method' => 'post', )) }}
					<label>E-Mail</label><br>
					{{ Form::text('email', null, ['class' => 'form-control']) }}<br>

					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/link" class="btn btn-xs btn-default">上一頁</a>
					
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection