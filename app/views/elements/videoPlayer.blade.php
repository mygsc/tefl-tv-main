	<div class="advertisement" style="display:none">
		
			{{--<h2 style="text-align:center;color:#fff;">GSC is hiring for web developer <a target="_blank" href="http://www.graphicstudiocentral.com">APPLY NOW!</a></h2>  --}}
			<div class="span12" style="background:rgba(0,0,0, 0.15)">
				<div class="col-md-10 col-md-offset-1">
					<span class="close">x</span> 
					<iframe src="http://ctrlq.org/sandbox/adsense/?at=image&is=728x90&gl=default&url=nintendo" class="img-responsive" width="100%" frameborder="0" scrolling="no"></iframe>
				</div>
			</div>
	</div><!--advertisement-->

	{{--<div class="video-ads">
	<span class="close" style="margin-right:30px;">x</span> 
		<h1>Video ads</h1>
	</div> --}}

	<div class="play-icon" id ="play-icon">
		<span><img id="replay-icon" src="/img/icons/play-btn.png"/></span>
	</div>

	<div class="vd" style="margin-top:-7px;">
		<div class="wrapper" id="controls">
			<div id="progressbar">
				<div id="progress-ads-line" style="background:transparent;position:relative;width:100%;height:100%">		
					<input  id="seek-slider" type="range" min="0" max="100" step="1" value="0"> 	
					<div id="buffered"></div>
					<div style="display:none" id="current-progress">	
						<div style="display:none" id="button-progress" class="progress-button">		</div>	 
					</div> 
				</div>
			</div><!--/.progress-bar-->

			<span class="img-play">

				<img onclick='togglePlayPause();' id="play-pause" class='play'  src="/img/icons/play.png"/>

				<button style="display:none"type="button" id="play">&#9658;</button> 
			</span>

			<span class="pull-right">
				<span id="time" class="ctime time">{{--TIME DISPLAY HERE--}}</span> 
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
						<div onclick='changeVolume("-")' id="minus-vol" >-</div> --}}				
					</div>
				</span><!--/.sound-->


				<span ><img title="fullscreen" id="fullscreen" class="fullscreen" src="/img/icons/fullscreen.png"></span>
				<div class="hd-setting" style="display:none">
					<small style="text-align:center;color:#fff">HD Quality</small>
					<ul>
						<li> <a id="high-quality" href="#">High</a></li>
						<li> <a id="low-quality" href="#">Low</a></li>
						{{-- <li> <a href="#">480p</a></li>
						<li> <a href="#">360p</a></li>
						<li> <a href="#">240p</a></li> --}}
					</ul>						
				</div><!--/.hd-setting-->
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
				</div><!--/.share-video-->

				<span><img id="hd-setting" title="HD setting" src="/img/icons/setting.png"></span>
				<span><img id="share-video" title="Share video" src="/img/icons/share.png"></span>
				<a href="{{route('public.watch.video','video='.str_random(5))}}"><img src="/img/logos/teflTv.png" class="playerLogo"></a>
			</span><!--/.pull-right-->
		</div><!--/.wrapper-->
	</div><!--/vd-->