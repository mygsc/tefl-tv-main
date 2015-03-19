$(document).ready(function(){
	$("#btncomment").click(function() {
		var txtComment = $('#comment').val();
		var txtVideoId = $('#commentVideo').val();
		var txtUserId = $('#commentUser').val();
		if(txtComment.trim() == null || txtComment.trim() == 'undefined'){
			alert('Empty comment. Please try again.')
		}else{
			$.ajax({
				type: 'POST',
				url: '/addcomment',
				cache: false, 
	            data: {
	            	comment:txtComment,
	            	video_id:txtVideoId,
	            	user_id:txtUserId,
	            },
		        success: function(data){
		        	if(data['status'] == 'error'){
		        		$('#errorlabel').text(data['label']);
		        	}else if(data['status'] == 'success'){
		        		// alert(data['status']);
		        	}
	           	}
	    	});
		}
	});
	// $("#replyLink").click(function() {
	// 	$("#txtreply").removeClass("hidden");
	// 	$("#replybutton").removeClass("hidden");
	// 	$("#replyLink").addClass("hidden");
	// });
	$('form#video-addReply').on('submit', function(e){
		e.preventDefault();
		var url = $(this).prop('action');
		$.ajax({
			type: 'POST',
			url: url,
			cache: false, 
        	data: $(this).serialize(),//{
        	success: function(data){
        		if(data['status'] == 'error'){
        			$('#errorlabel').text(data['label']);
        		} else if(data['status'] == 'success'){
	        		alert(data['status']);
	        	}
        	}
    	});
    });
    $("#replyLink").click(function() {
		$("#txtreply").removeClass("hidden");
		$("#replybutton").removeClass("hidden");
		$("#replyLink").addClass("hidden");
	});
}); 