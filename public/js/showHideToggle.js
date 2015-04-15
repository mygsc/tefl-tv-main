//show hide for reply Box-->

	jQuery(document).ready(function($) {
		$(".panelReply").hide('slow');
		$(".repLink").click(function(){
			
			$(this).next().show();
			// $(".panelReply").hide();
			// $(this).parent().children(".panelReply").slideToggle(500); 
		});
		// $("input[name=my-checkbox]").bootstrapSwitch();
	});
