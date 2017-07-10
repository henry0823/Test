@extends('layouts.style')

@section('content')

	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>刪除好友</h1>
			<hr>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="jumbotron" style="background-color: #ACF">
					{{ Form::open(array('action' => array('Backend\LinkController@destroy'), 'method' => 'delete')) }}

					@foreach($links as $link)
						<label style="font-size: x-large;">
							<div class="jumbotron" style="background-color: #AEF;padding-top: 5px;padding-bottom: 5px;padding-left: 10px;padding-right: 10px;margin-bottom: 10px;">
								{{ Form::radio('name', $link->name, false) }}
								{{ $link->name }}
							</div>
						</label>
					@endforeach
					<br>
					{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
					<a href="/backend/link" class="btn btn-xs btn-default">上一頁</a>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection