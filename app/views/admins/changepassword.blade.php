@extends('layouts.default')
@section('content')
<div class="container">
	<center>
		<div class="row">
			<h1>RESET PASSWORD</h1>
			@if ($errors->any())
			    <ul>
			        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			    </ul>
			@endif
			{{Form::open(array('route' => 'post.admin.pwdreset','method'=>'POST'))}}
			{{Form::label('Username')}}
			{{Form::text('channel_name',null,array('class'=>'form-control'))}}
			{{Form::label('Password')}}
			{{Form::password('password',null,array('class'=>'form-control'))}}
			{{Form::submit('Sign In',array('class'=>'btn btn-primary'))}}
			{{Form::close()}}
		</div>
	</center>
</div>
@stop