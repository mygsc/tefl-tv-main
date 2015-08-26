@extends('layouts.signin')
@section('title')
	Sign up with {{strtoupper(Session::get('social_media'))}}
@stop
@section('content')

<style>
	b{
		font-size:12px;
	}
</style>
<div class="row" >
    <div id="cmn-video-demo3__container" class="hidden-xs" style="z-index:-1;">
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

				<div class="col-md-6 col-md-offset-3 text-center">
					<div class="sign-log-wrapp2 box-shadow">
						@if(Session::get('social_media') == 'facebook')
						<img src="/img/icons/fb.png" class="f-icon center-block" style="width:40px;height:40px;">
						<div id="status" class="text-center connectTo c-fb">
							<h3 href="social/facebook" class="whiteC">Signup with Facebook</h3>
						</div>
						<div class="well2 text-center">
							<p class="">This are the information that we gathered from your
								<a href="http://facebook.com/{{Session::get('social_media_id')}}">
									{{strtoupper(Session::get('social_media'))}} account
								</a>
							</p>
							@else
							<img src="/img/icons/google.png" class="g-icon center-block" style="width:40px;height:40px;">
							<div id="status" class="text-center connectTo c-gp">
								<h3 href="social/google" class="whiteC">Signup with Google</h3>
							</div>

							<div class="well2 text-center">

								<p class="">This are the information that we gathered from your
									<a href="http://plus.google.com/{{Session::get('social_media_id')}}">
										{{strtoupper(Session::get('social_media'))}} account
									</a>
								</p>

								@endif
								<span><b>First Name: </b>{{Session::get('first_name')}}</span><br />
								<span><b>Last Name: </b>{{Session::get('last_name')}}</span><br />
								<span><b>Email: </b>{{Session::get('email')}}</span><br />

							</div>

						</div>

					</div>
				<div class="col-md-6 col-md-offset-3 text-center">
					<div class="signDivH textbox-layout2 same-H animated zoomIn sign-log-wrapp">
						<h3 class="text-center orangeC">-To complete signup, please fill out the fields.-</h3>
	

						{{Form::open(array('route' => 'post.signupwithsocialmedia'))}}
					
						{{Form::hidden('first_name', Session::get('first_name'))}}
						{{Form::hidden('last_name', Session::get('last_name'))}}
						{{Form::hidden('email', Session::get('email'))}}

						<div class="textbox-layouts">
							{{Form::text('channel_name','', array('class' => 'form-control', 'placeholder' => 'Channel Name'))}}
							<span class="inputError">
								{{$errors->first('channel_name')}}
							</span>

							{{Form::password('password',array('class' => 'form-control txt_password', 'placeholder' => 'Password'))}}
							
							<span class="inputError">
								{{$errors->first('password')}}
							</span>
							<br/>
							{{Form::password('confirm_password', array('class' => 'form-control txt_password', 'placeholder' => 'Confirm Password'))}}
							
							<span class="inputError">
								{{$errors->first('confirm_password')}}
							</span>
								<br/>
							<div class="text-right mg-t-20"> 
								{{Form::submit('Cancel', array('class' => 'btn btn-info', 'name' => 'cancel'))}}
								{{Form::submit('sign-up', array('class' => 'btn btn-warning'))}}
							</div>
						</div>

						{{Form::close()}}
						</div>


				</div>
	</div><!--/.container page-->

</div>
</div>


@stop