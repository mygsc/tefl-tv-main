@if(Session::has('flash_good'))
	<div class="container animated flipInX">
		<div class="alert alert-success alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_good') }}</p></strong>
		</div>
	</div>
@endif

@if(Session::has('flash_bad'))
	<div class="container animated flipInX">
		<div class="alert alert-danger alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_bad') }}</p></strong>
		</div>
	</div>
@endif

@if(Session::has('flash_warning'))
	<div class="container animated flipInX">
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_bad') }}</p></strong>
		</div>
	</div>
@endif

