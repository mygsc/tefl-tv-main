@extends('layouts.default')

@section('content')
	<div class="container page">
	{{Form::open(array('route' => 'users.post.change-email'))}}
		{{Form::label('email', 'Email: ')}}
		{{Form::text('email', null, array('class' => 'form-control'))}}
		{{$errors->first('email')}}
		<br>
		{{Form::label('newEmail', 'New Email: ')}}
		{{Form::text('newEmail', null, array('class' => 'form-control'))}}
		{{$errors->first('newEmail')}}
		<br>
		{{Form::label('password', 'Password: ')}}
		{{Form::password('password', null, array('class' => 'form-control'))}}
		{{$errors->first('password')}}
		<br>
		{{Form::label('confirmPassword', 'Confirm Password: ')}}
		{{Form::password('confirmPassword', null, array('class' => 'form-control'))}}
		{{$errors->first('confirmPassword')}}
		<br>
		{{Form::submit('Submit')}}
	{{Form::close()}}
	</div>
@stop