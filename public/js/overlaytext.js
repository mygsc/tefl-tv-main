$(document).ready(function() {
	$('.watch').click(function(e) {
		e.preventDefault();
		//alert($(this).find('#user_id').val());
		//alert($($(this).find('#video_id')).val());
		$(this).find('.caption').slideDown(250);

		$.ajax({
			type: 'POST',
			url: '/mychannels/post-watch-later',
			cache: false, 
	        data: {user_id: $(this).find('#user_id').val(), video_id: $(this).find('#video_id').val()},
	         	success: function(data){
	         		console.log(data);
	         		location.reload();
	         	}
	    });
	});
});