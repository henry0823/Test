@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯用戶名稱</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					{{ Form::open(array('action' => array('Backend\UserController@name_update', $user->name ), 
					'method' => 'put')) }}

					姓名：
					{{ Form::text('name', $user->name) }}<br><br>

					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/user" class="btn btn-xs btn-default">上一頁</a>

					{{ Form::close() }}
				</div>	
			</div>
		</div>
	</div>

@endsection