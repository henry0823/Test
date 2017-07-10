@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>好友連結</h1>
				<a href="/backend/link/create">新增</a>
				<a href="/backend/link/destroy">刪除</a>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #ACF">
					@foreach($links as $link)
						<label style="font-size: x-large;">
							<div class="jumbotron" style="background-color: #AEF;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 0px;">
								<a href="/{{ $link->name }}">{{ $link->name }}</a>
							</div>
						</label>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection