$(document).ready(function(){
	$('a[id^="videourl"]').each(function(){
		var url = $(this).attr('href');
		$(this).each(function(){
		var new_url = url.replace(/[\*\^\'\!\@\#\$\&\(\)\/]/g, '').replace(/ /g,'+');
			$(this).attr('href',new_url);
		});
	});
});