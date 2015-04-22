@extends('layouts.default')


@section('content')
@include('elements/flash_verify')
<div class='container'>
	<br/><br/>
	<div class="row">
		<div class="col-md-4 col-sm-5">
			<div class="loginDivH textbox-layout">
				<img src="/img/logos/teflTv.png" class="center-block">
				<br/>
				<!-- Sign In -->
				<a href="#" id="forgotpw" data-toggle="modal" data-target="#forgot-password">forgot password?</a>
				{{Form::open(array('route' => 'homes.post.signin'))}}
				
				{{Form::text('channel_name1',null,array('placeholder' => 'Channel Name'))}}
				
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
			<div class="signDivH textbox-layout2">
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
				@if($errors->has('confirm_password'))
				<span class="inputError">
					{{$errors->first('confirm_password')}}
				</span>
				@endif
				
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
				<div class="text-right mg-t-10"> 
					{{Form::submit('Sign Up', array('class' => 'btn btn-primary'))}}
				</div>
				{{ Form::close()}}
			</div>
		</div>
	</div>
	<br/><br/>
</div><!--/.container page-->

@stop

@section('modal')
<div class="modal fade overlay" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
				<div class="row content-padding">
					<br/>
					Please enter your email
						{{Form::open(array('route' => 'post.forgotpassword'))}}
						{{Form::email('email', null, array('class' => 'form-control'))}}
						<br/><br/>
						<div class="text-right"> 
							{{Form::submit('retrieve', array('class' => 'btn btn-warning'))}}
						</div>
						<br/>
				</div>
		</div>
	</div>
</div>

@stop