//not compatible for EI browser :( by Grald, wanna know more about me just visit my site at w3.geraldburasca.com feel free to contact me gerald.burasca27@gmail.com
//$('#loader').fadeIn();

$('#controls').hide();
$('#ads-hide').hide();
//$('#loader').hide();
$(document).ready(function(){
	$('#controls').fadeIn();
	$('#loader').hide();
});
document.addEventListener("DOMContentLoaded", function() {main();}, false);
var mediaPlayer, percentageloaded, handle, timeout, progressHandle=false, hideControls = false, mouseOverPlayer=false, progWidth, retry, mp4, webm, ogg, vidMp4Scr,vidWebmScr,vidOggScr, buffPercent, percentLoaded, loader, progress, hrs=0, mins=0, secs=0, tmpSecs=0, adsTime = 7, ads=0, vidMinLenght=0, vidSecLenght=0, videoCurrentTime=0,playPauseBtn, timeDuration=0,muteBtn, playIcon = false, replay, _time, curHrs, curMin, curSec, durHrs, durMin, durSec,progressBar, soundHover = false, volumeHover = false, currentTime=0, videoPlaying = false, start = false, error = false,videoTimeLenght,volumes=0, volumeClick = false, mouseX = 0, mouseY = 0, volumeY=0, volumeDrag = false, progressbarClick = false,updProgWidth = 0, videoControls, volumeStatus, bufferedAmount, currentBuffered, currentProgress, playBtn, play, seekSlider,highQual,normalQual, lowQual, fullscreenVid, mouseMoving=false,videoQuality = {'9001p':'highres', '1080p':'hd1080', '720p':'hd720', '480p':'large', '360p':'medium', '240p':'small', '144p':'tiny'};
var player = {
	volume       : '10px',
	fullscreen   : '12px',
	videoQuality : function(e){
		return this.volume;
	}
};
function main(){
	mp4 = document.getElementById('mp4');
	webm = document.getElementById('webm');
	// ogg = document.getElementById('ogg');
	vidMp4Src = mp4.src;vidWebmSrc = webm.src;//vidOggSrc = ogg.src;
	vidMp4Src = vidMp4Src.replace('.mp4','');
	vidWebmSrc = vidWebmSrc.replace('.webm','');
	//vidOggSrc = vidOggSrc.replace('.ogg','');
	retry = document.getElementById('retry-error');
	loader = document.getElementById('loader');
	seekSlider = document.getElementById('seek-slider');
	highQual = document.getElementById('high-quality');
	normalQual = document.getElementById('normal-quality');
	lowQual = document.getElementById('low-quality');
	mediaPlayer = document.getElementById('media-video');
	videoControls = document.getElementById('vid-controls');
	playPauseBtn = document.getElementById('play-pause');
	muteBtn = document.getElementById('mute-icon');
	bufferedAmount = document.getElementById('buffered');
	currentProgress =  document.getElementById('current-progress');
	videoTimeLenght = document.getElementById('video-time-lenght');
	volumeStatus = document.getElementById('volume');
	_time = document.getElementById('time');
	fullscreenVid =  document.getElementById('fullscreen');
	progWidth = document.getElementById('progressbar').offsetWidth;
	progress = document.getElementById('current-progress').offsetWidth;
	play = document.getElementById('play-icon');
	mediaPlayer.controls = false;
	playPauseBtn.addEventListener('click',togglePlayPause, false);
	muteBtn.addEventListener('click',toggleMute, false);
	highQual.addEventListener('click',highQuality, false);
	normalQual.addEventListener('click',normalQuality, false);
	lowQual.addEventListener('click',lowQuality, false);
	retry.addEventListener('click',normalQuality, false);
	bufferedAmount.addEventListener('click',vidSeek, false);
	seekSlider.addEventListener('change',vidSeek, false);
	$(normalQual).css({'color':'#fc8b02'});
	mediaPlayer.addEventListener('timeupdate', seekTimeUpdate, false); //updateProgressBar
	
	mediaPlayer.addEventListener('play', function() {
		changeButtonType(playPauseBtn, 'player pause', 'Pause');
	}, false);

	mediaPlayer.addEventListener('pause', function() {
		changeButtonType(playPauseBtn, 'player play', 'Play');
	}, false);
	
	mediaPlayer.addEventListener('volumechange', function(e){ 
		if (mediaPlayer.muted) {changeButtonType(muteBtn, 'player sound-off', 'Unmute');}
		else {changeButtonType(muteBtn, 'player sound-on', 'Mute'); }
	}, false);	

	mediaPlayer.addEventListener('ended', function(){ 
		$('.play-icon').fadeIn(500);
		videoPlaying = false;
	}, false);

	mediaPlayer.addEventListener('loadedmetadata', metadata, false);
	//mediaPlayer.addEventListener('progress', loadBuffer, false);
	fullscreenVid.addEventListener('click', toggleFullScreen, false); //fullscreen toggleFullScreen
	volumeStatus.addEventListener('change', setVolume, false);
	mediaPlayer.addEventListener('error', hasError, false);
	mediaPlayer.addEventListener('canplay', canPlayVideo, false);
	mediaPlayer.addEventListener('canplaythrough', canPlayVideo, false);
	//mediaPlayer.addEventListener('playing', loadBuffer, false);
	//seekSlider.addEventListener('seeking', seekingNewPosition, false);
}
function metadata(){
	timeDuration = Math.round(mediaPlayer.duration);
	timeSettings();
	adsOn();
	//togglePlayPause();
}
function checkInternet(){
	var online = navigator.onLine;
	return online;
}

function loadBuffer(){
	if(mediaPlayer.buffered.length > 0){
		buffPercent = mediaPlayer.buffered.end(0);
		percentLoaded = Math.floor((buffPercent / mediaPlayer.duration) * 100);
		percentageloaded = Math.round(percentLoaded / percentLoaded  * 100);
		$('#buffered').css({'width': percentLoaded + '%'});
	}
	if(mediaPlayer.networkState === mediaPlayer.NETWORK_LOADING){
		$('.play-icon').fadeOut();
		$(loader).fadeIn();
	 }else if(mediaPlayer.networkState === mediaPlayer.HAVE_ENOUGH_DATA){
	 	$(loader).fadeOut();
	 }
	else{
		$(loader).fadeOut();
	}
	
}
function canPlayVideo() { //buffering done...
	$(loader).fadeOut();
	loadBuffer();
}
function onWaitingBuffer() { //buffering occur...
	
}
function hasError(){
  $('#error-video').html('An error occured please try later.').css({'color':'#fff'});
}
function seekingNewPosition() { //find new position
    var seekTo = mediaPlayer.duration * (seekSlider.value / 100);
	mediaPlayer.currentTime = seekTo;
}

$('#media-video').bind("contextmenu", function(){
	return false;
});
$('#media-video').bind('ended', function(){
	if(!this.paused) this.pause();
});
$('#media-video').bind('progress', function(){
	loadBuffer();
});
$('#media-video').bind('loadeddata', function(){
	loadBuffer();
});
$('#media-video').bind('canplaythrough', function(){
	loadBuffer();
});
$('#media-video').bind('playing', function(){
	loadBuffer();
});
function changeVidQuality(mp4Ext,webmExt,oggExt){
	$('#error-video').fadeIn();
	$('#error-video').html('Please wait...').css({'color':'#fff'});
	var newSrc;
	newSrc = vidMp4Src+mp4Ext;mp4.setAttribute('src', newSrc);
	newSrc = vidWebmSrc+webmExt;webm.setAttribute('src', newSrc);
	//newSrc = vidOggSrc+oggExt;ogg.setAttribute('src', newSrc);
	if(mediaPlayer.canPlayType("video/mp4")){
		mp4.addEventListener('error', checkVideo, false);
	}else if(mediaPlayer.canPlayType("video/webm")){
		webm.addEventListener('error', checkVideo, false);
	 }
	 //else if(mediaPlayer.canPlayType("video/ogg")){
	// 	ogg.addEventListener('error', checkVideo, false);
	// }
 	mediaPlayer.pause();mediaPlayer.load();mediaPlayer.play();
    mediaPlayer.addEventListener('canplaythrough', function(){
    	$('#error-video').fadeOut();
    },false);
    mediaPlayer.addEventListener('canplay', function(){
    	$('#error-video').fadeOut();
    }, false);
    
}
function highQuality(e){
	e.preventDefault();$('#play-icon').fadeOut('fast');$(loader).fadeIn('fast');$(highQual).css({'color':'#fc8b02'});$(normalQual).css({'color':'#fff'});$(lowQual).css({'color':'#fff'});
	changeVidQuality('_hd.mp4','_hd.webm','_hd.ogg');
	//var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0, isFirefox = typeof InstallTrigger !== 'undefined', isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0, isChrome = !!window.chrome && !isOpera, isIE = /*@cc_on!@*/false || !!document.documentMode;  
}
function normalQuality(e){
	e.preventDefault();$('#play-icon').fadeOut('fast');$(loader).fadeIn('fast');$(highQual).css({'color':'#fff'});$(normalQual).css({'color':'#fc8b02'});$(lowQual).css({'color':'#fff'});
	changeVidQuality('.mp4','.webm','.ogg');
}
function lowQuality(e){
	e.preventDefault();$('#play-icon').fadeOut('fast');$(loader).fadeIn('fast');$(highQual).css({'color':'#fff'});$(normalQual).css({'color':'#fff'});$(lowQual).css({'color':'#fc8b02'});
	changeVidQuality('_low.mp4','_low.webm','_low.ogg');
}
function checkVideo(){
	$(loader).fadeOut('fast');
	$('#error-video').html('Video is not ready please try later.').css({'color':'#fff'});
}
function hideLoader(){
	$(loader).fadeIn();
}
function vidSeek(){
	var seekTo = mediaPlayer.duration * (seekSlider.value / 100);
	mediaPlayer.currentTime = seekTo;
}
function seekTimeUpdate(){
	// updProgWidts = Math.floor((mediaPlayer.currentTime / mediaPlayer.duration) * progWidth);
	updProgWidth = mediaPlayer.currentTime * (100 / mediaPlayer.duration);
	$('#current-progress').css({'width' : updProgWidth + '%', 'position' : 'relative'});
	 handle = Math.floor(updProgWidth / mediaPlayer.duration * progWidth);
	$('#button-progress').css({'left' : '99%', 'position' : 'absolute'});
	console.log(handle);
	var currentSeek = mediaPlayer.currentTime * (100 / mediaPlayer.duration);
	seekSlider.value = currentSeek;
	 curHrs = Math.floor(mediaPlayer.currentTime / 3600);
	 curMin = Math.floor(mediaPlayer.currentTime / 60);
	 curSec = Math.floor(mediaPlayer.currentTime - (curMin * 60));
	 durHrs = Math.floor(curMin / 60);
	 durMin = Math.floor(mediaPlayer.duration / 60);
	 durSec = Math.floor(mediaPlayer.duration - (durMin  * 60));
	if(curSec < 10){curSec = "0"+curSec;}
	if(durSec < 10){durSec = "0"+durSec;}
	_time.innerHTML = curHrs + ':' + curMin + ':' + curSec + '/' + durHrs + ':' + durMin + ':' +durSec;
	if(timeDuration >= 3600){
		_time.innerHTML = curHrs + ':' + curMin + ':' + curSec + '/' + durHrs + ':' + durMin + ':' +durSec;
	}else{
		_time.innerHTML = curMin + ':' + curSec + '/' + durMin + ':' +durSec;
	}
	if(Math.floor(mediaPlayer.currentTime) == adsTime){
		$('.advertisement').fadeIn(2000);
	}
	checkVid();
	loadBuffer();
}

function checkVid(){
	if(isNaN(durSec)){
		$('.ctime').html('');
		//$('#error-video').html('An error occured please try later...').css({'color':'#fff'});
		$('#error-video').fadeIn();	
		$(loader).fadeOut('fast');	
		seekSlider.value=0;
	}else{
		//$('#error-video').fadeOut();	
		$(loader).fadeOut('fast');
	}
}

function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (mediaPlayer.requestFullscreen) {
      mediaPlayer.requestFullscreen();
    } else if (mediaPlayer.msRequestFullscreen) {
      mediaPlayer.msRequestFullscreen();
    } else if (mediaPlayer.mozRequestFullScreen) {
      videoControls.mozRequestFullScreen();
    } else if (mediaPlayer.webkitRequestFullscreen) {
    	mediaPlayer.webkitRequestFullscreen();
      //mediaPlayer.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      //videoFullScreen.request(document.getElementById('media-video'));
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

function adsOn(){
	//ads = Math.floor(timeDuration * adsTime / 100);
	ads = (adsTime / timeDuration) * 100;
	//ads = Math.round(100 / ads);
	var adsbar = Math.floor(progWidth/adsTime);
	$('<div class="ads"> <div style="z-index:1111;background:yellow;position:absolute;right:0;height:100%;width:5px;"></div></div>').prependTo('#progress-ads-line');
	$('.ads').css({'border-radius':'2px', 'background':'transparent','width': ads + '%', 'height':'100%', 'position':'absolute'});
	
}
function timeSettings(){
	vidMinLenght = Math.floor(mediaPlayer.duration / 60);
	vidSecLenght = Math.round(mediaPlayer.duration - (vidMinLenght * 60));
	hrs = Math.floor(vidMinLenght / 60);
	mins =  (vidMinLenght - (hrs * 60));
	secs =   Math.floor(mediaPlayer.duration - (vidMinLenght * 60));
	if(secs < 10) { secs = '0'+ secs; }
	if(vidSecLenght < 10) { vidSecLenght = '0'+ vidSecLenght; }
	if(mins < 10) { mins = '0'+ mins; }
	if(hrs < 10) { hrs = '0'+ hrs; }
	if(timeDuration < 3600){
		$('.ctime').html(vidMinLenght + ':' + vidSecLenght);
	}else{
		$('.ctime').html(hrs + ':' + mins + ':' + secs);
	}
	
}
function toggleShowHanldeProgress(){
	if(mediaPlayer.paused || mediaPlayer.ended){
		$('#button-progress').fadeIn();
	}else{
		$('#button-progress').fadeOut();
	}
}
function togglePlayPause(){
	// If the mediaPlayer is currently paused or has ended
	// var online = checkInternet();
	// if(online==false){
	// 	$('#error-video').html('Sorry, no internet connection...').css({'color':'#fff'});
	// 	if(videoPlaying){mediaPlayer.pause();return false;}
	// }
	if (mediaPlayer.paused || mediaPlayer.ended) {
		toggleShowHanldeProgress();
		changeButtonType(playPauseBtn, 'player pause', 'Pause');
		mediaPlayer.play();
		videoPlaying = true;
		playIcon = false;
		$('.play-icon').fadeOut(500);
	}
	// Otherwise it must currently be playing
	else {
		changeButtonType(playPauseBtn, 'player play','Play');
		toggleShowHanldeProgress();
		mediaPlayer.pause();
		videoPlaying = false;
		playIcon=true;
		$('.play-icon').fadeIn(500);
		
	}
}

// Stop the current media from playing, and return it to the start position
function stopPlayer() {
	mediaPlayer.pause();
	mediaPlayer.currentTime = 0;
}

// Changes the volume on the media player
function changeVolume(sign) {
	// if (sign === '+') mediaPlayer.volume += mediaPlayer.volume == 1 ? 0 : 0.1;
	// else mediaPlayer.volume -= (mediaPlayer.volume == 0 ? 0 : 0.1);
	// mediaPlayer.volume = parseFloat(mediaPlayer.volume).toFixed(1);
	if(sign==='-'){
			var minus = Math.floor(100 * 0.1); 
			volume -= minus;
			mediaPlayer.volume -=  0.1;
			$('#volume-vertical').css({'height':  volume + '%', 'background':'#337AB7'});
			$('.volume-static-holder').css({'overflow':'hidden'});
			 if(volume < 10){
			 	volume = 10;
			 	$('#volume-vertical').css({'height': volume + '%', 'background':'#337AB7'});
			 	$('#volume-button').css({'background':'red'});
			 	mediaPlayer.volume = 0;
			 }
	}else{
			var plus = Math.floor(100 * 0.1);
			volume = volume + plus;
			mediaPlayer.volume +=  0.1;
			$('#volume-vertical').css({'height':  volume + '%', 'background':'#337AB7'});
			$('.volume-static-holder').css({'overflow':'hidden'});
			if(volume > 90){
			 	volume = 100;
			 	$('#volume-vertical').css({'height': volume + '%', 'background':'#337AB7'});
			 	mediaPlayer.volume = 1;
			 }
			 if(volume > 10){
			 	$('#volume-button').css({'background':'#fff'});
			 }
	}
}
function setVolume(){
	mediaPlayer.volume = volumeStatus.value / 100;
}
// Toggles the media player's mute and unmute status
function toggleMute() {
	if (mediaPlayer.muted) {
		// Change the button to be a mute button
		changeButtonType(muteBtn, 'player sound-on','Mute');
		//muteBtn.src = "/img/icons/sound.png";
		mediaPlayer.muted = false;
		volumeStatus.value = 100; 
	}
	else {
		// Change the button to be an unmute button
		changeButtonType(muteBtn,'player sound-off', 'Unmute');
		//muteBtn.src = "/img/icons/sound-off.png";
		mediaPlayer.muted = true;
		volumeStatus.value = 0;	
	}
}

// Replays the media currently loaded in the player
function replayMedia() {
	resetPlayer();
	mediaPlayer.play();
}

// Update the progress bar
function updateProgressBar(response) {
	// Work out how much of the media has played via the duration and currentTime parameters
	var percentage = Math.floor((100 / mediaPlayer.duration) * mediaPlayer.currentTime),
	 time = Math.floor(($(currentProgress).width() / progWidth) * mediaPlayer.duration),
	 vidMin = Math.floor(mediaPlayer.duration / 60),

	 vidSec = Math.round(mediaPlayer.duration - (vidMin * 60)),
	 videoCurrentTime = Math.round(mediaPlayer.currentTime),
	 seconds = 0,
			hours = Math.floor(time / 3600),
			minutes = Math.floor(time / 60),
				// seconds are equal to the time minus the minutes
				seconds = (videoCurrentTime - (60 * minutes));
				// So if seconds go above 59 and increase minutes, reset seconds
				if(seconds > 59){
					seconds = Math.floor(videoCurrentTime - (60 * minutes));
					minutes = Math.floor(videoCurrentTime / 60); 
					seconds = 0;
				}	
				if(minutes > 59){
					hours = Math.floor(time / 3600); 
					minutes = 0;
					seconds = 0;
				}				 
				// Updated progress width
					updProgWidth = Math.floor((videoCurrentTime / mediaPlayer.duration) * progWidth);
					
					// Set a zero before the number if its less than 10.
					if(seconds < 10) { seconds = '0'+ seconds; }
					if(vidSecLenght < 10) { vidSecLenght = '0'+ vidSecLenght; }
					if(minutes < 10) { minutes = '0'+ minutes; }
					if(hours < 10) { hours = '0'+ hours; }
					if(videoCurrentTime < 10){ videoCurrentTime = '0' + videoCurrentTime;}
					// A variable set which we'll use later on

					if(response != true) {
						  //currentProgress.style.width = ((mediaPlayer.currentTime / timeDuration)*100) + "%";
						  //$(currentProgress).css({'width' : ((mediaPlayer.currentTime / timeDuration)*100) + "%"});
						 $(currentProgress).css({'width' : updProgWidth+'px'});
						 $('#button-progress').css({'left' : (updProgWidth-$('#button-progress').width())+'px'});
					}

					
					//$('#button-progress').css({'left' : (currentProgress-$('#button-progress').width())+'px'});
					//currentProgress.style.width = ((mediaPlayer.currentTime / timeDuration)*100) + "%";
					//Update time
					if(Math.floor(mediaPlayer.duration) >= 3600){ 
							$('.ctime').html(hours +':' + minutes + ':' + seconds + '/' + hrs + ':' + mins + ':' + secs);				
					}else{
						
						$('.ctime').html(minutes + ':' + seconds +'/' + vidMin + ':' + vidSec);
					}

					if(seconds == adsTime){
						$('.advertisement').fadeIn(2000);
					}
									
}


function changeButtonType(btn, toggleclass, title) {
	btn.title = title;
	btn.className = toggleclass;
}

// Loads a video item into the media player
function loadVideo() {
	for (var i = 0; i < arguments.length; i++) {
		var file = arguments[i].split('.');
		var ext = file[file.length - 1];
		// Check if this media can be played
		if (canPlayVideo(ext)) {
			// Reset the player, change the source file and load it
			resetPlayer();
			mediaPlayer.src = arguments[i];
			mediaPlayer.load();
			break;
		}
	}
}

// Checks if the browser can play this particular type of file or not
function canPlayVideo(ext) {
	var ableToPlay = mediaPlayer.canPlayType('video/' + ext);
	if (ableToPlay == '') return false;
	else return true;
}

// Resets the media player
function resetPlayer() {
	progress = 0;
	mediaPlayer.currentTime = 0;
	changeButtonType(playPauseBtn, 'player play', 'Play');
}

function fullscreen(){
videoFullScreen.request(document.getElementById('media-video'));
//screenfull.request($('.wrapper')[0]);		
}
$('#mute-icon').hover(function(){
	soundHover=true;
	if(soundHover==true){
		$('.volume').fadeIn(1000);	
		setTimeout(function(){
			$('.volume').fadeOut(500);
		},7000);
	}	
});
$('.volume, .volume-static-holder, #volume-vertical').hover(function(){	
	soundHover=false;
 // if ( typeof scrollFunc.x == 'undefined' ) {
 //        scrollFunc.x=window.pageXOffset;
 //        scrollFunc.y=window.pageYOffset;
 //    }
 //    var diffX=scrollFunc.x-window.pageXOffset;
 //    var diffY=scrollFunc.y-window.pageYOffset;
 //    if(diffY < 0){
 //    	alert('down');
 //    }
 //    if(diffY > 0){
 //    	alert('up');
 //    }
	
});
$('.volume').mouseleave(function(){
	if(soundHover==false){
		$('.volume').fadeOut(1000);
	}
});

$('#volume-vertical').mousedown(function(e){
	LetProcessYourVolume(e)
});

$('.volume-static-holder').mousedown(function(e){
	LetProcessYourVolume(e);
});

// $('#volume-button').mousedown(function(e){
// 	volumeDrag = true;
// 	if(volumeDrag==true){
// 		LetProcessYourVolume(e);
// 	}
// });

function LetProcessYourVolume(e){
	volumeClick = true;
	mouseY = $('.volume-static-holder').height() - (e.pageY - $('.volume-static-holder').offset().top);
	// Return false if user tries to click outside volume area 
		if(mouseY < 0 || mouseY > $(this).height()) {
			volumeClick = false;
			return false;
		}

	// Update volume of CSS
		$('#volume-vertical').css({'height' : mouseY+'px'});
		$('#volume-button').css({'top' : (mouseY-($('#volume-button').height()/2))+'px'});

	// Update your volume it's happening :)
		mediaPlayer.volume = $('#volume-vertical').height() / $(this).height();
		volumeY = $('#volume-vertical').height() / $(this).height();
		
		if($('#volume-vertical').height() < 15){
			$('#volume-button').css({'background':'red'});
			$('#volume-vertical').css('overflow','hidden');
		}else{
			$('#volume-button').css('background','#fff');
		}
}


$('#progressbar').bind('mousedown', function(e) {	
	videoForwardBackward(e);	
});
$('#buffered').bind('mousedown', function(e) {	
	videoForwardBackward(e);
});
$(currentProgress).bind('mousedown', function(e) {	
	videoForwardBackward(e);
});
$('#button-progress').mousedown(function(e) {	
	progressHandle = true;
});
$('html, body').mouseup(function(e) {	
	progressHandle = false;
});
$('html, body').mousemove(function(e){
	if(progressHandle==true){
		mouseX = e.pageX - $('#current-progress').offset().left;
		currentTime = (Math.floor(mouseX) /  Math.floor(progWidth)) * Math.floor(mediaPlayer.duration);
		if(currentTime>mediaPlayer.currentTime) {mediaPlayer.currentTime += 2;}
		else {mediaPlayer.currentTime -= 2;}
	}
});
function videoForwardBackward(e){
	mouseX = e.pageX - $('#current-progress').offset().left;
	currentTime = (Math.floor(mouseX) /  Math.floor(progWidth)) * Math.floor(mediaPlayer.duration);
	mediaPlayer.currentTime = currentTime;
}

$('#hd-setting').bind('click', function(){
  $('.hd-setting').toggle('show');
 $('.share-video').fadeOut();
});

$('#share-video').bind('click', function(){
  $('.share-video').toggle('show');
  $('.hd-setting').fadeOut();
});

$('.play-icon').bind('click', function(){
	togglePlayPause();
	if(playIcon==false){
		$(this).fadeOut(500);
		playIcon=true;
	}else{$('.play-icon').fadeIn(500);}	
	$('.play-icon').fadeOut(500);
});
$('#media-video').bind('click', function(){
	togglePlayPause();
	if(playIcon==true){
		$('.play-icon').fadeIn(500);
		playIcon=false;
	}else{$('.play-icon').fadeOut(500);playIcon=true;}
});
$('.close').bind('click', function(){
	$('.advertisement').fadeOut(500);
	$('#ads-hide').fadeIn();
});
$('#ads-hide').bind('click', function(){
	$('.advertisement').fadeIn(1000);
	$('#ads-hide').fadeOut();
});
$('#media-video, #controls, .play-icon').mouseover(function(){
	mouseOverPlayer = true;
});
$('#media-video, #controls, .play-icon').mouseleave(function(){
	mouseOverPlayer = false;
});
$('html, body').mousemove(function(){
	if(mouseOverPlayer){$('#controls').fadeIn(500);hideControls=false;}else{$('#controls').fadeOut('fast');hideControls=true;}
	timeoutMouseMove(5000);
	$('#ads-hide').css({'bottom':'50px'});
});

function timeoutMouseMove(milliseconds){
	clearTimeout(timeout);
  	timeout = setTimeout(function(){$('#controls').fadeOut(500);$('#ads-hide').css({'bottom':'0px'});}, milliseconds);
}






