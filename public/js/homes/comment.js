// $(document).ready(function(){
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
		        		$('#replysection').find(".panelReply").hide('slow');
		        	}
	           	}
	    	});
		}
	});

	$('#mainCommentBody').on('submit', 'form#video-addReply', function(e){
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
        			$('textarea.txtreply').val('');
        			$(this).prepend(data['reply']);
	        	}
        	}
    	});
    });

    $('#mainCommentBody').on("click", '.repLink', function() {
		$("#txtreply").removeClass("hidden");
		$("#replybutton").removeClass("hidden");
		$("#replyLink").addClass("hidden");
	});

    var stopClickCommmentLike = false;
	$('#mainCommentBody').on("click", '.commentlikedup', function getCommentLikedUp() {
        if(stopClickCommmentLike) return;
        stopClickCommmentLike = true;
	    $.ajax({
			type: 'POST',
			url: '/addlikedcomment',
			cache: false, 
			context: this,
        	data: {
        		likeCommentId: $(this).find('input[name=likeCommentId]').val(),
        		likeUserId: $(this).find('input[name=likeUserId]').val(),
        		status: $(this).find('input[name=status]').val(),
        		video_id: $(this).find('input[name=video_id]').val()
        	},
        	success: function(data){
        		if(data['status'] == 'success'){
        			$(this).find('span#likescount').text(data['likescount']);
        			$(this).find('input[name=status]').val(data['label']);
        			if(data['label'] == 'unliked'){
        				$(this).find('span.fa-thumbs-up').addClass('blueC');
                        $(this).next('.commentdislikedup').find('span.fa-thumbs-down').removeClass('redC');
                        $(this).parent().find('.commentdislikedup > span.dislikescount').text(data['dislikesCount']);
                    } else if(data['label'] == 'liked'){
        				$(this).find('span.fa-thumbs-up').removeClass('blueC');
        			}
        			$(this).find('span.fa-thumbs-down').val(data['label']);
        		} 
                stopClickCommmentLike = false;
            }
        });
	});  
    var stopClickCommentDislike = false;
	$("#mainCommentBody").on("click", '.commentdislikedup', function () {
        if(stopClickCommentDislike) return;
        stopClickCommentDislike = true;
		$.ajax({
			type: 'POST',
			url: '/adddislikedcomment',
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
        			if(data['label'] == 'undisliked'){
        				$(this).find('span.fa-thumbs-down').addClass('redC');
                        $(this).parents().find('.commentlikedup > span.fa-thumbs-up').removeClass('blueC');
                        $(this).parent().find('.commentlikedup > span.likescount').text(data['likesCount']);
        			} else if(data['label'] == 'disliked'){
        				$(this).find('span.fa-thumbs-down').removeClass('redC');
        			}
        		} 
                stopClickCommentDislike = false;
            }
        });
	});
    
    var stopClickReplyLiked = false;
	$('#mainCommentBody').on("click", '.replylikedup', function() {
        if(stopClickReplyLiked) return;
        stopClickReplyLiked = true;
	    $.ajax({
			type: 'POST',
			url: '/addlikedreply',
			cache: false, 
			context: this,
        	data: {
        		likeCommentId: $(this).find('input[name=likeCommentId]').val(),
        		likeUserId: $(this).find('input[name=likeUserId]').val(),
        		status: $(this).find('input[name=status]').val(),
        		video_id: $(this).find('input[name=video_id]').val()
        	},
        	success: function(data){
        		if(data['status'] == 'success'){
        			$(this).find('span#likescount').text(data['likescount']);
        			$(this).find('input[name=status]').val(data['label']);
        			if(data['label'] == 'unliked'){
        				$(this).find('span.fa-thumbs-up').addClass('blueC');
                        $(this).parent().find('.replydislikedup > span.fa-thumbs-down').removeClass('redC');
                        $(this).parent().find('.replydislikedup > span.dislikescount').text(data['dislikesCountReply']);
                    } else if(data['label'] == 'liked'){
        				$(this).find('span.fa-thumbs-up').removeClass('blueC');
        			}
        			$(this).find('span.fa-thumbs-up').val(data['label']);
        		} 
                stopClickReplyLiked = false;
            }
        });
	});

    var stopClickReplyDisliked = false;
	$("#mainCommentBody").on("click", '.replydislikedup', function () {
        if(stopClickReplyDisliked) return;
        stopClickReplyDisliked = true;
		$.ajax({
			type: 'POST',
			url: '/adddislikedreply',
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
        			if(data['label'] == 'undisliked'){
        				$(this).find('span.fa-thumbs-down').addClass('redC');
                        $(this).parent().find('.replylikedup > span.fa-thumbs-up').removeClass('blueC');
                        $(this).parent().find('.replylikedup > span.likescount').text(data['likesCount']);
        			} else if(data['label'] == 'disliked'){
        				$(this).find('span.fa-thumbs-down').removeClass('redC');
        			}
        		} 
                stopClickReplyDisliked = false;
            }
        });
	});
// }); 
