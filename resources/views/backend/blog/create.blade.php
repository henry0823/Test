@extends('layouts.style')

@section('content')
	
	<div class="container">
		<div class="user-header" style="text-align:center">
			<h1>新增部落格</h1>
			<hr>
		</div>

	   	<div class="row">
	   		<div class="col-md-8 col-md-offset-2">
	   			<div class="jumbotron" style="background-color: #BCE">
		   			{{ Form::open(array('action' => array('Backend\BlogController@store', 'method' => 'post'))) }}
		   			
		   			標題：<br>
		   			{{ Form::text('title', null, ['class' => 'form-control']) }}<br>
		   			內容：<br>
		   			{{ Form::textarea('content', null, ['class' => 'form-control']) }}
		   			<br>

		   			{{ Form::submit('確定', ['class' => 'btn btn-xs btn-default']) }}
		   			<a href="/backend/blog" class="btn btn-xs btn-default">
		   			上一頁</a>

		   			{{ Form::close() }}

		   			@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
	    	</div>
	    </div>
	</div>
	
@endsection
