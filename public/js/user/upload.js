$(document).ready(function(){
	$('#progress').hide();
	var videoPlayer = document.getElementById('video');
	var totalTime = document.getElementById('total-time');
	var channel = $('input[name=channel]').val();
	var selected = 1, timeLenght=0;
  var reader = new FileReader();
  var getImage, timeDuration, hrs=0, mins=0, secs=0, tmpSec=0, time=0, totalMin=0, totalSec=0;

 	videoPlayer.addEventListener('loadedmetadata', function() {
		timeDuration = Math.round(videoPlayer.duration);
		onLoadTime();
    $(this).trigger('video_really_ready');
    timeLenght = Math.floor(videoPlayer.duration);
	});
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
  			document.getElementById('total-time').value = time;
  		}else{
  			time = hrs + ':' + mins + ':' + secs;
  			document.getElementById('total-time').value = time;

  		}
    }
   

    $('#vids-upload').on('change',function(){
   		$(this).closest("#vidSubmit").submit();
   			$('#vids-upload').fadeOut();
            $('#progress').fadeIn(500);
            
            // setTimeout(function(){
            //     $('#select-upload').fadeOut();
            //     $('#vids-thumbnails').fadeIn(1500);
            //     $('#progress').hide(); 
            //     var canvases = $('canvas'), imgThumb, n;
            //     for(n = 1; n < 4; n++){
            //         imgThumb = n * 3;
            //         VideoSnapper.captureAsCanvas(video, { width: 150, height: 100, time:imgThumb}, function(canvas) {
            //         $('#screenshot').append(canvas);     
            //         $('canvas').addClass('img-thumb'); 
            //             if (canvases.length == 3) 
            //               canvases.eq(0).remove();
            //         });              
            //     }   
            // }, 2000); 
   	});

$("#poster").on("change", function()
    {
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
$(function() {
    // $('video').bind('video_really_ready', function(){
    //  var video = this;
    //   $('#thumbnail').click(function(){
    //         var canvases = $('canvas'); 
    //         //for(var start=1; start < 4; start++){
    //           var rdm = Math.floor((Math.random() * timeLenght) + 1); 
    //             VideoSnapper.captureAsCanvas(video, { width: 300, height: 150, time: rdm}, function(canvas) {
    //             $('#screenShot').append(canvas);
    //             $('div#thumbnail canvas').addClass('img-thumb1');
    //             canvas.setAttribute("id", "img-thumb1");                                 
    //                  if (canvases.length > 2)
    //                      canvases.eq(0).remove();
    //             })  

    //         //}// end of for loop

    //     });
    // });
});






 //  $('video').bind('video_really_ready', function(){
 //     	var video = this;
 //     	$('#img-thumb-1').click(function(){
 //        	$(this).css({'outline':'2px solid green'});
	// 	    $('#img-thumb-2').css({'outline':'1px solid #000000'});
	// 	    $('#img-thumb-3').css({'outline':'1px solid #000000'});
 //            var canvases = $('canvas'); 
 //                VideoSnapper.captureAsCanvas(video, { width: 1024, height: 768, time:1}, function(canvas) {
 //                $('video').append(canvas);
 //                //$('video canvas').addClass('img-thumb-resize');
 //                //$('video canvas').css({'position':'relative', 'width':'400px', 'height':'100%'});	        
 //                canvas.setAttribute("id", "img-selected-thumb-1");                                 
 //                    if (canvases.length >= 1 )
 //                        canvases.eq(0).remove();
 //                    	canvases.eq(1).remove();
 //                    	canvases.eq(2).remove();
 //                    	alert('remove');
 //                var canvasImage = document.getElementById('img-selected-thumb-1');
	// 	        	getImage = canvasImage.toDataURL('image/png');
	// 	       		document.getElementById('selected-thumbnail').value = getImage;
 //                })  
 //  		});

 //  		$('#img-thumb-2').click(function(){
 //        	$(this).css({'outline':'2px solid green'});
	// 	    $('#img-thumb-1').css({'outline':'1px solid #000000'});
	// 	    $('#img-thumb-3').css({'outline':'1px solid #000000'});
 //            var canvases = $('canvas'); 
 //                VideoSnapper.captureAsCanvas(video, { width: 1024, height: 768, time:5}, function(canvas) {
 //                $('video').append(canvas);
 //                //$('video canvas').addClass('img-thumb-resize');
 //                //$('video canvas').css({'position':'relative', 'width':'400px', 'height':'100%'});	        
 //                canvas.setAttribute("id", "img-selected-thumb-2");                                 
 //                    if (canvases.length >= 1)
 //                        canvases.eq(0).remove();
 //                var canvasImage = document.getElementById('img-selected-thumb-2');
	// 	        	getImage = canvasImage.toDataURL('image/png');
	// 	       		document.getElementById('selected-thumbnail').value = getImage;
		       		
 //                })  
 //  		});

 //  		$('#img-thumb-3').click(function(){
 //        	$(this).css({'outline':'2px solid green'});
	// 	    $('#img-thumb-1').css({'outline':'1px solid #000000'});
	// 	    $('#img-thumb-2').css({'outline':'1px solid #000000'});
 //            var canvases = $('canvas'); 
 //                VideoSnapper.captureAsCanvas(video, { width: 1024, height: 768, time:10}, function(canvas) {
 //                $('video').append(canvas);
 //                //$('video canvas').addClass('img-thumb-resize');
 //                //$('video canvas').css({'position':'relative', 'width':'400px', 'height':'100%'});	        
 //                canvas.setAttribute("id", "img-selected-thumb-3");                                 
 //                    if (canvases.length == 3)
 //                        canvases.eq(0).remove();
 //                var canvasImage = document.getElementById('img-selected-thumb-3');
	// 	        	getImage = canvasImage.toDataURL('image/png');
	// 	       		document.getElementById('selected-thumbnail').value = getImage;
		       		
 //                })  
 //  		});
 // });

               
        

      
  




});//end of function





