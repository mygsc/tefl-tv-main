
@if(Session::has('flash_message'))
	<div class="container animated flipInX">
		@if(Session::get('flash_type' == 'error'))
		<div class="alert alert-danger alert-dismissible" role="alert">
		@elseif(Session::get('flash_type' == 'success'))
		<div class="alert alert-success alert-dismissible" role="alert">
		@else
		<div class="alert alert-warning alert-dismissible" role="alert">
		@endif
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_message') }}</p></strong>
		</div>
	</div>
@endif
