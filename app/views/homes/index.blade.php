@extends('layouts.default')
	@section('css')
		{{HTML::style('css/vid.player.css')}}
	@stop
@section('content')
<div class="row White">
	<div class="container page">
		<div class="row">	
			<br/>
			<div class="col-md-8" style="margin-bottom:20px;">
				<div class="col-md-12">
				<div class="row  vid-wrapper">
				<div class="embed-responsive embed-responsive-16by9">
              	<video id="media-video" poster="/img/thumbnails/v1.png">
					<source src='/videos/bowling.mp4' type='video/mp4'>
					<source src='/videos/bowling.webm' type='video/webm'>
					<source src='/videos/bowling.ogv' type='video/ogg'>
					{{-- <source src='/videos/movie.mov' type='video/mov'>
					<source src='/videos/movie.m4v' type='video/x-m4v'>
					<source src='/videos/movie.3gp' type='video/3gpp'>  --}}  
				</video>
				</div>
				<div class="advertisement" style="display:none">
				 	<span class="close">x</span> 
					<h2 style="text-align:center;color:#fff;">GSC is hiring for web developer <a target="_blank" href="http://www.graphicstudiocentral.com">APPLY NOW!</a></h2>
				</div>
				<div class="play-icon">
					<span><img src="/img/icons/play-btn.png"></span>
				</div>

			<div class="" style="margin-top:-7px;">
				<div class="wrapper">
					<div id="progressbar">
						<div id="current-progress">		
						</div>
					</div>
				
				<span class="img-play"><img onclick='togglePlayPause();' id="play-pause" class='play'  src="/img/icons/play.png"/></span>
			
				<span class="pull-right">
					<span class="ctime time">{{--TIME DISPLAY HERE--}}</span> 
					
					<span class="sound" title="Volume"><img id='mute-icon' src="/img/icons/sound.png"  onclick='toggleMute("true");' />
						<div class="volume" style="display:none">
							<div onclick='changeVolume("+")' id="plus-vol">+</div>
								<div class="volume-static-holder">
									<div id="volume-vertical">
										<div id="volume-button"> 
										</div>
									</div>
								</div>
							<div onclick='changeVolume("-")' id="minus-vol" >-</div>							
						</div>
					</span>
					<span ><img onclick='fullscreen();' title="fullscreen" class="fullscreen" src="/img/icons/fullscreen.png"></span>
						<div class="hd-setting" style="display:none">
						<small style="text-align:center;color:#fff">HD Quality</small>
							<ul>
								<li> <a href="#">1080p</a></li>
								<li> <a href="#">720p</a></li>
								<li> <a href="#">480p</a></li>
								<li> <a href="#">360p</a></li>
								<li> <a href="#">240p</a></li>
							</ul>						
						</div>
						<div class="share-video" style="display:none">
						<small style="text-align:center;color:#fff">Share to:</small>
							<ul>
									<a href=""><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
									<a href=""><i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
									<a href=""><i class="socialMedia socialMedia-instagram" title="Share on Instagram"></i></a>
									<a href=""><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-youtube" title="Share on Youtube"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-tumblr" title="Share on Tumblr"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-flickr" title="Share on Flickr"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-pinterest" title="Share on Pinterest"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-blogger" title="Share on Blogger"></i></a>
                                    
							</ul>							
						</div>

					<span><img id="hd-setting" title="HD setting" src="/img/icons/setting.png"></span>
					<span><img id="share-video" title="Share video" src="/img/icons/share.png"></span>
					<img src="/img/logos/teflTv.png" class="playerLogo">
				</span>
			</div><!--/.wrapper-->
		</div>
    </div><!--/.row-->
    </div>
			</div><!--/.col-md-8-->

			<div class="col-md-4">
                <div class="row">
                    <div class="ad1 col-md-12 col-sm-6" style="margin-bottom:20px;">
                        <img src="/img/thumbnails/ad1.png" class="adDiv">
                    </div><!--/.ad1-->
                    
                    <div class="ad2 col-md-12 col-sm-6">
                        <img src="/img/thumbnails/ad2.png" class="adDiv">
                   </div><!--/.ad2-->
                </div><!--/.row of col4-->
			</div><!--/.col-md-4-->


		</div><!--/.row 1st-->

		<br/>
		<!--RECOMMENDED VIDEOS SECTION -->
		<div class="row">
			<div class="categoryHead">

	            <h3>Recommended Videos</h3>
	      	</div><!--/.recommended video-->

			<div class="col-md-12">
				<div class="row">

				@foreach($recommendeds as $recommended)
		            <div class="col-md-2">
		            	<img src="/img/thumbnails/v2.png" class="h-video">
		            	<div class="v-Info">
		            		<a href="{{route('homes.watch-video')}}">{{$recommended->title}}</a>
		            	</div>
		            	<div class="count">
		            		55 Views, 40 Likes
		            	</div>
		            </div>
		        @endforeach
		        </div>
	        </div><!--/.col-md-12-->
		</div><!--/.row for recommended videos-->

		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Popular</h3>
					</div>
					@foreach($populars as $popular)
					<div class="col-md-6">
						<img src="/img/thumbnails/v3.png" class="h-video">
						<div class="v-Info">
							<a href="{{route('homes.watch-video')}}">{{$popular->title}}</a>
						</div>
						<div class="count">
		            		{{$popular->views}} Views, {{$popular->likes}} Likes
		            	</div>
					</div>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.popular', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for Popular-->
			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Recent Uploads</h3>
					</div>
					@foreach($latests as $latest)
					<div class="col-md-6">
						<img src="/img/thumbnails/v9.png" class="h-video">
						<div class="v-Info">
							<a href="{{route('homes.watch-video')}}">{{$latest->title}}</a>
						</div>
						<div class="count">
		            		{{$latest->views}} Views, {{$latest->likes}} Likes
		            	</div>
					</div>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.latest', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for Recent Uploads-->

			<div class="col-md-4">
				<div class="row">
					<div class="categoryHead">
						<h3>Random</h3>
					</div>
					@foreach($randoms as $random)
					<div class="col-md-6">
						<img src="/img/thumbnails/v5.png" class="h-video">
						<div class="v-Info">
							<a href="{{route('homes.watch-video')}}">{{$random->title}}</a>
						</div>
						<div class="count">
		            		{{$random->views}} Views, {{$random->likes}} Likes
		            	</div>
					</div>
					@endforeach
					<div class="btn-pos">
						{{ link_to_route('homes.random', 'see more..', null) }}
					</div>
				</div>
			</div><!--/.col-4 for random-->

		</div><!--/.row for threee categories-->

	</div><!--/.container page-->
</div>
@stop
@section('script')
	{{HTML::script('js/media.player.js')}}
	{{HTML::script('js/fullscreen.js')}}
@stop