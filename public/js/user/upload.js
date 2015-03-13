$(document).ready(function(){
	$('#progress').hide();
	var img = document.getElementById('img-vid-thumb');
	var channel = $('input[name=channel]').val();
	var selected = 1;
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


    $('#vids-upload').change(function(){
   		//$(this).closest("#vidSubmit").submit();
   		//document.getElementById('vidSubmit').submit();
   		$('#progress').show();
   		$('#vids-upload').fadeOut();
   		setTimeout(function(){
   			$('#select-upload').fadeOut();
   			$('#vids-thumbnails').fadeIn(1500);
			//TESTING START

			$('video').bind('gsc_video', function() {
				var video = this;
				$('#test').click(function() {
					var canvases = $('canvas');	
				//for(var start=1; start<=3; start++){
					//var img = Math.floor((Math.random() * 15) + 1);
					//var img = start*5;
					VideoSnapper.captureAsCanvas(video, { width: 160, height: 108, time:10  }, function(canvas) {
						$('#screen').append(canvas);                         
						if (canvases.length == 3) 
							canvases.eq(0).remove();
					})
					
				//}// end of for loop

			}); 
			});

			//TEST
			screenShot();
			$('#progress').hide();
		}, 2000);			
   		
   	});

    $('#img-thumb-1').click(function(){
    	$(this).css({'outline':'2px solid green'});
    	$('#img-thumb-2').css({'outline-style':'none'});
    	$('#img-thumb-3').css({'outline-style':'none'});
    	img.poster = "/videos/tmp-img/"+channel+'1.jpg';
    	selected = 1;
    	document.getElementById('selected-thumbnail').value = selected;
    });
    $('#img-thumb-2').click(function(){
    	$(this).css({'outline':'2px solid green'});
    	$('#img-thumb-1').css({'outline-style':'none'});
    	$('#img-thumb-3').css({'outline-style':'none'});
    	img.poster = "/videos/tmp-img/"+channel+'2.jpg';
    	selected = 2;
    	document.getElementById('selected-thumbnail').value = selected;
    });
    $('#img-thumb-3').click(function(){
    	$(this).css({'outline':'2px solid green'});
    	$('#img-thumb-1').css({'outline-style':'none'});
    	$('#img-thumb-2').css({'outline-style':'none'});
    	img.poster = "/videos/tmp-img/"+channel+'3.jpg';
    	selected = 3;
    	document.getElementById('selected-thumbnail').value = selected;
    });




// $(function() {

//         $('video').bind('video_really_ready', function() {
//             var video = this;
//                 var canvases = $('canvas');

// 				for(var start=1; start<=3; start++){
// 					//var img = Math.floor((Math.random() * 15) + 1);
// 					var img = start*5;
// 					VideoSnapper.captureAsCanvas(video, { width: 160, height: 68, time:img  }, function(canvas) {
// 					$('#screen').append(canvas);                         
//                         if (canvases.length == 3) 
//                           canvases.eq(0).remove();     
// 					})
// 				}// end of for loop         
//         });

//     });

var screenShot = function(){
	$('video').bind('capture', function() {
		var video = this;
		var canvases = $('canvas');
		for(var start=1; start<=3; start++){
			var imgThumb = start * 5;
			VideoSnapper.captureAsCanvas(video, { width: 160, height: 68, time:10  }, function(canvas) {
				
				$('#screenshoot').append(canvas);                         
				if (canvases.length == 3) 
					canvases.eq(0).remove();     
			})
			}// end of for loop
		});
};



});//end of function





