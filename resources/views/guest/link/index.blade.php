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
			<h1>好友連結</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #ACF">
					@foreach($links as $link)
						<label style="font-size: x-large;">
							<div class="jumbotron" style="background-color: #AEF;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 10px;">
								<a href="/{{ $link->name }}">{{ $link->name }}</a>
							</div>
						</label>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection