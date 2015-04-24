
@if(Session::has('flash_verify'))
	<div class="p-relative text-center">
		<div class="animated flipInX p-absolute flash center-block alert">
			<div class="warn alert-dismissible" role="alert">
			  <button type="button" class="close mg-r-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong><p class="text-center">{{ Session::get('flash_verify')['message'] }}</p></strong>
		 
			  <div class="text-center">
				   <p>or</p>
				  {{Form::open(array('route' => 'post.resenduserverify'))}}
				  		{{Form::hidden('channel_name', Session::get('flash_verify')['channel_name'])}}
				  		{{Form::submit('Resend Verification', array('class' => 'btn btn-danger'))}}
				  {{Form::close()}}
			  </div>
			</div>
		</div>
	</div>
@endif
