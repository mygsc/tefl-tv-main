@extends('layouts.default')


@section('content')
@include('elements/flash_verify')
<div class="row White">
	<div class='container'>
		<br/><br/>
		<div class="row">
			<div class="col-md-8 col-sm-7">

				<div class="row sign-upLinks text-center ">
					<h1 class="text-center">
						Create an account for FREE!
						<br/>
						<small>Choose where to sign up</small>
					</h1>
					<a href = "{{route('homes.googleconnect',array('action' => 'signup'))}}"><img src="/img/icons/google.png" class="social-roll google"></a>
					<a href="{{route('homes.signin', array('signup' => 'signup'))}}"><img src="/img/icons/tefltv.png" class="social-roll tefltv signBtn"></a>
					<a href="{{route('homes.facebookconnect',array('action' => 'signup'))}}"><img src="/img/icons/fb.png" class="social-roll fb "></a>
				</div>

			</div>
			<div class="col-md-4 col-sm-5">
				@if(Input::has('signup'))
					@include('elements.home.signin.signupform')
				@else
					@include('elements.home.signin.loginform')
				@endif
			</div>

		</div>
		<br/><br/>
	</div><!--/.container page-->
</div>
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
