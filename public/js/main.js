function getTimezoneOffset(){
	var users_date = new Date();
	var get_users_timezone = -users_date.getTimezoneOffset()/60;
	return get_users_timezone;
};

function setCorrectTimezone(current_time, users_GMT){
	if ($(".set_timezone")[0]){
		$(".set_timezone").each(function() {
			var this_element = $(this);
			var users_GMT = getTimezoneOffset();
			var current_time = $(this).text();
			var json_data = {users_GMT:users_GMT, current_time:current_time};

			$.get("/timezone", json_data, function(data, callback){
				this_element.text(data);
			});
		});
	}
};

$('.annotation').hover(function(){
	var id = this.id;
	$('#annotation-'+id).css({'display':'block','border-left':'1px solid #fff','border-bottom':'1px solid #fff','color':'#fff'});
});
$('.annotation').mouseleave(function(){
	var id = this.id;
	$('#annotation-'+id).css({'display':'none','border-left':'0px solid #fff','border-bottom':'0px solid #fff','color':'#fff'});
});

