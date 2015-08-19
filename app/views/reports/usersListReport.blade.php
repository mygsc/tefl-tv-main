@extends('layouts.default')

@section('title')
    List of Reports | TEFL Tv
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
					@if(count($reports) >= 1)
						<h2>Reports for this video:</h2>
						<hr/>
						Number of report(s): {{count($reports)}} <br/>
						@foreach($reports as $report)
							Case Number: {{$report->case_number}}<br/>
							Complainants Channel: <a href="{{route('view.users.channel', $report->complainants_channel)}}" target="_blank">{{$report->complainants_channel}} </a><br/>
							Reported Video: <a href="{{route('homes.watch-video', array('v='.$report->video_url))}}">{{$report->video_title}}</a><br/>
							Type of reports: {{$report->issue}}<br/>
							Report's description: {{$report->copyrighted_description}}<br/>
							Additional Information: {{$report->copyrighted_additional_info}}<br/>
							Date: {{ date("M d, Y", strtotime($report->created_at))}}<br/>
							<a href="{{route('get.filedispute', Crypt::encrypt($report->id))}}" target="_blank" class='btn btn-primary btn-xs subs-btn-size'>File Dispute</a>
							<hr/>
						@endforeach
					@else
						<h1>No Reports for this video.</h1>
					@endif
				</div>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop