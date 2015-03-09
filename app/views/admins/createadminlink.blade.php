@extends('layouts.default')

@section('content')
	<div class="container page">
		<center>
		<h2>Send registration link - Admin</h2>	
		{{ Form::open(array('route' => 'post.admin.createadminlink')) }}
			{{ Form::label('Email','Email')}}
			<br>
			{{ Form::text('email',null, array('placeholder' => 'Email Address'))}}
			@if($errors->has('email'))
				{{$errors->first('email')}}
			@endif
			<br>
			{{ Form::submit('Create') }}
		{{ Form::close() }}
		</center>
	</div>
@stop