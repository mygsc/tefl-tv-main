$(document).ready(function() {
	var subscribe = true;
	$('#subscriberLists > button').eq(){
		$("#subscribe").click(function() {
			if(subscribe == true) {
				$(this).html('Unsubscribe');
				subscribe = false;
			}else{
				$(this).html('Subscribe');
				subscribe = true;
			}
		});	
	}
		
});