	<!--advertisement-->
	<div class="advertisement" style="display:none">
		<div class="span12" style="background:rgba(0,0,0, 0.15)">
			<div class="col-md-10 col-md-offset-1">
				<span class="close">x</span> 
				<iframe src="http://ctrlq.org/sandbox/adsense/?at=image&is=728x90&gl=default&url=nintendo" class="img-responsive" width="100%" frameborder="0" scrolling="no"></iframe>
			</div>
		</div>
	</div>
	<!--advertisement-->
	{{-- <div class="video-ads" id="vid-annotation"></div> --}} 
	{{-- <div id="vid-wrap"> --}}
	<div class="play-icon" id="play-icon"></div>
	<div class="load-video" id="loader"></div>
	<div class="error-video" id="error-video"><small>Error: Please try again later. <a href="#" id="retry-error">Retry.</a></small></div>
	{{-- </div> --}}
	
	<div class="vd" style="margin-top:-7px;">
		<div class="wrapper" id="controls">
			<div id="progressbar">
				<div id="progress-ads-line"  class="prog-ads-line">		
					<input  id="seek-slider" type="range" min="0" max="100" step="1" value="0"> 	
					<div id="buffered"></div>
					<div style="display:none" id="current-progress">	
						<div style="display:none" id="button-progress" class="progress-button">		</div>	 
					</div> 
				</div>
			</div><!--/.progress-bar-->

			<span class='img-play'>
				<i id='play-pause' class='player play' title='Play'></i>
				<i id='vid-error'></i>
			</span>

			<span class="pull-right">
				<span id="time" class="ctime time">{{--TIME DISPLAY HERE--}}</span> 
				<span class="sound" title="Volume">
				<i id='mute-icon' class='player sound-on'></i>
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
				<i id='fullscreen' class='player fullscreen' title='Fullscreen'></i>
				<div class="hd-setting" style='display:none'>
					<small class="vp-text">Mode</small>
					<ul>
						<li> <a id="high-quality" href="#">High</a></li>
						<li> <a id="low-quality" href="#">Low</a></li>
						{{-- <li> <a href="#">480p</a></li>
						<li> <a href="#">360p</a></li>
						<li> <a href="#">240p</a></li> --}}
					</ul>						
				</div><!--/.hd-setting-->
				<div class="share-video" style="display:none">
					<small class="vp-text">Share to:</small>
					<ul>
						<a target="_blank" href="http://www.facebook.com/share.php?u={{URL::asset('/')}}watch!v=7gfUxVixcrz&title=static"><i class="socialMedia socialMedia-facebook" title="Share on Facebook"></i></a>
						<a target="_blank" href="http://twitter.com/home?status=static+www.test.tefltv.com/watch!v=7gfUxVixcrz"> <i class="socialMedia socialMedia-twitter" title="Share on Twitter"></i></a>
						<a target="_blank" href="https://plus.google.com/share?url=www.test.tefltv.com/watch!v=7gfUxVixcrz"><i class="socialMedia socialMedia-googlePlus" title="Share on Google+"></i></a>
						<a target="_blank" href="http://www.tumblr.com/share?v=3&u=www.test.tefltv.com/watch!v=7gfUxVixcrz&t=static"><i class="socialMedia socialMedia-tumblr" title="Share on Tumblr"></i></a>
						<!--<a href=""><i class="socialMedia socialMedia-flickr" title="Share on Flickr"></i></a>
						<a href=""><i class="socialMedia socialMedia-pinterest" title="Share on Pinterest"></i></a>
						<a href=""><i class="socialMedia socialMedia-blogger" title="Share on Blogger"></i></a>-->

					</ul>							
				</div><!--/.share-video-->
				<i id='hd-setting' title='HD setting' class='player setting'></i>
				<i id='share-video' title='Share video' class='player share'></i>
				{{-- <i id='cc' title='Subtitle' style='color:#fff;cursor:pointer'>CC</i> --}}
				<img src="/img/logos/teflTv.png" class="playerLogo">

			</span><!--/.pull-right-->
		</div><!--/.wrapper-->
	</div><!--/vd-->