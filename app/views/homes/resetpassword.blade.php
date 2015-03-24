@extends('layouts.default')

@section('title')
Reset password - TEFL-TV
@stop

@section('content')
{{Form::open(array('route' => 'post.resetpassword'))}}
{{Form::hidden('token', $token)}}
{{Form::hidden('uid', Crypt::encrypt($userInfo->id))}}
Channel name: {{$userInfo->channel_name}}
<br />
{{Form::label('new-password', 'New Password')}}
{{Form::password('password', array('class' => 'form-control'))}}
<span class="inputError">{{$errors->first('password')}}</span>
<br />
{{Form::label('new-password', 'New Password Confirmation')}}
{{Form::password('password_confirmation', array('class' => 'form-control'))}}
<span class="inputError">{{$errors->first('password_confirmation')}}</span>
<br />
{{Form::submit('save', array('class'=> 'btn btn-primary'))}}
{{Form::close()}}
@stop