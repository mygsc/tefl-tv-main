
document.addEventListener("DOMContentLoaded", function() { GSCMediaPlayer(); }, false);

var mediaPlayer,
	playPauseBtn,
 	muteBtn,
 	progressBar,
 	btnFullscreen,
 	videoTimeLenght, $this = $(this),
 	updProgWidth = 0;

//var progWidth = tag.find('.progress').width();
var progWidth = document.getElementById('progressbar').offsetWidth;
var progress = document.getElementById('current-progress').offsetWidth;

function GSCMediaPlayer() {

	// Get a handle to the player
	mediaPlayer = document.getElementById('media-video');
	
	// Get handles to each of the buttons and required elements
	playPauseBtn = document.getElementById('play-pause');
	muteBtn = document.getElementById('mute-button');
	progressBar = document.getElementById('progress-bar');
	currentProgress =  document.getElementById('current-progress');
	btnFullscreen = document.getElementById('fullscreen');
	videoTimeLenght = document.getElementById('video-time-lenght');
	// Hide the browser's default controls
	mediaPlayer.controls = false;
	
	// Add a listener for the timeupdate event so we can update the progress bar
	mediaPlayer.addEventListener('timeupdate', updateProgressBar, false);
	
	// Add a listener for the play and pause events so the buttons state can be updated
	mediaPlayer.addEventListener('play', function() {
		// Change the button to be a pause button
		//$('play-pause').css('background','url("/img/icons/pause.png")');
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
}

function togglePlayPause() {
	// If the mediaPlayer is currently paused or has ended
	if (mediaPlayer.paused || mediaPlayer.ended) {
		// Change the button to be a pause button
		playPauseBtn.src = "/img/icons/pause.png";
		changeButtonType(playPauseBtn, 'pause');
		// Play the media
		mediaPlayer.play();
	}
	// Otherwise it must currently be playing
	else {
		// Change the button to be a play button
		changeButtonType(playPauseBtn, 'play');
		playPauseBtn.src = "/img/icons/play.png";
		// Pause the media
		mediaPlayer.pause();
	}
}

// Stop the current media from playing, and return it to the start position
function stopPlayer() {
	mediaPlayer.pause();
	mediaPlayer.currentTime = 0;
}

// Changes the volume on the media player
function changeVolume(direction) {
	if (direction === '+') mediaPlayer.volume += mediaPlayer.volume == 1 ? 0 : 0.1;
	else mediaPlayer.volume -= (mediaPlayer.volume == 0 ? 0 : 0.1);
	mediaPlayer.volume = parseFloat(mediaPlayer.volume).toFixed(1);
}

// Toggles the media player's mute and unmute status
function toggleMute() {
	if (mediaPlayer.muted) {
		// Change the cutton to be a mute button

		changeButtonType(muteBtn, 'mute');
		muteBtn.src = "/img/icons/sound.png";
		// Unmute the media player
		mediaPlayer.muted = false;
	}
	else {
		// Change the button to be an unmute button
		changeButtonType(muteBtn, 'unmute');
		muteBtn.src = "/img/icons/sound-off.png";
		// Mute the media player
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
	// Update the progress bar's value
	//progressBar.value = percentage;
	//progress += percentage;
	var videoCurrentTime = mediaPlayer.currentTime;
	var time = Math.round(($('#current-progress').width() / progWidth) * mediaPlayer.duration);
    
	var seconds = 0,
		minutes = Math.floor(time / 60),
		tminutes = Math.round(mediaPlayer.duration / 60),
		tseconds = Math.round((mediaPlayer.duration) - (tminutes*60));
	if(time){
				// seconds are equal to the time minus the minutes
				seconds = Math.round(time) - (60*minutes);
				
				// So if seconds go above 59
				if(seconds > 59) {
					// Increase minutes, reset seconds
					seconds = Math.round(time) - (60*minutes);
					if(seconds == 60) {
						minutes = Math.round(time / 60); 
						seconds = 0;
					}
				}
						
			} 
	// Updated progress width
					updProgWidth = (videoCurrentTime / mediaPlayer.duration) * progWidth;
					
					// Set a zero before the number if its less than 10.
					if(seconds < 10) { seconds = '0'+seconds; }
					if(tseconds < 10) { tseconds = '0'+tseconds; }
					
					// A variable set which we'll use later on
					if(response != true) {
						$('#current-progress').css({'width' : updProgWidth+'px'});
						//$that.find('.progress-button').css({'left' : (updProgWidth-$that.find('.progress-button').width())+'px'});
					}
					
					// Update times
					$('.ctime').html(minutes+':'+seconds+' / ');
					$('.ttime').html(tminutes+':'+tseconds);
					
	
	// Update the progress bar's text (for browsers that don't support the progress element)
	//progressBar.innerHTML = percentage + '% played';
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
	// Reset the progress bar to 0
	//progressBar.value = 0;
	// Move the media back to the start
	progress = 0;
	mediaPlayer.currentTime = 0;
	// Ensure that the play pause button is set as 'play'
	changeButtonType(playPauseBtn, 'play');
}

function fullscreen(){
var video = document.getElementById("media-video");

		//video.mozRequestFullScreen();	
		//video.webkitEnterFullScreen();
		video.webkitEnterFullScreen();
}