$(document).ready(function(){
	$('#progress').hide();
    $('#vids-upload').on('change',function(){
   		$(this).closest("#vidSubmit").submit();
   			$('.file-upload').fadeOut();
            $('#progress').fadeIn(500);
            uploadFile();
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

    function thisId(id){
        return document.getElementById(id);
    }
    function uploadFile(){
        var id = thisId('vids-upload').files[0];
        var formData = new FormData();
        formData.append('vids-upload', id);
        var video = new XMLHttpRequest();
        video.upload.addEventListener('progress',validateVideo, false);
        video.addEventListener('load',successful, false);
        video.addEventListener('error',checkError, false);
        video.open('POST','upload');
        video.send(formData);
    }
    function validateVideo(e){
        var percent = Math.round((e.loaded/e.total)*100);
        thisId('progressbar-loaded').style.width = percent + '%';
        thisId('percentage').innerHTML = percent + '%';
    }
    function successful(event){
        thisId('progressbar-loaded').style.background = 'green';
        //window.location.href = "add-description/Y5f8AXHQW5J";
    }
    function checkError(){
        thisId('percentage').innerHTML = 'Failed to load your video please try again.';
    }

});//end of function





