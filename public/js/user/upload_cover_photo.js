$(document).ready(function() {
	$('#upload_cover_photo').change(function(){
	    if (this.files && this.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#preview_cover_photo').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(this.files[0]);
	    }
	});

	$('form#upload_cover_photo_form').on('submit',function(e){
		e.preventDefault();
		$(this).ajaxSubmit({ 

			url:   '/mychannels/change-cover-photo', 
			type: 'POST', 
			beforeSubmit: function() {
				$("#progressbar-loaded-cover").width('0%');
			},
			uploadProgress: function (event, position, total, percentComplete){ 
				$('#wrapper-cover').fadeIn();
				$("#progressbar-loaded-cover").width(percentComplete + '%');

				$('#percentage-cover').html(percentComplete+'%');
				$('#up-msg-cover').html('<i class="fa fa-info-circle"></i> '+' Please wait a moment while the video is uploading...').css({'color':'#5ec6e8'});

			},
			success: function(response){
				if(response.result === true){
					$('#upload-message-cover').text('Your profile was successfully updated').fadeIn(500);
					window.location.href=response.route;
				}else{
					$('#upload-message-cover').text('Please select only valid images ex: jpg, jpeg, png');
				}
				$('#loader-progress-cover').fadeOut();
				$('#loader-cover').fadeOut();
				$('#wrapper-cover').fadeOut();

			},
			error: function(response, status, e){
				console.log('Oops something went wrong please contact the admin of TEFL TV.');
			},
			resetForm: true 
		});
	});
});