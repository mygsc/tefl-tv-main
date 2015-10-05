@extends('layouts.default')

@section('title')
    File Dispute | TEFL Tv
@stop

@section('content')
<div class='container'>
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 hidden-xs hidden-sm col-md-height col-top ">
				<div class="mg-r-10 row mg-t--10" data-sticky_column="">
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
			<div class="col-md-8 White sameH-h mg-t-10 same-H col-md-height col-top ">
				<div class="content-padding textbox-layout">
					<h2>
						<a href="{{route('homes.watch-video', array('v='.$dispute->video_url))}}">
							{{$dispute->video_title}}
						</a>
					</h2>
					<hr/>

					<h2>Reason for dispute</h2>
					<br/>
					{{$dispute->report_reason}}

					<br/>

					<h2>Reason for dispute</h2>
					<br/>
					{{$dispute->dispute_description}}

					<br/>

					<h2>Signature</h2>
					<br/>
					{{$dispute->signature}}

					<br>
					thumbnail:
					<img class="hvr-grow-rotate" src="{{$dispute->thumbnail . '?' . rand(0,99)}}" width="10%">
				</div>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop