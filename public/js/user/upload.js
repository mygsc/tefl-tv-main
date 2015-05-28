document.getElementById("save").disabled = true;
var firstThumbnail = document.getElementById('img-thumb-1');
var secondThumbnail = document.getElementById('img-thumb-2');
var thirdThumbnail = document.getElementById('img-thumb-3');
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
                $(this).closest("#vidSubmit").submit();
                $('.file-upload').fadeOut();$('#progress').fadeIn(500);//$('#wrapper').fadeIn(500); 
                $('.h-minH').fadeOut(500);
                $('#add-description').fadeIn(1000);
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
                    $('#percentage').html('Uploading...'+percentComplete+'%').css({'color':'#000'});
                    if(percentComplete==100){
                        $('#percentage').html('Done please wait a moment...');
                    }
                    //$('#percentage').html('Uploading and converting your video it takes several minutes.').css({'color':'#000'});
                },
                success: function(response){
                    // $('#percentage').html('Done please wait a moment...');
                    // window.location.href = "add-description!v="+response.file;
                    // $('#wrapper').fadeOut();  
                    $('#loader-progress').fadeOut();
		    $('#spinner').fadeOut();
                    document.getElementById('post-save').action = 'addDescription/'+response.vidid;
                    $('#percentage').html('<br/>Your video is completely uploaded you can now click save.').css({'color':'#3ea9cb'});
                    firstThumbnail.src = response.thumb1;firstThumbnail.width = 150;firstThumbnail.height = 100;
                    secondThumbnail.src = response.thumb2;secondThumbnail.width = 150;secondThumbnail.height = 100;
                    thirdThumbnail.src = response.thumb3;thirdThumbnail.width = 150;thirdThumbnail.height = 100;
                    document.getElementById("save").disabled = false;
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

// $('#description').keypress(function(e){
//     enterKey(e);
// });
 
//  function enterKey(e){
//     if(e.keyCode === 13){
//         var desc = $('#description').val();
//         desc + "\n";
//     }
// }








