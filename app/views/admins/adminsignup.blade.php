@extends('layouts.admin')
@section('content')
<div class="container page">
	<center>
		<div class="row">
			<h1>Admin Registration</h1>
			@if ($errors->any())
			    <ul>
			        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			    </ul>
			@endif
			{{Form::open(array('route' => 'post.admin.adminsignup','method'=>'POST'))}}
			{{Form::hidden('code',$userCode->code,array('class'=>'form-control'))}}
			{{Form::label('Email')}}
			{{Form::email('email',$userCode->email,array('class'=>'form-control'))}}
			{{Form::label('Username')}}
			{{Form::text('username',null,array('class'=>'form-control'))}}
			{{Form::label('Password')}}
			{{Form::password('password',null,array('class'=>'form-control'))}}
			{{Form::label('Confirm Password')}}
			{{Form::password('password_confirmation',null,array('class'=>'form-control'))}}
			{{Form::submit('Submit',array('class'=>'btn btn-primary'))}}
			{{Form::close()}}
		</div>
	</center>
</div>
@stop