<div class="sign-log-wrapp box-shadow   animated zoomIn ">
	<div class="textbox-layout">
		<div id="status" class="text-center connectTo c-fb">
			<h2 href="social/facebook" class="tv-bg whiteC">Log-in to your channel</h2>
		</div>
		<br/>
		<!-- Sign In -->
		{{Form::open(array('route' => 'homes.post.signin'))}}
		<div class="row">
			<div class="col-md-12 text-right">
				
			</div>
			<div class="col-md-8 col-md-offset-2">
					{{Form::text('channel_name1',null,array('placeholder' => 'Channel Name'))}}
					<div class="text-right">
					<a href="#" id="forgotpw" data-toggle="modal" data-target="#forgot-password">forgot password?</a> 
					</div>
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

	</div>

<hr>
<p class="text-center">Login with your <a href="{{route('homes.facebookconnect',array('action' => 'signin'))}}">Facebook</a> or  <a href="{{route('homes.googleconnect', array('action' => 'signin'))}}">Google</a> Account</p>

</div>
