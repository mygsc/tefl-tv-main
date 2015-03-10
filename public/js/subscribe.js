$(document).ready(function() {
	var subscribe = true;
	
		$("#subscribe").click(function() {

				if(subscribe == true) {
					$(this).html('Unsubscribe');
					subscribe = false;
				}else{
					$(this).html('Subscribe');
				subscribe = true;
				}
			});	
	$('form#subscribe-userschannel').on('submit', function(e){
		e.preventDefault();
		var url = $(this).prop('action');
		$.ajax({
           	type: 'POST',
           	url: url,
           	cache: false, 
            data: $(this).serialize(),//{
	        	// _token:$('input[name=_token]').val(), 
	         //   	user_id:$('input[name=user_id]').val(),
	         //   	subscriber_id:$('input[name=subscriber_id]').val(),
	         //   	status:$('input[name=status]').val(),           },
           	success: function(data){
               alert(data);
               // window.location.href = 'search/product?'+q;
           	}
		});
	});
});