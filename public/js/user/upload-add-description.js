$(document).ready(function(){
	$('#progress').hide();
	var videoPlayer = document.getElementById('media-video');
	var totalTime = document.getElementById('total-time');
  var thumbnail = document.getElementById('selected-thumbnail');
  // var canvas1 = document.getElementById('img-thumb-1'), canvas2 = document.getElementById('img-thumb-2'), canvas3 = document.getElementById('img-thumb-3');
  // var context1 = canvas1.getContext('2d'), context2 = canvas2.getContext('2d'), context3 = canvas3.getContext('2d');
  var w, h, ratio;
	var channel = $('input[name=channel]').val();
	var selected = 1, timeLenght=0;
  var getImage, timeDuration, hrs=0, mins=0, secs=0, tmpSec=0, time=0, totalMin=0, totalSec=0;
  var videoHeight, videoWidth, drawTimer = null;
  var ssContainer = document.getElementById("screenShots");
  var  playing=false; 
  // var canvas = document.getElementById("canvas");
  // var ctx = canvas.getContext("2d");
  // context1.font="20px Georgia";
  // context1.fillText("Please wait...",90,75);
  // context2.font="20px Georgia";
  // context2.fillText("Please wait...",90,75);
  // context3.font="20px Georgia";
  // context3.fillText("Please wait...",90,75);

 	videoPlayer.addEventListener('loadedmetadata', function() {
		timeDuration = Math.round(videoPlayer.duration);
		onLoadTime();
    $(this).trigger('video_really_ready');
    timeLenght = Math.floor(videoPlayer.duration);
    ratio = videoPlayer.videoWidth / videoPlayer.videoHeight;
    w = Math.floor(videoPlayer.videoWidth/videoPlayer.videoWidth * 300);
    h =  Math.floor(videoPlayer.videoHeight/videoPlayer.videoHeight * 150);
	});
 
  // window.snap = function(num) {
  //   if(num==1){
  //     var duration = Math.floor(videoPlayer.duration);
  //     var rdm = Math.floor((Math.random() * duration) + 1); 
  //     videoPlayer.currentTime = rdm;
  //     context1.fillRect(0, 0, w, h);
  //     context1.drawImage(videoPlayer, 0, 0, w, h);
  //   }
  //   if(num==2){
  //     var duration = Math.floor(videoPlayer.duration);
  //     var rdm = Math.floor((Math.random() * duration) + 1); 
  //     videoPlayer.currentTime = rdm;
  //     context2.fillRect(0, 0, w, h);
  //     context2.drawImage(videoPlayer, 0, 0, w, h);
  //   }
  //   if(num==3){
  //     var duration = Math.floor(videoPlayer.duration);
  //     var rdm = Math.floor((Math.random() * duration) + 1); 
  //     videoPlayer.currentTime = rdm;
  //     context3.fillRect(0, 0, w, h);
  //     context3.drawImage(videoPlayer, 0, 0, w, h);
  //   }
    
  // }


	// var VideoSnapper = {
	// 	captureAsCanvas: function(video, options, handle) {
 //            // Create canvas and call handle function
 //            var callback = function() {
 //                // Create canvas
 //                var canvas = $('<canvas />').attr({
 //                	width: options.width,
 //                	height: options.height
 //                })[0];
 //                // Get context and draw screen on it
 //                canvas.getContext('2d').drawImage(video, 0, 0, options.width, options.height);
 //                // Seek video back if we have previous position 
 //                if (prevPos) {
 //                    // Unbind seeked event - against loop
 //                    $(video).unbind('seeked');
 //                    // Seek video to previous position
 //                    video.currentTime = prevPos;
 //                }
 //                // Call handle function (because of event)
 //                handle.call(this, canvas);    
 //            }

 //            // If we have time in options 
 //            if (options.time && !isNaN(parseInt(options.time))) {
 //                // Save previous (current) video position
 //                var prevPos = video.currentTime;
 //                // Seek to any other time
 //                video.currentTime = options.time;
 //                // Wait for seeked event
 //                $(video).bind('seeked', callback);              
 //                return;
 //            }
            
 //            // Otherwise callback with video context - just for compatibility with calling in the seeked event
 //            return callback.apply(video);
 //        }
 //    };


//  window.checkThumbnail = function() {
//   if(thumbnail.value == 0){
//     alert('Please select available thumbnail if available or select your own thumbnail.');
//      return false;
//   }
// }
    function onLoadTime(){
      totalMin = Math.floor(timeDuration / 60);
  		totalSec = Math.round(timeDuration - (totalMin * 60));
  		hrs = Math.floor(totalMin / 60);
  		mins =  (totalMin - (hrs * 60));
  		tmpSec =  Math.round(timeDuration / 60);
  		secs =   Math.round(timeDuration - (totalMin * 60));
  		if(secs < 10) { secs = '0'+ secs; }
  		if(totalSec < 10) { totalSec = '0'+ totalSec; }
  		if(mins < 10) { mins = '0'+ mins; }
  		if(hrs < 10) { hrs = '0'+ hrs; }
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

// $('img.thumb-1').on('click', function(){
//   $(this).css({'outline':'3px solid #3ea9cb'});
//   $('img.thumb-2').css({'outline':'1px solid #ccc'});
//   $('img.thumb-3').css({'outline':'1px solid #ccc'});
//   var getImg = document.getElementById('img-thumb-1');
//   var image  = this.src;//getImg.toDataURL("image/png");
//   thumbnail.value = image;
//   //$('#poster').reset();
// });
// $('img.thumb-2').on('click', function(){
//  $(this).css({'outline':'3px solid #3ea9cb'});
//  $('img.thumb-1').css({'outline':'1px solid #ccc'});
//   $('img.thumb-3').css({'outline':'1px solid #ccc'});
//   var getImg = document.getElementById('img-thumb-2');
//   var image  = this.src;//getImg.toDataURL("image/png");
//   thumbnail.value = image;
// });
// $('img.thumb-3').on('click', function(){
//   $(this).css({'outline':'3px solid #3ea9cb'});
//   $('img.thumb-1').css({'outline':'1px solid #ccc'});
//   $('img.thumb-2').css({'outline':'1px solid #ccc'});
//   var getImg = document.getElementById('img-thumb-3');
//   var image  = this.src;//getImg.toDataURL("image/png");
//   thumbnail.value = image;
// });

// function initScreenshot() {
//   videoHeight = videoPlayer.videoHeight;
//   videoWidth = videoPlayer.videoWidth;
//   canvas.width = videoWidth;
//   canvas.height = videoHeight;
  
// }

// function startScreenshot() {
// playing =true;
//   if (drawTimer == null) {
//     // if(canvases > 2){
//     //     canvases.eq(0).remove();
//     //     stopScreenshot();
//     //     videoPlayer.pause();
//     //   }else{
//          drawTimer = setInterval(grabScreenshot, 1000);
//       // }
//     }
// }

// function grabScreenshot() {
//   ctx.drawImage(videoPlayer, 0, 0, videoWidth, videoHeight);
//   //var img = new Image();
//   //img.src = canvas.toDataURL("image/png");
//   //img.width = 220;
//   //ssContainer.appendChild(img);
// }

// function stopScreenshot() {
//   if (drawTimer) {
//     clearInterval(drawTimer);
//     drawTimer = null;
//   }
// }

// function updateThumbnail(){
//     var canvases = $('canvas');
//   if(playing == true){
//     if(canvases.length > 2){
//         canvases.eq(0).remove();
//         videoPlayer.pause();
//       }
//   }
// }

});//end of function

function getId(id){
  return document.getElementById(id);
}
function setAsThumbnail(selector){
  $('.caption-' + selector).html('Set as thumbnail').css({'line-height':'90px', 'cursor':'pointer', 'background':'rgba(42,42,42,0.5)', 'text-align':'center', 'width':'100%','height':'100%', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
  $('#'+selector).css({'outline':'3px solid #0b8ddd','background':'rgba(42,42,42,0.5)'});
}
function removeThumbnailCaption(selector){
  $('.caption-' + selector).html('').css({'background':'transparent', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
  $('#'+selector).css({'outline':'0px solid #0b8ddd','background':'transparent'});
}
$('#img-thumb-1').bind('mouseover',function(){
    var selector = this.id;
    setAsThumbnail(selector);
});
$('#img-thumb-2').bind('mouseover',function(){
    var selector = this.id;
    setAsThumbnail(selector);
});
$('#img-thumb-3').bind('mouseover',function(){
    var selector = this.id;
    setAsThumbnail(selector);
});

$('#img-thumb-1').bind('mouseleave',function(){
    var selector = this.id;
    removeThumbnailCaption(selector);
});
$('#img-thumb-2').bind('mouseleave',function(){
    var selector = this.id;
    removeThumbnailCaption(selector);
});
$('#img-thumb-3').bind('mouseleave',function(){
    var selector = this.id;
    removeThumbnailCaption(selector);
});
$('#img-thumb-1').bind('click',function(){
    var selector = this.id;
    $(this).css({'border':'2px solid #0b8ddd'});
    $('#img-thumb-2').css({'border':'0px solid #0b8ddd'});
    $('#img-thumb-3').css({'border':'0px solid #0b8ddd'});
    var thumbSrc = document.getElementById('thumb-1-img').src;
    getId('selected-thumbnail').value = thumbSrc;
    document.getElementById('media-video').poster = thumbSrc;
    var fi = document.getElementById('sel-t-1');
    fi.className = "glyphicon glyphicon-ok";
    $(fi).html('').css({'color':'#0b8ddd','background':'rgba(42,42,42,0.5)'});
    var sec = document.getElementById('sel-t-2');
    sec.className = "";
    $(sec).html('').css({'background':'transparent'});
    var thi = document.getElementById('sel-t-3');
    thi.className = "";
    $(thi).html('').css({'background':'transparent'});
    
});
$('#img-thumb-2').bind('click',function(){
    var selector = this.id;
    $(this).css({'border':'2px solid #0b8ddd'});
    $('#img-thumb-1').css({'border':'0px solid #0b8ddd'});
    $('#img-thumb-3').css({'border':'0px solid #0b8ddd'});
    var thumbSrc = document.getElementById('thumb-2-img').src;
    getId('selected-thumbnail').value = thumbSrc;
    document.getElementById('media-video').poster = thumbSrc;
    var sec = document.getElementById('sel-t-2');
    sec.className = "glyphicon glyphicon-ok";
    $(sec).html('').css({'color':'#0b8ddd'});
     var fi = document.getElementById('sel-t-1');
    fi.className = "";
    $(fi).html('').css({'background':'transparent'});
    var thi = document.getElementById('sel-t-3');
    thi.className = "";
    $(thi).html('').css({'background':'transparent'});
});
$('#img-thumb-3').bind('click',function(){
    var selector = this.id;
    $(this).css({'border':'2px solid #0b8ddd'});
    $('#img-thumb-1').css({'border':'0px solid #0b8ddd'});
    $('#img-thumb-2').css({'border':'0px solid #0b8ddd'});
    var thumbSrc = document.getElementById('thumb-3-img').src;
    getId('selected-thumbnail').value = thumbSrc;
    document.getElementById('media-video').poster = thumbSrc;
     var thi = document.getElementById('sel-t-3');
    thi.className = "glyphicon glyphicon-ok";
    $(thi).html('').css({'color':'#0b8ddd'});
    var sec = document.getElementById('sel-t-2');
    sec.className = "";
    $(sec).html('').css({'color':'#0b8ddd'});
     var fi = document.getElementById('sel-t-1');
    fi.className = "";
    $(fi).html('').css({'background':'transparent'});
});






