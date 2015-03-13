$(document).ready(function() {
	$('.watch').click(function(e) {
		alert($(this).has('input[name=user_id]').val(););
		e.preventDefault();
		$.ajax({
				type: 'POST',
				url: '/mychannels/post-watch-later',
				cache: false, 
	            data: userid:$(this).has('input[name=user_id]').val(),//{
		        success: function(data){
		        	alert(data);
	           	}
		});
		$(this).find('.caption').slideDown(250);
	});
});