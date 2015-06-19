	
	<div class="play-icon" id="play-icon">
		<div class="triangle-icon"></div>
	</div>

	<div class="load-video" id="loader">
	<div class="spinner2" id='spinner'>
		<div class="spinner2-containerb containerb1">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
		<div class="spinner2-containerb containerb2">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
		<div class="spinner2-containerb containerb3">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
	</div>
</div>
	<div class="error-video" id="error-video">
		<small>
			Video not available this time please try later. <a href="#" id="retry-error">Retry.</a> 
		</small>
	</div>

	<div id='ads-hide'>
		<center><span class='glyphicon glyphicon-chevron-up'></span></center>
	</div>
	
	
	<div class="vd" style="margin-top:-7px;">
		<div class="wrapper" id="controls">
			<div id="progressbar">
				<div id="progress-ads-line"  class="prog-ads-line">		
					<input style="display:none" id="seek-slider" type="range" min="0" max="100" step="1" value="0"> 	
					<div id="buffered"></div>
					<div  id="current-progress">	
						<div id="button-progress" class="progress-button">
						</div>	 
					</div> 
				</div>
			</div><!--/.progress-bar-->

			<span class='img-play'>
				<i id='play-pause' class='player play' title='Play'></i>
				<i id='vid-error'></i>
			</span>

			<span class="pull-right">
				<span id="time" class="ctime time" >{{--TIME DISPLAY HERE--}}</span> 
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
					<small class="vp-text">Video Quality</small>
					<ul>
						<li> <a title='HD mode' id="high-quality" href="#">High</a></li>
						<li> <a title='Normal mode' id="normal-quality" href="#">Normal</a></li>
						<li> <a title='Low mode' id="low-quality" href="#">Low</a></li>
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
				<i id='hd-setting' title='Video Quality' class='player setting'></i>
				<i id='share-video' title='Share video' class='player share'></i>
				{{-- <i id='cc' title='Subtitle' style='color:#fff;cursor:pointer'>CC</i> --}}
				<img src="/img/logos/teflTv.png" class="playerLogo">

			</span><!--/.pull-right-->
		</div><!--/.wrapper-->
	</div><!--/vd-->


	
