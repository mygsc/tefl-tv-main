@extends('layouts.default')

@section('content')
	<div class="container">
		<center>
		<h2>Reset Password</h2>	
		{{ Form::open(array('route' => 'post.admin.resetpassword')) }}
			{{ Form::label('Email','Email')}}
			<br>
			{{ Form::text('email',null, array('placeholder' => 'Email or Username'))}}
			@if($errors->has('email'))
				{{$errors->first('email')}}
			@endif
			<br>
			{{ Form::submit('Recover') }}
		{{ Form::close() }}
		</center>
	</div>
@stop