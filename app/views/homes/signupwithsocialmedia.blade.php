@extends('layouts.default')
@section('title')
Sign up with {{strtoupper(Session::get('social_media'))}}
@stop
@section('content')
<div class="row White">
	<div class='container'>
		<br/><br/>
		<div class="row">
			<div class="col-md-8 col-sm-7">

				<div class="row sign-upLinks text-center ">
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
			<div class="col-md-4 col-sm-5">
				<div class="signDivH textbox-layout2 same-H animated zoomIn">
							@if(Session::get('social_media') == 'facebook')
								<img src="/img/icons/fb.png" class="f-icon center-block">
								<div id="status" class="text-center connectTo c-fb">
                                    <h2 href="social/facebook" class="whiteC">Signup with Facebook</h2>
                                </div>
								<div class="well2 text-center">
								<p class="">This are the information that we gathered from your
									<a href="http://facebook.com/{{Session::get('social_media_id')}}">
										{{strtoupper(Session::get('social_media'))}} account
									</a>
								</p>
							@else
								<img src="/img/icons/google.png" class="g-icon center-block">
								<div id="status" class="text-center connectTo c-gp">
                                    <h2 href="social/google" class="whiteC">Signup with Google</h2>
                                </div>
							
								<div class="well2 text-center">
									<p class="">This are the information that we gathered from your
										<a href="http://plus.google.com/{{Session::get('social_media_id')}}">
											{{strtoupper(Session::get('social_media'))}} account
										</a>
									</p>
							
							@endif
						<span>First Name: {{Session::get('first_name')}}</span><br />
						<span>Last Name: {{Session::get('last_name')}}</span><br />
						<span>Email: {{Session::get('email')}}</span><br />
						</div>
						<hr/>
						<h3 class="text-center orangeC">-To complete signup, please fill out the fields.-</h3>
						<hr/>
						{{Form::open(array('route' => 'post.signupwithsocialmedia'))}}
					
						{{Form::hidden('first_name', Session::get('first_name'))}}
						{{Form::hidden('last_name', Session::get('last_name'))}}
						{{Form::hidden('email', Session::get('email'))}}

						<div class="textbox-layouts">
							{{Form::label('channel_name', 'Username')}}
							{{Form::text('channel_name','', array('class' => 'form-control'))}}
							<span class="inputError">
								{{$errors->first('channel_name')}}
							</span>

							{{Form::label('password', 'Password')}}
							{{Form::password('password','', array('class' => 'form-control'))}}
							<span class="inputError">
								{{$errors->first('password')}}
							</span>
							<br/>
							{{Form::label('confirm_password', 'Confirm Password')}}
							{{Form::password('confirm_password','', array('class' => 'form-control'))}}
							
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
		</div>
	</div>
</div>

@stop