$(document).ready(function(){
	$('#progress').hide();
	var img = document.getElementById('video');
	var channel = $('input[name=channel]').val();
	var selected = 1;
    var reader = new FileReader();
    var getImage;
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

     // $('#img-thumb-1').click(function(){
     //    var canvasImage = document.getElementById('img-thumb1');
     //    	getImage = canvasImage.toDataURL('image/png');
     //   		document.getElementById('selected-thumbnail').value = getImage;
     //    $(this).css({'outline':'2px solid green'});
     //    $('#img-thumb-2').css({'outline':'1px solid #000000'});
     //    $('#img-thumb-3').css({'outline':'1px solid #000000'});
     // });

  //   $('#img-thumb-2').click(function(){
  //   	var canvasImage = document.getElementById('img-thumb2');
  //       	getImage = canvasImage.toDataURL('image/png');
  //       	document.getElementById('selected-thumbnail').value = getImage;
  //   	$(this).css({'outline':'2px solid green'});
  //   	$('#img-thumb-1').css({'outline':'1px solid #000000'});
  //   	$('#img-thumb-3').css({'outline':'1px solid #000000'});  	
 	// });

  //   $('#img-thumb-3').click(function(){
  //   	var canvasImage = document.getElementById('img-thumb3');
  //       	getImage = canvasImage.toDataURL('image/png');
  //       	document.getElementById('selected-thumbnail').value = getImage;
  //   	$(this).css({'outline':'2px solid green'});
  //   	$('#img-thumb-1').css({'outline':'1px solid #000000'});
  //   	$('#img-thumb-2').css({'outline':'1px solid #000000'});   	
  //   });

$(function() {
    $('video').bind('video_really_ready', function(){
     var video = this;
      //$('#img-thumb-1').click(function(){
            var canvases = $('canvas'); 
            //for(var start=1; start < 4; start++){
             //   var imgThumb = start * 3;
                VideoSnapper.captureAsCanvas(video, { width: 300, height: 150, time: 5}, function(canvas) {
                $('#img-thumb-1').append(canvas);
                $('div#img-thumb-1 canvas').addClass('img-thumb1');
                canvas.setAttribute("id", "img-thumb1");                                 
                     if (canvases.length == 1)
                         canvases.eq(0).remove();
                })  

                VideoSnapper.captureAsCanvas(video, { width: 1024, height: 768, time: 5}, function(canvas) {
                $('video#video').append(canvas);
                $('video#video canvas').addClass('img-org-thumb');
                canvas.setAttribute("id", "img-org-thumb");  
                var canvasImage = document.getElementById('img-org-thumb');
	        	getImage = canvasImage.toDataURL('image/jpg');
	       		document.getElementById('selected-thumbnail').value = getImage;                               
                })

                // VideoSnapper.captureAsCanvas(video, { width: 150, height: 130, time: 5}, function(canvas) {
                // $('#img-thumb-2').append(canvas);
                // $('div#img-thumb-2 canvas').addClass('img-thumb2');
                // canvas.setAttribute("id", "img-thumb2");                                 
                //      if (canvases.length == 1)
                //         canvases.eq(0).remove();
                // }) 

                // VideoSnapper.captureAsCanvas(video, { width: 150, height: 130, time:10}, function(canvas) {
                // $('#img-thumb-3').append(canvas);
                // $('div#img-thumb-3 canvas').addClass('img-thumb3');
                // canvas.setAttribute("id", "img-thumb3");                                 
                //      if (canvases.length == 1)
                //          canvases.eq(0).remove();
                // }) 

            //}// end of for loop

        //});
    });
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





