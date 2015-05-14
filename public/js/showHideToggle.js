//show hide for reply Box-->

	jQuery(document).ready(function($) {
		$(".panelReply").hide('slow');
		$("#mainCommentBody").on('click', '.repLink', function(){
			if($(this).next().css('display') == 'none'){
				// $(this).next().show();
				$(this).parent().children(".panelReply").slideToggle(500);
			}
			else if($(this).next().css('display') == 'block'){
				$(".panelReply").hide();
			}
		});
		// $("input[name=my-checkbox]").bootstrapSwitch();
	});

	