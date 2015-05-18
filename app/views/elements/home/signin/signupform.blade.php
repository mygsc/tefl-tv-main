<div class="signDivH textbox-layout2 same-H animated zoomIn">
	<img src="/img/icons/tefltv.png" class="t-icon center-block">
	<div id="status" class="text-center connectTo c-fb">
	<h2 href="social/facebook" class="tv-bg whiteC">Signup with Tefl TV</h2>
	</div>


	<!-- Sign Up -->
	{{ Form::open(array('route' => 'homes.post.signup'))}}
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'Email Address'))}}
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
	<div class="text-right mg-t-20"> 
		{{Form::submit('Cancel', array('class' => 'btn btn-info', 'name' => 'cancel'))}}
		{{Form::submit('Sign Up', array('class' => 'btn btn-warning'))}}
	</div>
	{{Form::close()}}

</div>

