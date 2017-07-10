@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>個人資料</h1>
				@if(isset($profile))
					<a href="/backend/user/{{ $user->name }}/edit">編輯</a>
				@else
					<a href="/backend/user/create">新增</a>
				@endif
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					<h4>
						姓名：{{ $user->name }}<br>

						@if(isset($profile))
							年齡：{{ $profile->age }}<br>
							性別：{{ $profile->sex }}<br>
							生日：{{ $profile->day }}<br>
							地址：{{ $profile->address }}<br>
							興趣：{{ $profile->interest }}<br>
							自我介紹：{!! nl2br($profile->self) !!}<br>
					</h4>
						@else
							<h2>新增你的個人資料！</h2>
						@endif
				</div>
			</div>
		</div>
	</div>
@endsection