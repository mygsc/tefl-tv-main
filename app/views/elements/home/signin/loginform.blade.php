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
	<hr>
	<p class="text-center">Login with your <a href="{{route('homes.facebookconnect',array('action' => 'signin'))}}">Facecook</a> or  <a href="{{route('homes.googleconnect', array('action' => 'signin'))}}">Google</a> Account</p>

</div>