$(document).ready(function(){
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
        			$('#errorlabel').text(data['label']);
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
});