
document.addEventListener("DOMContentLoaded", function() { GSCMediaPlayer(); }, false);

var mediaPlayer, hourso=0, minuto=0, secondo=0,
	playPauseBtn,
 	muteBtn, playIcon = false,
 	progressBar, soundHover = false, volumeHover = false, currentTime, videoPlaying = false,
 	videoTimeLenght, $this = $(this), 
 	volume, volumeClick = false, mouseX = 0, mouseY = 0, volumeY, volumeDrag = false, progressbarClick = false,
 	updProgWidth = 0;

var progWidth = document.getElementById('progressbar').offsetWidth;
var progress = document.getElementById('current-progress').offsetWidth;
var plusVol = document.getElementById('plus-vol').offsetHeight;
var volumeBar = $('#volume-vertical').height();
var videoQuality = {'9001p':'highres', '1080p':'hd1080', '720p':'hd720', '480p':'large', '360p':'medium', '240p':'small', '144p':'tiny'};
function GSCMediaPlayer(){
	mediaPlayer = document.getElementById('media-video');
	playPauseBtn = document.getElementById('play-pause');
	muteBtn = document.getElementById('mute-icon');
	progressBar = document.getElementById('progress-bar');
	currentProgress =  document.getElementById('current-progress');
	videoTimeLenght = document.getElementById('video-time-lenght');
	mediaPlayer.controls = false;
	// Add a listener for the timeupdate event so we can update the progress bar
	mediaPlayer.addEventListener('timeupdate', updateProgressBar, false);
	// Add a listener for the play and pause events so the buttons state can be updated
	mediaPlayer.addEventListener('play', function() {
		// Change the button to be a pause button
		changeButtonType(playPauseBtn, 'pause');
	}, false);
	mediaPlayer.addEventListener('pause', function() {
		// Change the button to be a play button
		changeButtonType(playPauseBtn, 'play');
	}, false);
	// need to work on this one more...how to know it's muted?
	mediaPlayer.addEventListener('volumechange', function(e) { 
		// Update the button to be mute/unmute
		if (mediaPlayer.muted) changeButtonType(muteBtn, 'unmute');
		else changeButtonType(muteBtn, 'mute');
	}, false);	
	mediaPlayer.addEventListener('ended', function() { this.pause(); }, false);
	volume = parseFloat(mediaPlayer.volume);
	

}
function GetHrsMinSec(){
	
}
function togglePlayPause() {
	// If the mediaPlayer is currently paused or has ended
	if (mediaPlayer.paused || mediaPlayer.ended) {
		playPauseBtn.src = "/img/icons/pause.png";
		changeButtonType(playPauseBtn, 'pause');
		mediaPlayer.play();
		videoPlaying = true;
		playIcon=false;
		$('.play-icon').fadeOut(500);
		//mediaPlayer.getPlaybackQuality('small');
		
	}
	// Otherwise it must currently be playing
	else {
		changeButtonType(playPauseBtn, 'play');
		playPauseBtn.src = "/img/icons/play.png";
		// Pause the media
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
	var volumeLenght = $('#volume-vertical').height(); 
	if(sign==='-'){
		$('#volume-vertical').css({'height': volumeLenght-10 +'px'});
		$('.volume-static-holder').css({'overflow':'hidden'});
		volume -= 0.1;
	}else{
		$('#volume-vertical').css({'height': volumeLenght+10 +'px'});
		$('.volume-static-holder').css({'overflow':'hidden'});
		volume +=  0.1;
	}
}

// Toggles the media player's mute and unmute status
function toggleMute() {
	if (mediaPlayer.muted) {
		// Change the button to be a mute button
		changeButtonType(muteBtn, 'mute');
		muteBtn.src = "/img/icons/sound.png";
		mediaPlayer.muted = false;
	}
	else {
		// Change the button to be an unmute button
		changeButtonType(muteBtn, 'unmute');
		muteBtn.src = "/img/icons/sound-off.png";
		mediaPlayer.muted = true;
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
	var percentage = Math.floor((100 / mediaPlayer.duration) * mediaPlayer.currentTime);
	var videoCurrentTime = Math.floor(mediaPlayer.currentTime);
	var time = Math.round(($('#current-progress').width() / progWidth) * mediaPlayer.duration);
	var seconds = 0,
			hours = Math.floor(time / 3600),
			minutes = Math.floor(time / 60),
			vidMinLenght = Math.floor(mediaPlayer.duration / 60),
			vidSecLenght = Math.floor((mediaPlayer.duration) - (vidMinLenght*60));
				// seconds are equal to the time minus the minutes
				seconds = (videoCurrentTime - (60 * minutes));
				// So if seconds go above 59 and increase minutes, reset seconds
				if(seconds > 59){
					seconds = Math.round(videoCurrentTime - (60 * minutes));
					minutes = Math.floor(videoCurrentTime / 60); 
					seconds = 0;
				}	
				if(minutes > 59){
					hours = Math.floor(time / 3600); 
					minutes = 0;
				}				 
				// Updated progress width
					updProgWidth = Math.round((videoCurrentTime / mediaPlayer.duration) * progWidth);
					
					// Set a zero before the number if its less than 10.
					if(seconds < 10) { seconds = '0'+ seconds; }
					if(vidSecLenght < 10) { vidSecLenght = '0'+ vidSecLenght; }
					if(minutes < 10) { minutes = '0'+ minutes; }
					if(hours < 10) { hours = '0'+ hours; }
					if(videoCurrentTime < 10){ videoCurrentTime = '0' + videoCurrentTime;}
					// A variable set which we'll use later on
					if(response != true) {
						$('#current-progress').css({'width' : updProgWidth+'px'});
						//$that.find('.progress-button').css({'left' : (updProgWidth-$that.find('.progress-button').width())+'px'});
					}
					//Update time
					if(Math.round(mediaPlayer.duration) >= 3600){
							var hrs = Math.floor(vidMinLenght/60); 
								if(hrs < 10){
									hrs = '0'+hrs;
								}
							var mins =  vidMinLenght - (Math.floor(hrs * 60));
							var tmpSecs =  Math.floor(Math.floor(mediaPlayer.duration) / 60);
							var secs =   Math.floor(mediaPlayer.duration) - (tmpSecs * 60);
							$('.ctime').html(hours +':' + minutes + ':' + seconds + '/' + hrs + ':' + mins + ':' + secs);				
					}else{
						if(vidMinLenght < 10){
							vidMinLenght = '0'+vidMinLenght;
						}
						$('.ctime').html(minutes + ':' + seconds +'/' + vidMinLenght + ':' + vidSecLenght);
					}

					var updateTime = Math.round(videoCurrentTime);
					var videoLenght = Math.round(mediaPlayer.duration);				
					if(updateTime == videoLenght) {		
						playPauseBtn.src = "/img/icons/play.png";
						videoPlaying=false;
						videoCurrentTime = 0;
						$('.advertisement').fadeOut();
						$('.play-icon').fadeIn(500);
					}
					if(updateTime==10){
						$('.advertisement').fadeIn(2000);
					}
					//mediaPlayer.onwaiting = function() {alert('waiting');}

		
}

// Updates a button's title, innerHTML and CSS class to a certain value
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
// var opera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;//v8+
// var firefox = typeof InstallTrigger !== 'undefined';//v1+
// var safari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;//v3+
// var chrome = !!window.chrome && !isOpera;//v1+
// var ie = false || !!document.documentMode;   // At least IE6
// if(opera == true){}
// if(firefox == true){video.mozRequestFullScreen();}
// if(safari == true){video.webkitEnterFullScreen();}
// if(chrome == true){video.webkitEnterFullScreen();}
// if(ie == true){}
if (mediaPlayer.requestFullscreen){mediaPlayer.requestFullscreen();}
if (mediaPlayer.msRequestFullscreen){mediaPlayer.msRequestFullscreen();}
if (mediaPlayer.mozRequestFullScreen){mediaPlayer.mozRequestFullScreen();}
if (mediaPlayer.webkitRequestFullscreen){mediaPlayer.webkitRequestFullscreen();}

}

function showVolume(){

}
$('#mute-icon').hover(function(){
	soundHover=true;
	if(soundHover==true){
		$('.volume').fadeIn(1000);	
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

	progressbarClick = true;
	mouseX = e.pageX - $('#current-progress').offset().left;
	currentTime = (Math.floor(mouseX) /  Math.floor(progWidth)) * Math.floor(mediaPlayer.duration);
	mediaPlayer.currentTime = currentTime;
	if(videoPlaying == true) {
			mediaPlayer.pause();
			playPauseBtn.src = "/img/icons/play.png";
			$('.play-icon').fadeIn(500);
		}				
});

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


