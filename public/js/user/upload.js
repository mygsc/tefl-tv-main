$(document).ready(function(){
	$('#progress').hide();
    $('#vids-upload').on('change',function(){
        $('#progress').fadeIn(500);
        var limitSize = 157286400; //eq. 150 mb 10485760=10mb
        var file = document.getElementById('vids-upload').value;
        var fileSize = document.getElementById('vids-upload').files[0];
        var ext = file.substring(file.lastIndexOf('.') + 1).toLowerCase();
            if(file == ''){
                $('#progress').fadeOut('fast');
                return $('#percentage').html('Error: No selected file.').css({'color':'#cc3510'}); 
            }
            if(fileSize.size > limitSize){
                $('#progress').fadeOut('fast');
                return $('#percentage').html('Error: File size is too big.').css({'color':'#cc3510'});
            }
            if(ext == "mp4" || ext == "webm" || ext == "ogg" || ext == "wmv") {
                $(this).closest("#vidSubmit").submit();
                $('.file-upload').fadeOut();
                $('#progress').fadeIn(500); 
                $('#wrapper').fadeIn(500); 
            }else{
                $('#progress').fadeOut('fast');
                return $('#percentage').html('Error: File type is not valid.').css({'color':'#cc3510'});
            }    
        		
   	});

    $('form#vidSubmit').on('submit',function(e){
        e.preventDefault();

        $(this).ajaxSubmit({ 
                url:   'upload', 
                beforeSubmit: function() {
                  $("#progressbar-loaded").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){ 
                    $("#progressbar-loaded").width(percentComplete + '%');
                    $('#percentage').html('Processing... '+percentComplete+"%").css({'color':'#000'});
                },
                success: function(response){
                    $('#progress').fadeOut();
                    $('#wrapper').fadeOut();
                    $('#percentage').html('Done please wait a moment...');
                    window.location.href = "add-description!v="+response.file;
                },
                error: function(response, status, e){
                    alert(e);
                },
                resetForm: true 
            });
    });
    function startUpload(){
        $.ajax({
            url: 'upload',
            type: 'POST',
            data: new FormData(this),                           
            contentType: false,
            cache: false,
            processData: false,
            success:function(response, status, e){
                //alert(response);
                window.location.href = "add-description!v="+response.file;
            },
            error: function(response,status,e){
                alert(e);
            }
        }); 
    }

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
        thisId('#percentage').innerHTML = event.target.responseText;
        //window.location.href = "add-description/Y5f8AXHQW5J";
    }
    function checkError(){
        thisId('percentage').innerHTML = 'Failed to load your video please try again.';
    }


});//end of function







