@extends('layouts.default')

@section('title')
	For security purposes we would like to verify you are the account owner
@stop

@section('content')
	For additional security purposes we would like to verify your account 
	{{Form::open(array('route' => 'post.partnerships.verification'))}}
		{{Form::label('username')}}
		{{Form::text('username')}}
		{{Form::label('password')}}
		{{Form::text('password')}}
		{{Form::submit('verify')}}
	{{Form::close()}}
@stop