$(document).ready(function(){
	$('#progress').hide();
	$('#upload').change(function() {
   		$(this).closest("#submit").submit();
   		$('#progress').show();
	});
});