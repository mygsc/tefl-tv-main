@extends('layouts.default')


@section('content')
@include('elements/flash_verify')
<div class='container pageh'>
<br/><br/>
<div class="row">
		<div class="col-md-4 col-sm-5">
			<div class="loginDivH textbox-layout">
				<img src="/img/logos/teflTv.png" class="center-block">
				<br/>
				<!-- Sign In -->
				{{Form::open(array('route' => 'homes.post.signin'))}}
				
				{{Form::text('channel_name',null,array('placeholder' => 'Channel Name'))}}
				
				{{Form::password('password',array('class' => 'txt_password' , 'placeholder' => 'Password','required' => true))}}

				<div class="text-right">
					<br/>
					{{Form::checkbox('remember_me')}}	{{Form::label('remember_me', 'Remember Me')}}
					&nbsp;&nbsp;
					{{Form::submit('Sign In',array('class'=>'btn btn-primary'))}}
					{{Form::close()}}
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-7">
			<div class="signDivH textbox-layout">
				<h4><i class="fa fa-play"></i>&nbsp;Free Sign-up</h4>
				
				<!-- Sign Up -->
				{{ Form::open(array('route' => 'homes.post.signup'))}}
				{{ Form::text('email', null, array('placeholder' => 'Email Address'))}}
				@if($errors->has('email'))
					<span class="inputError">
						{{$errors->first('email')}}
					</span>
				@endif

				{{Form::text('channel_name', null, array('placeholder' => 'Channel Name'))}}
				@if($errors->has('channel_name'))
					<span class="inputError">
						{{$errors->first('channel_name')}}
					</span>
				@endif

				{{Form::password('password', array('placeholder' => 'Password' , 'class' => 'txt_password'))}}
				@if($errors->has('password'))
					<span class="inputError">
						{{$errors->first('password')}}
					</span>
				@endif

				{{Form::password('confirm_password', array('placeholder' => 'Confirm Password', 'class' => 'txt_password'))}}

				{{Form::text('first_name', null, array('placeholder' => 'Firstname'))}}
				@if($errors->has('first_name'))
				<span class="inputError">
					{{$errors->first('first_name')}}
				</span>
				@endif

				{{Form::text('last_name', null, array('placeholder' => 'Lastname'))}}
				@if($errors->has('last_name'))
					<span class="inputError">
						{{$errors->first('last_name')}}
					</span>
				@endif

				{{Form::text('contact_number', null, array('placeholder' => 'Contact Number (optional)'))}}
				@if($errors->has('contact_number'))
					<span class="inputError">
						{{$errors->first('contact_number')}}
					</span>
				@endif
				<br/>
				<div class="text-right"> 
					{{Form::submit('Sign Up', array('class' => 'btn btn-primary'))}}
				</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<BR/><br/>
</div><!--/.container page-->

@stop