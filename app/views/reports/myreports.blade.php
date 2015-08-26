@extends('layouts.default')

@section('title')
    My Reports | TEFL Tv
@stop

@section('content')
<div class='container'>
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 hidden-xs hidden-sm col-md-height col-top ">
				<div class="mg-r-10 row mg-t--10" data-sticky_column="">
					@include('elements/home/categories')
					<div class="mg-t-10">
						@include('elements/home/report')
					</div>
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
						<h2>My Reports ({{count($reports)}})</h2>
						<hr/>
						@foreach($reports as $report)
							Case number: {{$report->case_number}}<br/>
							Reported video: <a href="{{route('homes.watch-video', array('v='.$report->video_url))}}">{{$report->video_title}}</a><br/>
							Uploader's channel: <a href="{{route('view.users.channel', $report->complainants_channel)}}" target="_blank">{{$report->uploaders_channel}} </a><br/>
							Type of reports: {{$report->issue}}<br/>
							Report's description: {{$report->copyrighted_description}}<br/>
							Additional information: {{$report->copyrighted_additional_info}}<br/>
							Date: {{date("M d, Y", strtotime($report->created_at))}}<br/>
							
							{{Form::open(array('style'=>'float:right','route' => array('post.deletereport'),'onsubmit'=> 'return confirm("Are you sure you want to delete this?")' ))}}&nbsp;
								{{Form::hidden('reportid', Crypt::encrypt($report->id))}}
								{{Form::hidden('userid', Crypt::encrypt(Auth::User()->id))}}
								<span title="Delete Report">
									{{Form::button('Cancel Report', array('type' => 'submit',
									'id' => 'favoriteVideo','class'=> 'btn btn-primary btn-xs subs-btn-size'))}}
								</span>
							{{Form::close()}}
							<hr/>
						@endforeach
					@else
						<h1>No Reports.</h1>
					@endif
				</div>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop