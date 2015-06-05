
<div class="">
	<div class="">
		<div class="col-md-12">
			{{--<progress id='progress-bar' min='0' max='100' value='0'>0% played</progress>
				<button id='replay-button' class='replay' title='replay' onclick='replayMedia();'>Replay</button>	
				<button id='play-pause-button' class='play' title='play' onclick='togglePlayPause();'>Play</button>
				<button id='stop-button' class='stop' title='stop' onclick='stopPlayer();'>Stop</button>
				<button id='volume-inc-button' class='volume-plus' title='increase volume' onclick='changeVolume("+");'>Increase volume</button>
				<button id='volume-dec-button' class='volume-minus' title='decrease volume' onclick='changeVolume("-");'>Decrease volume</button>
				<button id='mute-button' class='mute' title='mute' onclick='toggleMute("true");'>Mute</button>
				<button id='btn-fullscreen' class='fullscreen' title='fullscreen' onclick='fullscreen();'>Fullscreen</button> --}}
			
				<video id="media-video" width="100%" poster="/img/thumbnails/v1.png">
					<source src='/videos/movie.mp4' type='video/mp4'>
					<source src='/videos/movie.webm' type='video/webm'>
				</video>
				<div class="advertisement" style="display:none">
					<span class="close">x</span> 
					<h2 style="text-align:center;color:#fff;">GSC are hiring for web developer <a href="#">APPLY NOW!</a></h2>
				</div>
				<div class="play-icon">
					<img src="/img/icons/post_play_button.png">
				</div>
			
				<div class="" style="margin-top:-7px;">
					<div class="wrapper">
						<div id="progressbar">
							<div id="current-progress">
							</div>
						</div>
				
						<span class="img-play"><img class='play' onclick='togglePlayPause();' id="play-pause" src="/img/icons/play.png"/></span>
						<span class="title">Vocabulary and Memory Test</span>
						<span class="pull-right">
							<span class="ctime time">00:00 / </span> 
							<span class="ttime time">00:00</span>
					
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
									<li> <a href="#">Facebook</a></li>
									<li> <a href="#">Twitter</a></li>
									<li> <a href="#">Instagram</a></li>
									<li> <a href="#">Youtube</a></li>
									<li> <a href="#">Gmail</a></li>
								</ul>						
							</div>

							<span><img id="hd-setting" title="HD setting" src="/img/icons/setting.png"></span>
							<span><img id="share-video" title="Share video" src="/img/icons/share.png"></span>
							<img src="/img/logos/teflTv.png" class="playerLogo">
						</span><!--/.pull-right iconds-->
					</div><!--./wrapper-->
				</div>
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
@stop

