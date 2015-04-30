@if(Session::has('flash_good'))
	<div class="p-relative text-center">
		<div class="animated flipInX p-absolute flash center-block alert">
			<div class="good alert-dismissible same-H" role="alert">
			  <button type="button" class="close mg-r-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong><p class="text-center"><i class="fa fa-check"></i> {{ Session::get('flash_good') }}</p></strong>

			</div>
		</div>
	</div>
@endif

@if(Session::has('flash_bad'))
	<div class="p-relative text-center">
		<div class="animated flipInX p-absolute flash center-block alert">
			<div class="bad alert-dismissible same-H" role="alert">
			  <button type="button" class="close mg-r-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong><p class="text-center"><i class="fa fa-close"></i> {{ Session::get('flash_bad') }}</p></strong>
			</div>
		</div>
	</div>
@endif

@if(Session::has('flash_warning'))

	<div class="p-relative text-center">
		<div class="animated flipInX p-absolute flash center-block alert">
			<div class="warn alert-dismissible same-H" role="alert">
			  <button type="button" class="close mg-r-20" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong><p class="text-center"> <i class="fa fa-exclamation-triangle"></i> {{ Session::get('flash_warning') }}</p></strong>
			</div>
		</div>
	</div>
@endif

