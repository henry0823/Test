@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>新增個人資料</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					{{ Form::open(array('action' => 'Backend\UserController@store'
					, 'method' => 'post', )) }}
					<label>年齡：</label>
					{{ Form::text('age') }}<br>
					<label>性別：</label>
					{{ Form::text('sex') }}<br>
					<label>生日：</label>
					{{ Form::text('day') }}<br>
					<label>地址：</label>
					{{ Form::text('address') }}<br>
					<label>興趣：</label>
					{{ Form::text('interest') }}<br>
					<label>自我介紹：</label><br>
					{{ Form::textarea('self') }}<br>

					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/user" class="btn btn-xs btn-default">上一頁</a>
					
					{{ Form::close() }}
				</div>	
			</div>
		</div>
	</div>

@endsection