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
			<h1>個人資料</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #CCF">
					<h4>
						@if(isset($profile))
							姓名：{{ $profile->name }}<br>
							年齡：{{ $profile->age }}<br>
							性別：{{ $profile->sex }}<br>
							生日：{{ $profile->day }}<br>
							地址：{{ $profile->address }}<br>
							興趣：{{ $profile->interest }}<br>
							自我介紹：{!! nl2br($profile->self) !!}<br>
						@else
							還沒有新增哦！
						@endif
					</h4>
				</div>
			</div>
		</div>
	</div>
@endsection