@extends('layouts.video')
@section('content')

{!! Form::open(array('action' => array('ForumController@store'), 'files'=>true)) !!}
	@include('forum/_form')
{!! Form::close() !!}

@endsection