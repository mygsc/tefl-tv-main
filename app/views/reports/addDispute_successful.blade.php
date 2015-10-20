@extends('layouts.default')

@section('title')
    File Dispute | TEFL Tv
@stop
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/video-player/fullscreen.min.js')}}
{{HTML::script('js/adsbygoogle.js')}}
<script>
if(window.isAdsDisplayed === undefined ) {
	$('.antiablock').removeClass('hidden');
}
</script>
@stop
@section('content')
<div class='container'>
	<div class="row mg-t-10">
		<div class="row-same-height">
			<div class="col-md-12 White sameH-h mg-t-10 same-H col-md-height col-top ">
				<div class="content-padding textbox-layout">
					<h2>
						<a href="{{route('homes.watch-video', array('v='.$dispute->video_url))}}">
						<i class="fa fa-check"></i> Your claim of dispute for {{$dispute->video_title}} has been submitted. 
						</a>
					</h2>
					<hr/><br/>
					<div class="row">
						<div class="col-md-4">
							<div class="vid-wrapperb p-relative">
								<div id="vid-controls">
									<div class="embed-responsive embed-responsive-16by9 n-mg-b">
										<video class="video-1" preload="none" id="media-video" poster="/img/thumbnails/v1-h.png">
											<source  src='/videos/tefltv.mp4' id="mp4" type='video/mp4'/>
											<source  src='/videos/tefltv.webm' id="webm" type='video/webm'/>
										</video>
									</div><!--/embed-responsive-->
									<div class="n-mg-b">
										@include('elements/videoPlayer')
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h3>Reason for dispute</h3>
							{{$dispute->report_reason}}
		
							<hr/>
		
							<h3>Explanation</h3>
							{{$dispute->dispute_description}}
		
							<hr/>
		
							<h3>Signature</h3>
							{{$dispute->signature}}
						</div>
					</div>
				</div>
				<br/><br/><br/>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop