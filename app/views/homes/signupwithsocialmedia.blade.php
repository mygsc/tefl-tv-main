@extends('layouts.default')
@section('title')
Sign up with {{strtoupper(Session::get('social_media'))}}
@stop
@section('content')
<div class="contianer">
	<div class="col-md-12">
		<div class="row">
			<h1>Sign up with {{strtoupper(Session::get('social_media'))}} (ICON HERE)</h1>
		</div>
		<div class="row">
			<span>This are the information that we gather from your
				@if(Session::get('social_media') == 'facebook') 
				<a href="http://facebook.com/{{Session::get('social_media_id')}}">
					{{strtoupper(Session::get('social_media'))}} account
				</a>
				@else
				<a href="http://plus.google.com/{{Session::get('social_media_id')}}">
					{{strtoupper(Session::get('social_media'))}} account
				</a>
				@endif
			</span><br />
			<span>First Name: {{Session::get('first_name')}}</span><br />
			<span>Last Name: {{Session::get('last_name')}}</span><br />
			<span>Email: {{Session::get('email')}}</span><br />
			<h2>Please fill the fields with your desired username and password</h2>
			{{Form::open(array('route' => 'post.signupwithsocialmedia'))}}
			
			{{Form::hidden('first_name', Session::get('first_name'))}}
			{{Form::hidden('last_name', Session::get('last_name'))}}
			{{Form::hidden('email', Session::get('email'))}}

			{{Form::label('channel_name', 'Username')}}
			{{Form::text('channel_name')}}
			<span class="inputError">
				{{$errors->first('channel_name')}}
			</span>
			{{Form::label('password', 'Password')}}
			{{Form::password('password')}}
			<span class="inputError">
				{{$errors->first('password')}}
			</span>
			{{Form::label('confirm_password', 'Confirm Password')}}
			{{Form::password('confirm_password')}}
			<span class="inputError">
				{{$errors->first('confirm_password')}}
			</span>
			{{Form::submit('sign-up')}}

			{{Form::close()}}
		</div>
	</div>
</div>

@stop