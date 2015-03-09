
@if(Session::has('flash_message'))
	<div class="container animated flipInX" style="background:#f1f1f1;-webkit-box-shadow: inset -5px -5px 5px -4px rgba(0,0,0,0.08);
-moz-box-shadow: inset -5px -5px 5px -4px rgba(0,0,0,0.08);
box-shadow: inset -5px -5px 5px -4px rgba(0,0,0,0.08);">
		<div class="alert alert-info alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><p class="text-center">{{ Session::get('flash_message') }}</p></strong>
		</div>
	</div>
@endif
