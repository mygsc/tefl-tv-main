@extends('layouts.default')

@section('title')
    List of Reports | TEFL Tv
@stop

@section('content')
<div class='container'>
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-12 White sameH-h mg-t-10 same-H col-md-height col-top ">
				<div class="content-padding textbox-layout">
					@if(count($reports) >= 1)
						<h2>{{count($reports)}} report(s)</h2>
					@foreach($reports as $report)
						<br/>
						<div class="row">
							<div class="col-md-4">
								<a href="{{route('homes.watch-video', array('v=' .$report->video_url))}}" class="thumbnail-h">
									<div class="thumbnail-2">	
										<img class="hvr-grow-rotate" src="{{$report->thumbnail . '?' . rand(0,99)}}" width="100%">
										<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
									</div>
								</a>
							</div>
							<div class="col-md-8">
								Case Number: {{$report->case_number}}<br/>
								Complainants Channel: <a href="{{route('view.users.channel', $report->complainants_channel)}}" target="_blank">{{$report->complainants_channel}} </a><br/>
								Reported Video: <a href="{{route('homes.watch-video', array('v='.$report->video_url))}}">{{$report->video_title}}</a><br/>
								Type of reports: {{$report->issue}}<br/>
								Report's description: {{$report->copyrighted_description}}<br/>
								Additional Information: {{$report->copyrighted_additional_info}}<br/>
								Date: {{ date("M d, Y", strtotime($report->created_at))}}<br/><br/>
								<a href="{{route('get.filedispute', Crypt::encrypt($report->id))}}" target="_blank" class='btn btn-primary btn-xs subs-btn-size'>File Dispute</a>
							
							</div>
						</div>
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