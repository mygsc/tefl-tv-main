
@if(Session::has('flash_message'))
	<div class="col-md-6 col-md-offset-3">
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_message') }}</p></strong>
		</div>
	</div>
@endif
