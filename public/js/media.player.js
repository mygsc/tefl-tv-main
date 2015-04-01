//not compatible for EI browser :( by Gerald
document.addEventListener("DOMContentLoaded", function() {GSCMediaPlayer();}, false);
var mediaPlayer, hrs=0, mins=0, secs=0, tmpSecs=0, adsTime = 2, ads=0, vidMinLenght=0, vidSecLenght=0, videoCurrentTime=0,
	playPauseBtn, timeDuration=0,
 	muteBtn, playIcon = false, replay, _time, curHrs, curMin, curSec, durHrs, durMin, durSec,
 	progressBar, soundHover = false, volumeHover = false, currentTime=0, videoPlaying = false, start = false,
 	videoTimeLenght,  
 	volumes=0, volumeClick = false, mouseX = 0, mouseY = 0, volumeY=0, volumeDrag = false, progressbarClick = false,
 	updProgWidth = 0, videoControls, volumeStatus, bufferedAmount, currentBuffered, currentProgress, playBtn, play, seekSlider,
 	highQual, lowQual, fullscreenVid, mouseMoving=false;

var progWidth;
var progress;
var videoQuality = {'9001p':'highres', '1080p':'hd1080', '720p':'hd720', '480p':'large', '360p':'medium', '240p':'small', '144p':'tiny'};
var animate360 = document.getElementById('button-progress');
var controlBar = "#controls";
//Events
function GSCMediaPlayer(){
	play = document.getElementById('play');
	seekSlider = document.getElementById('seek-slider');
	highQual = document.getElementById('high-quality');
	lowQual = document.getElementById('low-quality');
	mediaPlayer = document.getElementById('media-video');
	videoControls = document.getElementById('vid-controls');
	playPauseBtn = document.getElementById('play-pause');
	replay = document.getElementById('replay-icon');
	muteBtn = document.getElementById('mute-icon');
	bufferedAmount = document.getElementById('buffered');
	currentProgress =  document.getElementById('current-progress');
	videoTimeLenght = document.getElementById('video-time-lenght');
	volumeStatus = document.getElementById('volume');
	_time = document.getElementById('time');
	fullscreenVid =  document.getElementById('fullscreen');
	progWidth = document.getElementById('progressbar').offsetWidth;
	progress = document.getElementById('current-progress').offsetWidth
	mediaPlayer.controls = false;
	play.addEventListener('click',PlayOrPause, false);
	highQual.addEventListener('click',highQuality, false);
	lowQual.addEventListener('click',lowQuality, false);
	seekSlider.addEventListener('change',vidSeek, false);

	mediaPlayer.addEventListener('timeupdate', seekTimeUpdate, false); //updateProgressBar
	
	mediaPlayer.addEventListener('play', function() {
		changeButtonType(playPauseBtn, 'pause');
	}, false);

	mediaPlayer.addEventListener('pause', function() {
		changeButtonType(playPauseBtn, 'play');
	}, false);
	
	
	mediaPlayer.addEventListener('volumechange', function(e){ 
		if (mediaPlayer.muted) {changeButtonType(muteBtn, 'unmute');}
		else {changeButtonType(muteBtn, 'mute'); }
	}, false);	

	mediaPlayer.addEventListener('ended', function(){ 
		playPauseBtn.src = "/img/icons/play.png";
		$('.play-icon').fadeIn(500);
		$('.advertisement').fadeOut(1000);
		videoPlaying = false;
	}, false);

	mediaPlayer.addEventListener('loadedmetadata', function(){
		timeDuration = Math.round(mediaPlayer.duration);
		timeSettings();
		adsOn();
		mediaPlayer.addEventListener('progress', loadBuffer, false);
		
	});
	fullscreenVid.addEventListener('click', toggleFullScreen, false);//fullscreen toggleFullScreen
	volumeStatus.addEventListener('change', setVolume, false);
	mediaPlayer.addEventListener('error', hasError, false);
	//mediaPlayer.addEventListener('canplay', canPlayVideo, false);
	//mediaPlayer.addEventListener('waiting', onWaitingBuffer, false);
	//seekSlider.addEventListener('seeking', seekingNewPosition, false);
}

function loadBuffer(){
	if(mediaPlayer.buffered.length > 0){
			var buffPercent = mediaPlayer.buffered.end(0);
			var percentLoaded = Math.floor((buffPercent / timeDuration) * 100);
			$('#buffered').css({'width': percentLoaded + '%'});
			if(mediaPlayer.currentTime >= percentLoaded){
				$('#replay-icon').fadeIn();
				replay.src="/img/icons/uploading.gif";
				replay.width = 80;
				replay.height = 80;
			}else{
				replay.src="/img/icons/play-btn.png";
				replay.width = 80;
				replay.height = 80;
			}
		}else{
			console.log('no buffer recieved...');
		}
}
function canPlayVideo() { //buffering done...
	$('.play-icon').fadeOut();
	replay.src="/img/icons/post_play_button.png";
	replay.width = 50;
	replay.height = 50;
}
function onWaitingBuffer() { //buffering occur...
	$('.play-icon').fadeIn();
	replay.src="/img/icons/uploading.gif";
	replay.width = 50;
	replay.height = 50;
}
function seekingNewPosition() { //find new position
    var seekTo = mediaPlayer.duration * (seekSlider.value / 100);
	mediaPlayer.currentTime = seekTo;
}

function disabledRightClick(){
	$('#media-video').bind("contextmenu", function(){
    return false;
	});
  }
 function hasError(){
 	mediaPlayer.poster = '/img/error.png';
 }
//list of bind more realiable codes....
$('#media-video').bind("contextmenu", function(){
    return false;
	});

$('#media-video').bind('ended', function(){
     if(!this.paused) this.pause();
     $('.advertisement').fadeOut(1000);
});

function highQuality(e){
	e.preventDefault();
	alert('Sorry, no available high quality, under development.');
}
function lowQuality(e){
	e.preventDefault();
	alert('Sorry, no available low quality, under development.');
}

function PlayOrPause(){
	if(mediaPlayer.paused){
		mediaPlayer.play();
		play.innerHTML = '&#10074;&#10074;';
		$('div.play-icon').fadeOut();
	}else{
		mediaPlayer.pause();
		play.innerHTML = '&#9658;';
		$('div.play-icon').fadeIn(500);
	}
}
function vidSeek(){
	var seekTo = mediaPlayer.duration * (seekSlider.value / 100);
	mediaPlayer.currentTime = seekTo;
}
function seekTimeUpdate(){
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
	if(curSec == adsTime){
		$('.advertisement').fadeIn(2000);
	}
	
}

// document.addEventListener("keydown", function(e) {
//   if (e.keyCode == 32) {
//     togglePlayPause();
//   }
// }, false);

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
	$('<div class="ads"> <div style="border-radius:2px;background:yellow;position:absolute;right:0;height:100%;width:5px;"></div></div>').prependTo('#progress-ads-line');
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
function togglePlayPause() {
	// If the mediaPlayer is currently paused or has ended
	if (mediaPlayer.paused || mediaPlayer.ended) {
		toggleShowHanldeProgress();
		playPauseBtn.src = "/img/icons/pause.png";
		changeButtonType(playPauseBtn, 'pause');
		mediaPlayer.play();
		videoPlaying = true;
		playIcon = false;
		$('.play-icon').fadeOut(500);
	}
	// Otherwise it must currently be playing
	else {
		changeButtonType(playPauseBtn, 'play');
		toggleShowHanldeProgress();
		playPauseBtn.src = "/img/icons/play.png";
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
		changeButtonType(muteBtn, 'mute');
		muteBtn.src = "/img/icons/sound.png";
		mediaPlayer.muted = false;
		volumeStatus.value = 100; 
	}
	else {
		// Change the button to be an unmute button
		changeButtonType(muteBtn, 'unmute');
		muteBtn.src = "/img/icons/sound-off.png";
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
	 time = Math.floor(($('#current-progress').width() / progWidth) * mediaPlayer.duration),
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
						  //$('#current-progress').css({'width' : ((mediaPlayer.currentTime / timeDuration)*100) + "%"});
						 $('#current-progress').css({'width' : updProgWidth+'px'});
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

//Let's calculate amount buffering progress....
function bufferedPercent(){
    if (mediaPlayer.networkState === mediaPlayer.NETWORK_LOADING) {
    	setInterval(bufferedPercent, 1000);
    	$('.play-icon').fadeIn();
    	replay.src = '/img/icons/uploading.gif';
    	replay.width = 50; 
    	replay.height = 50;
	}else{
		replay.src = '/img/icons/post_play_button.png';
		$('.play-icon').fadeOut(500);
	}
}

function changeButtonType(btn, value) {
	btn.title = value;
	btn.innerHTML = value;
	btn.className = value;
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
	changeButtonType(playPauseBtn, 'play');
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
		},10000);
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


//$('#progressbar').bind('mousedown', function(e) {	
	// progressbarClick = true;
	// mouseX = e.pageX - $('#current-progress').offset().left;
	// currentTime = (Math.floor(mouseX) /  Math.floor(progWidth)) * Math.floor(mediaPlayer.duration);
	// mediaPlayer.currentTime(currentTime) 	
//});


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
	$('.advertisement').fadeOut(1000);
});

// $('#media-video').bind('mouseleave', function(){
// 	$('#controls').fadeOut();
// });
// $('#media-video,#controls').bind('mouseover', function(){
// 	$('#controls').fadeIn();
// });





