$(document).ready(function(){
	$('#progress').hide();
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

});//end of function





