@extends('layouts.default')

@section('title')
Reset password - TEFL-TV
@stop

@section('content')
<div class="row White">
	<div class="container page">
		<br/><br/><br/>
		<div class="well col-md-6 col-md-offset-3 text">
			{{Form::open(array('route' => 'post.resetpassword'))}}
			{{Form::hidden('token', $token)}}
			{{Form::hidden('uid', Crypt::encrypt($userInfo->id))}}
			<h3>Channel name: {{$userInfo->channel_name}}</h3>
			<br />
			{{Form::label('new-password', 'New Password')}}
			{{Form::password('password', array('class' => 'form-control'))}}
			<br/>

			<span class="inputError">{{$errors->first('password')}}</span>
			<br />
			{{Form::label('new-password', 'New Password Confirmation')}}
			{{Form::password('password_confirmation', array('class' => 'form-control'))}}
			<span class="inputError">{{$errors->first('password_confirmation')}}</span>
			<br /><br />
			<div class="text-right">
				{{Form::submit('save', array('class'=> 'btn btn-primary'))}}
			</div>
			
			{{Form::close()}}
		</div>
	</div>
</div>
@stop