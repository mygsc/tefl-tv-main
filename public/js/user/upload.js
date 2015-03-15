$(document).ready(function(){
	$('#progress').hide();
	var img = document.getElementById('video');
	var channel = $('input[name=channel]').val();
	var selected = 1;
    var reader = new FileReader();
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


    $('#vids-upload').on('change',function(){
   		$(this).closest("#vidSubmit").submit();

            $('#progress').fadeIn(500);
            $('#vids-upload').fadeOut();
            setTimeout(function(){
                $('#select-upload').fadeOut();
                $('#vids-thumbnails').fadeIn(1500);
                $('#progress').hide(); 
                var canvases = $('canvas'), imgThumb, n;
                for(n = 1; n < 4; n++){
                    imgThumb = n * 3;
                    VideoSnapper.captureAsCanvas(video, { width: 150, height: 100, time:imgThumb}, function(canvas) {
                    $('#screenshot').append(canvas);     
                    $('canvas').addClass('img-thumb'); 
                        if (canvases.length == 3) 
                          canvases.eq(0).remove();
                    });              
                }   

            }, 2000);  
   	});

    $('canvas').click(function(){
    	$(this).css({'outline':'2px solid green','padding':'0'});
    	img.poster = "/videos/tmp-img/upload-thumbnail.jpg";
    	selected = 1;
    	document.getElementById('selected-thumbnail').value = selected;
    });
     $('#img-thumb-1').click(function(){
        $(this).css({'outline':'2px solid green'});
        $('#img-thumb-2').css({'outline':'1px solid #000000'});
        $('#img-thumb-3').css({'outline':'1px solid #000000'});
        img.poster = "/videos/tmp-img/"+channel+'2.jpg';
        selected = 2;
        document.getElementById('selected-thumbnail').value = selected;
    });
    $('#img-thumb-2').click(function(){
    	$(this).css({'outline':'2px solid green'});
    	$('#img-thumb-1').css({'outline':'1px solid #000000'});
    	$('#img-thumb-3').css({'outline':'1px solid #000000'});
    	img.poster = "/videos/tmp-img/"+channel+'2.jpg';
    	selected = 2;
    	document.getElementById('selected-thumbnail').value = selected;
    });
    $('#img-thumb-3').click(function(){
    	$(this).css({'outline':'2px solid green'});
    	$('#img-thumb-1').css({'outline':'1px solid #000000'});
    	$('#img-thumb-2').css({'outline':'1px solid #000000'});
    	img.poster = "/videos/tmp-img/"+channel+'3.jpg';
    	selected = 3;
    	document.getElementById('selected-thumbnail').value = selected;
    });

$(function() {
    $('video').bind('video_really_ready', function(){
     var video = this;
      $('#captures').click(function(){
       alert('tested');
            var canvases = $('canvas'); 
            for(var start=1; start < 4; start++){
                var imgThumb = start * 3;
                VideoSnapper.captureAsCanvas(video, { width: 160, height: 108, time:imgThumb}, function(canvas) {
                $('#screenshot').append(canvas);     
                                    
                    if (canvases.length == 3)
                        canvases.eq(0).remove();
                });      
            }// end of for loop
        });
    });
});



});//end of function





