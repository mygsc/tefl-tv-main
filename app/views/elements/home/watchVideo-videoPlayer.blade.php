
<div class="">
	<div class="col-md-12">
		<div class="row">
			{{--<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
				<button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
				<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
				<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
				<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
				<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
				<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>
				<button id='btn-fullscreen' class='fullscreen' title='fullscreen' onclick='fullscreen();'>Fullscreen</button> --}}
				@foreach($video_path as $video)
					<div class="embed-responsive embed-responsive-16by9">
						<video id="media-video" width="100%" poster="/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.jpg" class="embed-responsive-item">
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.ogg' type='video/ogg'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mov' type='video/mov'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.m4v' type='video/x-m4v'>
							<source src='/videos/{{$video->user_id}}-{{$video->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.3gp' type='video/3gpp'>
						</video>
					</div>
				@endforeach
				<div class="advertisement" style="display:none">
					<span class="close">x</span> 
					<h2 style="text-align:center;color:#fff;">GSC is hiring for web developer <a href="#">APPLY NOW!</a></h2>
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
				
						<span class="img-play"><img class='play' onclick='togglePlayPause();' id="play-pause" src="/img/icons/play.png"/></span>
						<span class="pull-right">
							{{--<span class="ctime time">00:00 / </span> 
							<span class="ttime time">00:00</span>--}}
							<span class="ctime time">{{--TIME DISPLAY HERE--}}</span> 
					
							<span class="sound" title="Volume"><img id='mute-icon' src="/img/icons/sound.png"  onclick='toggleMute("true");' />
								<div class="volume" style="display:none">
								<input id="volume" type="range" min="0" max="100" value="100">
									{{-- <div onclick='changeVolume("+")' id="plus-vol">+</div>
										<div class="volume-static-holder">
											<div id="volume-vertical">
												<div id="volume-button"> 
												</div>
											</div>
										</div>
									<div onclick='changeVolume("-")' id="minus-vol" >-</div>	 --}}						
								</div>
							</span><!--/.sound-->
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
									<!--<a href=""><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-youtube" title="Share on Youtube"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-tumblr" title="Share on Tumblr"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-flickr" title="Share on Flickr"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-pinterest" title="Share on Pinterest"></i></a>
                                    <a href=""><i class="socialMedia socialMedia-blogger" title="Share on Blogger"></i></a>-->
                                    
								</ul>						
							</div>

							<span><img id="hd-setting" title="HD setting" src="/img/icons/setting.png"></span>
							<span><img id="share-video" title="Share video" src="/img/icons/share.png"></span>
			
						</span><!--/.pull-right iconds-->
					</div><!--./wrapper-->
				</div>
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
