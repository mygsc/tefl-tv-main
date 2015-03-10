@extends('layouts.admin')
@section('content')
<div class="container page">
	<center>
		<div class="row">
			<h1>RESET PASSWORD</h1>
			@if ($errors->any())
			    <ul>
			        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			    </ul>
			@endif
			{{Form::open(array('route' => 'post.admin.pwdreset','method'=>'POST'))}}
			{{Form::hidden('user_id',$adminInfo->id,array('class'=>'form-control'))}}
			{{Form::label('New Password')}}
			{{Form::password('password',null,array('class'=>'form-control'))}}
			{{Form::label('Confirm Password')}}
			{{Form::password('password_confirmation',null,array('class'=>'form-control'))}}
			{{Form::submit('Submit',array('class'=>'btn btn-primary'))}}
			{{Form::close()}}
		</div>
	</center>
</div>
@stop