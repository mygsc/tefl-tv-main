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
});