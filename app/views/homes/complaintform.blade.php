@extends('layouts.default')

@section('content')
	<div class="container">
		<div class="row">
		<div class="col-lg-3 col-md-3 hidden-xs hidden-sm">

			<div class="mg-r-10 row">
				@include('elements/home/categories')
				<div>
					@include('elements/home/adverstisement_half_large_recatangle')
				</div>
				<div class="mg-t-10">
					@include('elements/home/carouselAds')
				</div>
				<div class="mg-t-10">
					@include('elements/home/adverstisementSmall')

				</div>
			</div>
		</div>
		<div class="col-md-9 White mg-t-10 same-H">
			<h2>Copyright Complaint Form</h2>
			<br/>
		</div><!--/.col-md-9 left section, writeUps-->
	</div><!--/.container page-->
</div>
@stop