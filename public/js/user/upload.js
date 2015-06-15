document.getElementById("save").disabled = true;
var firstThumbnail = document.getElementById('thumb-1-img');
var secondThumbnail = document.getElementById('thumb-2-img');
var thirdThumbnail = document.getElementById('thumb-3-img');
var min=50, max=5000, limitChar = document.getElementById('description').value.length, done=false;
$('#char-limit').html(limitChar+'/5000');
$(document).ready(function(){
    $('#loader').fadeIn(500);
	$('#progress').hide();
    $('#vids-upload').on('change',function(){
        $('#progress').fadeIn();
        var limitSize = 157286400; //eq. 150 mb 10485760=10mb
        var file = document.getElementById('vids-upload').value;
        var fileSize = document.getElementById('vids-upload').files[0];
        var ext = file.substring(file.lastIndexOf('.') + 1).toLowerCase();
        
            if(fileSize.size > limitSize){
                $('#progress').fadeOut('fast');
                return $('#upload-error').html('Error: File size is too big.').css({'color':'#cc3510'});
            }
            if(file == ''){
                $('#progress').fadeOut('fast');
                return $('#upload-error').html('Error: No selected file.').css({'color':'#cc3510'}); 
            }
            if(ext == "mp4" || ext == "webm" || ext == "ogg" || ext == "wmv" || ext == "avi" || ext == "flv" || ext == "mov") {
                $('#title').val(file);
                $(this).closest("#vidSubmit").submit();
                $('.file-upload').fadeOut();$('#progress').fadeIn(500);//$('#wrapper').fadeIn(500); 
                $('.h-minH').fadeOut(500);
                $('#add-description').fadeIn(1000);
                $('#percentage').html('Start uploading...').css({'color':'#eaa207'});
            }else{
                $('#progress').fadeOut('fast');
                return $('#upload-error').html('Error: File type is not valid.').css({'color':'#cc3510'});
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
                    $('#wrapper').fadeIn();
                    $("#progressbar-loaded").width(percentComplete + '%');

                    $('#percentage').html(percentComplete+'%');
                    $('#up-msg').html('<i class="fa fa-info-circle"></i> '+' Please wait a moment while the video is uploading...').css({'color':'#5ec6e8'});
                    
                },
                success: function(response){
                    $('#loader-progress').fadeOut();
                    $('#loader').fadeOut();
		            $('#spinner').fadeOut();
                    document.getElementById('post-save').action = 'addDescription/'+response.vidid;
                    $('#up-msg').html('<i class="fa fa-check"></i> '+' The video has been uploaded, you may now click save.').css({'color':'#376d2e'});

                    firstThumbnail.src = response.thumb1;firstThumbnail.width = '150';firstThumbnail.height = '100';
                    secondThumbnail.src = response.thumb2;secondThumbnail.width = '150';secondThumbnail.height = '100';
                    thirdThumbnail.src = response.thumb3;thirdThumbnail.width = '150';thirdThumbnail.height = '100';
                    //document.getElementById("save").disabled = false;
                    $('#loader-status').fadeOut(500);
                    done = true;
                },
                error: function(response, status, e){
                    console.log('Oops something went wrong please contact the admin of TEFL TV.');
                },
                resetForm: true 
            });
    });
    
    $('#upload-cancel').on('click',function(){
        $('#cancel-upload-vid').modal('show');
    });

});//end of function

$('textarea#description').keyup(function(e){
    var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
$('textarea#description').mousemove(function(e){
    var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
// function checkLimit(limit){
//    $('#char-limit').html(limit+'/5000');
//    if(limit>=max){$('#char-limit').html(limit+'/5000 &nbsp;' + "<small style='font-style:italic;color:red'>Oops you reach the limit.</small>");}
// }

function checkLimit(limit){
   $('#char-limit').html(limit);
   if(limit<=min){$('#char-limit').html(limit).css({'color':'#ff0000'});$('#max-limit').html('/5000');}
   if(limit>=min && limit < max){
        $('#char-limit').html(limit).css({'color':'#0b58dd'});
        if(done){document.getElementById("save").disabled = false;}
       $('#max-limit').html('/5000');
    }
   else{document.getElementById("save").disabled = true;}
   if(limit>=max){
    var charLen = document.getElementById('description').value.length;
    $('#char-limit').html(limit);$('#max-limit').html('/5000 &nbsp;' + "<small style='font-style:italic;color:red'>Oops you reach the limit.</small>");
    }
    
}

function validate(){
    var title = $('#title').val();
    var desc = $('#description').val();
    var tag = $('#tags').val();
    if(title==""){
        errors('Oops title field is required.');
        return false;
    }
    else if(desc==""){
        errors('Oops description field is required.');
         return false;
    }
    else if(tag==""){ 
        errors('Oops tag field is required.');
         return false;
    }
    return true;
}
function errors(message){
    $('#validation-rule').modal('show');
    $('#error-msg').html(message);
}


