$(document).ready(function(){
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
   	$('#viewing .modal-body').text("Loading...");
	});
});