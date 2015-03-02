@extends('layouts.default')


@section('content')


<!-- Sign In -->
	{{Form::open(array('route' => 'homes.post.signin'))}}
	{{Form::label('Username')}}
	{{Form::text('username',null,array('class'=>'form-control'))}}
	{{Form::label('Password')}}
	{{Form::password('password',null,array('class'=>'form-control'))}}
	{{Form::submit('Sign In',array('class'=>'btn btn-primary'))}}
	{{Form::close()}}

<!-- Sign Up -->
	{{ Form::open(array('route' => 'homes.post.signup'))}}
		{{Form::label('email', 'Email Address: ')}} {{ Form::text('email', null, array('placeholder' => 'Email Address'))}}
		@if($errors->has('email'))
		{{$errors->first('email')}}
		@endif
		<br/>
		{{Form::label('username', 'Username')}} {{Form::text('username', null, array('placeholder' => 'Username'))}}
		@if($errors->has('username'))
		{{$errors->first('username')}}
		@endif
		<br/>
		{{Form::label('password', 'Password: ')}} {{Form::password('password', null, array('placeholder' => 'Password'))}}
		@if($errors->has('password'))
		{{$errors->first('password')}}
		@endif
		<br/>
		{{Form::label('confirm_password', 'Confirm Password')}} {{Form::password('confirm_password', null, array('placeholder' => 'Confirm Password'))}}
		<br/>
		{{Form::label('first_name', 'Firstname')}} {{Form::text('first_name', null, array('placeholder' => 'Firstname'))}}
		@if($errors->has('first_name'))
		{{$errors->first('first_name')}}
		@endif
		<br/>
		{{Form::label('last_name', 'Lastname')}} {{Form::text('last_name', null, array('placeholder' => 'Lastname'))}}
		@if($errors->has('last_name'))
		{{$errors->first('last_name')}}
		@endif
		<br/>
		{{Form::submit('Sign Up', array('class' => 'btn btn-primary'))}}
	{{ Form::close()}}

@stop