$(document).ready(function(){
	$('#progress').hide();
    $('#vids-upload').on('change',function(){
        $('#progress').fadeIn();
        var limitSize = 157286400; //eq. 150 mb 10485760=10mb
        var file = document.getElementById('vids-upload').value;
        var fileSize = document.getElementById('vids-upload').files[0];
        var ext = file.substring(file.lastIndexOf('.') + 1).toLowerCase();
            if(fileSize.size > limitSize){
                $('#progress').fadeOut('fast');
                return $('#percentage').html('Error: File size is too big.').css({'color':'#cc3510'});
            }
            if(file == ''){
                $('#progress').fadeOut('fast');
                return $('#percentage').html('Error: No selected file.').css({'color':'#cc3510'}); 
            }
            if(ext == "mp4" || ext == "webm" || ext == "ogg" || ext == "wmv" || ext == "avi" || ext == "flv" || ext == "mov") {
                $(this).closest("#vidSubmit").submit();
                $('.file-upload').fadeOut();$('#progress').fadeIn(500);//$('#wrapper').fadeIn(500); 
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
                    //$('#percentage').html('Processing... '+percentComplete+"%").css({'color':'#000'});
                    $('#percentage').html('Uploading and converting your video it takes several minutes.').css({'color':'#000'});
                },
                success: function(response){
                    $('#percentage').html('Done please wait a moment...');
                    window.location.href = "add-description!v="+response.file;
                    $('#progress').fadeOut();
                    $('#wrapper').fadeOut();  
                },
                error: function(response, status, e){
                    alert(e);
                },
                resetForm: true 
            });
    });

});//end of function







