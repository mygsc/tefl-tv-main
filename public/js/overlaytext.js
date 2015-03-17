$(document).ready(function() {
	$('.watch').click(function(e) {
		alert($(this).find('#video_id').val());
		alert($('input[id="user_id"]').val());
		$(this).find('.caption').slideDown(250);
	});
		$.ajax({
				type: 'POST',
				url: 'post-watch-later/',
				cache: false, 
	            data: {userid: $(this).has('input[id="user_id"]').val(), videoid: $(this).has('input[id="video_id"]').val()},//{
		        success: function(data){
		        	
	           	}
		});
});