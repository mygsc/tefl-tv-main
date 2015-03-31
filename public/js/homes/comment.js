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
		        		$('textarea#comment').val('');
		        		$('#appendNewCommentHere').prepend(data['comment']);
		        		// alert(data['status']);
		        	}
	           	}
	    	});
		}
	});

	$('form#video-addReply').on('submit', function(e){
		e.preventDefault();
		var url = $(this).prop('action');
		$.ajax({
			type: 'POST',
			url: url,
			context: this,
			cache: false, 
        	data: $(this).serialize(),//{
        	success: function(data){
        		if(data['status'] == 'error'){
        			$(this).find('.replyError').text(data['label']);
        			$("#errorlabel").focus();
        		}
        		if(data['status'] == 'success'){
        			alert(data['status']);
        			$('textarea.txtreply').val('');
        			$(this).prepend(data['reply']);
	        	}
        	}
    	});
    });

    $("#replyLink").click(function() {
		$("#txtreply").removeClass("hidden");
		$("#replybutton").removeClass("hidden");
		$("#replyLink").addClass("hidden");
	});

	$(".likedup").click(function() {
		$.ajax({
			type: 'POST',
			url: '/addliked',
			cache: false, 
			context: this,
        	data: {
        		likeCommentId: $(this).find('input[name=likeCommentId]').val(),
        		likeUserId: $(this).find('input[name=likeUserId]').val(),
        		status: $(this).find('input[name=status]').val()
        	},
        	success: function(data){
        		if(data['status'] == 'success'){
        			$(this).find('span#likescount').text(data['likescount']);
        			$(this).find('input[name=status]').val(data['label']);
        			if(data['label'] == 'unliked'){
        				$(this).find('span.fa-thumbs-up').addClass('blueC');
        			} else if(data['label'] == 'liked'){
        				$(this).find('span.fa-thumbs-up').removeClass('blueC');
        			}
        			$(this).find('span.fa-thumbs-up').val(data['label']);
        			// alert(data['likescount']);
        		} 
            }
        });
	});
	$(".dislikedup").click(function() {
		$.ajax({
			type: 'POST',
			url: '/adddisliked',
			cache: false, 
			context: this,
        	data: {
        		dislikeCommentId: $(this).find('input[name=dislikeCommentId]').val(),
        		dislikeUserId: $(this).find('input[name=dislikeUserId]').val(),
        		status: $(this).find('input[name=status]').val(),
        		video_id: $(this).find('input[name=video_id]').val()
        	},
        	success: function(data){
        		if(data['status'] == 'success'){
        			$(this).find('span#dislikescounts').text(data['dislikescount']);
        			$(this).find('input[name=status]').val(data['label']);
        			// alert(data['likescount']);
        		} 
            }
        });
	});
}); 
