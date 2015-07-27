@extends('layouts.signin')


@section('content')
@include('elements/flash_verify')

<div class="row" >
    <div id="cmn-video-demo3__container" style="z-index:-1;">
        <video id="cmn-video-demo3__video" autoplay muted="muted" loop="true">
            <source src="/videos/tefltv.mp4" type="video/mp4">
            <source src="/videos/tefltv.webm" type="video/webm">
            <source src="/videos/tefltv.ogg" type="video/ogg">
            Your browser doesn't support HTML5 video. Here's a <a href="#">link</a> to download the video.
        </video>
        <div id="cmn-video-demo3__content" >
        </div>
    </div>
    <div class="absolute-wrap">
	    <div class="container" >
			<div class="row" style="">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="sign-log-wrapp2 box-shadow">
					<h1 class="text-center">
							Create an account for FREE!
							<br/>
							<small class="blackC">Choose how to sign up</small>
						</h1>
						<a href = "{{route('homes.googleconnect',array('action' => 'signup'))}}"><img src="/img/icons/google.png" class="social-roll google"></a>
						<a href="{{route('homes.signin', array('signup' => 'signup'))}}"><img src="/img/icons/tefltv.png" class="social-roll tefltv signBtn"></a>
						<a href="{{route('homes.facebookconnect',array('action' => 'signup'))}}"><img src="/img/icons/fb.png" class="social-roll fb "></a>
					</div>
				</div>
				<div class="col-md-8 col-md-offset-2 text-center">

					@if(Input::has('signup'))
						@include('elements.home.signin.signupform')
					@else
						@include('elements.home.signin.loginform')
					@endif
				</div>



		</div>
	</div><!--/.container page-->

</div>
</div>

@stop

@section('modal')
<div class="modal fade overlay" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">

		<div class="modal-content">
			<div class="row content-padding">
				<br/>
				<p>Please enter your email:</p> 
				{{Form::open(array('route' => 'post.forgotpassword'))}}
				{{Form::email('email', null, array('class' => 'form-control'))}}
				<br/><br/>
				<div class="text-right">
					{{Form::submit('Submit', array('class' => 'btn btn-warning'))}}
				</div>
				<br/>
			</div>
		</div>
	</div>
</div>

@stop
