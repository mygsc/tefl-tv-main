$(document).ready(function() {
	$('#uploaded_img').change(function(){
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		}
	});

	$('form#upload_profile_picture').on('submit',function(e){
		e.preventDefault();
		$(this).ajaxSubmit({ 

			url:   '/mychannels/upload-image', 
			type: 'POST', 
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
				if(response.result === true){
					$('#upload-message').text('Your profile was successfully updated').fadeIn(500);
					window.location.href=response.route;
				}else{
					$('#upload-message').text('Please select only valid images ex: jpg, jpeg, png');
				}
				$('#loader-progress').fadeOut();
				$('#loader').fadeOut();
				$('#wrapper').fadeOut();

			},
			error: function(response, status, e){
				console.log('Oops something went wrong please contact the admin of TEFL TV.');
			},
			resetForm: true 
		});
	});
});