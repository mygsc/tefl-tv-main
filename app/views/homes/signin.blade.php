@extends('layouts.default')


@section('content')

		@if ($errors->any())
		    <ul>
		        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
		    </ul>
		@endif

	{{Form::open(array('route' => 'homes.post.signin','method'=>'POST'))}}
	{{Form::label('Username')}}
	{{Form::text('username',null,array('class'=>'form-control'))}}
	{{Form::label('Password')}}
	{{Form::password('password',null,array('class'=>'form-control'))}}
	{{Form::submit('Sign In',array('class'=>'btn btn-primary'))}}
	{{Form::close()}}

@stop