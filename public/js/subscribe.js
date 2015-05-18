$(document).ready(function() {
	var subscribe = true;


	$("div#subscriberLists .btn").click(function() {			
		if(subscribe == true) {
			$(this).html('Unsubscribe');
			subscribe = false;
		}else{
			$(this).html('Subscribe');
			subscribe = true;
		}
	});
		
	$('form#subscribe-userChannel').on('submit', function(e){
		e.preventDefault();
		var url = $(this).prop('action');
		$.ajax({
			type: 'POST',
			url: url,
			cache: false, 
			context: this,
        	data: $(this).serialize(),//{
        	success: function(data){
        		$(this).find('input[name=status]').val(data['status']);
        		$(this).find('#subscribebutton').val(data['label']);
        		$(this).val(data['status']);
        		$(this).val(data['label']);
        		 //alert(data['status']);
        		// window.location.href = 'search/product?'+q;
            }
        });
	});
});