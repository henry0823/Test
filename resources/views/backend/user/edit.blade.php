@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>編輯個人資料</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					{{ Form::open(array('action' => array('Backend\UserController@update', $user->name ), 
					'method' => 'put')) }}

					年齡：
					{{ Form::text('age', $profile->age) }}<br>
					性別：
					{{ Form::text('sex', $profile->sex) }}<br>
					生日：
					{{ Form::text('day', $profile->day) }}<br>
					地址：
					{{ Form::text('address', $profile->address) }}<br>
					興趣：
					{{ Form::text('interest', $profile->interest) }}<br>
					自我介紹：<br>
					{{ Form::textarea('self', $profile->self, ['class' => 'form-control']) }}<br>

					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/user" class="btn btn-xs btn-default">上一頁</a>

					{{ Form::close() }}
				</div>	
			</div>
		</div>
	</div>

@endsection