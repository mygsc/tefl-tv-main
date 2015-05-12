$(document).ready(function(){
	$("#btnfeedback").click(function() {
		var txtFeedback = $('#feedback').val();
		var txtUserId = $('#feedbackUser').val();
		var txtFeedbackerId = $('#feedbackOwner').val();
		if(txtFeedback.trim() == null || txtFeedback.trim() == 'undefined'){
			alert('Empty feedbacks. Please try again.');
		}else{
			$.ajax({
				type: 'POST',
				url: '/channels/post/feedbacks',
				cache: false, 
	            data: {
	            	feedback:txtFeedback,
	            	channel_id: txtFeedbackerId,
	            	user_id:txtUserId,
	            },
		        success: function(data){
		        	if(data['status'] == 'error'){
		        		$('#errorlabel').text(data['label']);
		        	}else if(data['status'] == 'success'){
		        		$('textarea#feedback').val('');
		        		$('#appendNewFeedbackHere').prepend(data['feedback']);
		        		// alert(data['status']);
		        	}
	           	}
	    	});
		}
	});

	$('form#addReplyFeedback').on('submit', function(e){
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
        			// alert(data['status']);
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
			url: '/channels/feedback-add-liked',
			cache: false, 
			context: this,
        	data: {
        		likeFeedbackId: $(this).find('input[name=likeFeedbackId]').val(),
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
			url: '/channels/feedback-add-disliked',
			cache: false, 
			context: this,
        	data: {
        		dislikeFeedbackId: $(this).find('input[name=dislikeFeedbackId]').val(),
        		dislikeUserId: $(this).find('input[name=dislikeUserId]').val(),
        		status: $(this).find('input[name=status]').val(),
        	},
        	success: function(data){
        		if(data['status'] == 'success'){
        			$(this).find('span#dislikescounts').text(data['dislikescount']);
        			$(this).find('input[name=status]').val(data['label']);
        			if(data['label'] == 'undisliked'){
        				$(this).find('span.fa-thumbs-down').addClass('redC');
        			} else if(data['label'] == 'disliked'){
        				$(this).find('span.fa-thumbs-down').removeClass('redC');
        			}
        			// alert(data['likescount']);
        		} 
            }
        });
	});
	// $('.feedbacksarea').mouseover(function(e) {
	// 	e.preventDefault();
	// 	$('.nav_div').show();		
	// });
	// $('.feedbacksarea').mouseout(function() {
	// 	$('.nav_div').hide();
	// });

	$('button.delete').click(function() {
		var channel_id = $(this).find('#channel_id').val();
		var user_id = $(this).find('#user_id').val(); 
		var feedback_id = $(this).find('#feedback_id').val();
		var deleteID = this.id;
		$.ajax({
			type: 'GET',
			url: '/mychannels/delete-feedback',
			cache: false,
			context: this,
			data: {channel_id: channel_id, user_id: user_id, feedback_id: feedback_id, id: deleteID},
			success: function(data){
				$('div#'+deleteID).fadeOut(500);
			}
		});
	});

	$('button.deleteReply').click(function() {
		var user_id = $(this).find('#deleteReply_user_id').val(); 
		var feedback_id = $(this).find('#deleteReply_feedback_id').val();
		var deleteReplyId = this.id;
		var id = this.value;
		// var replyDelete_Id = $this.find('#replyDelete_Id').val();

		$.ajax({
			type: 'POST',
			url: '/mychannels/delete-reply-feedback',
			cache: false,
			context: this,
			data: {user_id: user_id, feedback_id: feedback_id, deleteReplyId: deleteReplyId, id: id},
			success: function(data){
				$('div#'+ deleteReplyId).fadeOut(500);
			}
		});
	});

	$('button.spam').click(function() {
		var channel_id = $(this).find('#channel_id').val();
		var user_id = $(this).find('#user_id').val(); 
		var feedback_id = $(this).find('#feedback_id').val();
		var spamID = this.id;
		var feedbackId = $('#spam_feedback_id').val();
			$.ajax({
				type: 'POST',
				url: '/mychannels/spam-feedback',
				cache: false,
				context: this,
				data: {spamID: spamID, channel_id: channel_id, user_id: user_id, feedbackId: feedbackId},
				success: function(data){
					console.log(data);
				}
			});
	});

	$('button.reportReply').click(function() {
		var user_id = $(this).find('#report_user_id').val(); 
		var feedback_id = $(this).find('#report_feedback_id').val();
		var reportID = this.id;
			$.ajax({
				type: 'POST',
				url: '/mychannels/spam-reply-feedback',
				cache: false,
				context: this,
				data: {reportID: reportID, feedback_id: feedback_id, user_id: user_id},
				success: function(data){
					alert('Successfully reported this comment');
				}
			});
	});

}); 
