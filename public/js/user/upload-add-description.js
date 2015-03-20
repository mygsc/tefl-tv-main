$(document).ready(function(){
	$('#progress').hide();
	var videoPlayer = document.getElementById('media-video');
	var totalTime = document.getElementById('total-time');
	var channel = $('input[name=channel]').val();
	var selected = 1, timeLenght=0;
  var getImage, timeDuration, hrs=0, mins=0, secs=0, tmpSec=0, time=0, totalMin=0, totalSec=0;
  var videoHeight, videoWidth, drawTimer = null;
  var ssContainer = document.getElementById("screenShots");
  var  playing=false; 
  var canvas = document.getElementById("canvas");
  var ctx = canvas.getContext("2d");
 	videoPlayer.addEventListener('loadedmetadata', function() {
		timeDuration = Math.round(videoPlayer.duration);
		onLoadTime();
    $(this).trigger('video_really_ready');
    timeLenght = Math.floor(videoPlayer.duration);
    initScreenshot();
    
	});

  videoPlayer.addEventListener("playing", startScreenshot);
  videoPlayer.addEventListener("pause", stopScreenshot);
  videoPlayer.addEventListener("ended", stopScreenshot);
  videoPlayer.addEventListener('timeupdate', updateThumbnail, false);
	var VideoSnapper = {
		captureAsCanvas: function(video, options, handle) {
            // Create canvas and call handle function
            var callback = function() {
                // Create canvas
                var canvas = $('<canvas />').attr({
                	width: options.width,
                	height: options.height
                })[0];
                // Get context and draw screen on it
                canvas.getContext('2d').drawImage(video, 0, 0, options.width, options.height);
                // Seek video back if we have previous position 
                if (prevPos) {
                    // Unbind seeked event - against loop
                    $(video).unbind('seeked');
                    // Seek video to previous position
                    video.currentTime = prevPos;
                }
                // Call handle function (because of event)
                handle.call(this, canvas);    
            }

            // If we have time in options 
            if (options.time && !isNaN(parseInt(options.time))) {
                // Save previous (current) video position
                var prevPos = video.currentTime;
                // Seek to any other time
                video.currentTime = options.time;
                // Wait for seeked event
                $(video).bind('seeked', callback);              
                return;
            }
            
            // Otherwise callback with video context - just for compatibility with calling in the seeked event
            return callback.apply(video);
        }
    };

    function onLoadTime(){
      totalMin = Math.floor(timeDuration / 60);
  		totalSec = Math.round(timeDuration - (totalMin * 60));
  		hrs = Math.floor(totalMin / 60);
  		mins =  (totalMin - (hrs * 60));
  		tmpSec =  Math.round(timeDuration / 60);
  		secs =   Math.round(timeDuration - (tmpSec * 60));
  		if(secs < 10) { secs = '0'+ secs; }
  		if(totalSec < 10) { totalSec = '0'+ totalSec; }
  		//if(mins < 10) { mins = '0'+ mins; }
  		//if(hrs < 10) { hrs = '0'+ hrs; }
  		if(timeDuration < 3600){
  			time = mins + ':' + secs;
  			//document.getElementById('total-time').value = time;
        $('input[name=totalTime]').val(time);
  		}else{
  			time = hrs + ':' + mins + ':' + secs;
  			//document.getElementById('total-time').value = time;
        $('input[name=totalTime]').val(time);

  		}
    }

$("#poster").on("change", function(){
  var reader = new FileReader();
     var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
          if (/^image/.test( files[0].type)){ // only image file
              reader.readAsDataURL(files[0]); // read the local file
   
              reader.onloadend = function(){ // set image data as background of div
                var thumb = document.getElementById('thumbnail');//$("#thumbnail-local").css("background-image", "url("+this.result+")");
                  
                  thumb.src=this.result;
                  videoPlayer.poster=this.result;
                   thumb.height=150;
                    thumb.width=250;
              }
          }
    });

 $('#upload-cancel').on('click',function(){
    $('#cancel-upload-vid').modal('show');
 });

$('video').bind('video_really_ready', function(){
  // var video = this;
  // $('#thumbnail').on('mousedown',function(){
  //       var canvases = $('canvas'); 
  //       //for(var start=1; start < 4; start++){
  //         var rdm = Math.floor((Math.random() * timeLenght) + 1); 
  //           VideoSnapper.captureAsCanvas(video, { width: 300, height: 150, time: rdm}, function(canvas) {
  //           $('body').append(canvas);
  //           $('div#thumbnail canvas').addClass('img-thumb1');
  //           canvas.setAttribute("id", "img-thumb1");                                 
  //                if (canvases.length > 2)
  //                    canvases.eq(0).remove();
  //           })  

  //       //}// end of for loop

  //   });
});


function getBase64FromImageUrl(URL) {
    var img = new Image();
    img.src = URL;
    img.onload = function () {
    var canvas = document.createElement("canvas");
    canvas.width =this.width;
    canvas.height =this.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(this, 0, 0);
    var dataURL = canvas.toDataURL("image/png");

    alert(dataURL.replace(/^data:image\/(png|jpg);base64,/, ""));

    }
}

function initScreenshot() {
  videoHeight = videoPlayer.videoHeight;
  videoWidth = videoPlayer.videoWidth;
  canvas.width = videoWidth;
  canvas.height = videoHeight;
  
}

function startScreenshot() {
playing =true;
  if (drawTimer == null) {
    // if(canvases > 2){
    //     canvases.eq(0).remove();
    //     stopScreenshot();
    //     videoPlayer.pause();
    //   }else{
         drawTimer = setInterval(grabScreenshot, 1000);
      // }
    }
}

function grabScreenshot() {
  ctx.drawImage(videoPlayer, 0, 0, videoWidth, videoHeight);
  //var img = new Image();
  //img.src = canvas.toDataURL("image/png");
  //img.width = 220;
  //ssContainer.appendChild(img);
}

function stopScreenshot() {
  if (drawTimer) {
    clearInterval(drawTimer);
    drawTimer = null;
  }
}

function updateThumbnail(){
    var canvases = $('canvas');
  if(playing == true){
    if(canvases.length > 2){
        canvases.eq(0).remove();
        videoPlayer.pause();
      }
  }
}

});//end of function





