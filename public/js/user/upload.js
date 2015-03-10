$(document).ready(function(){
	var img = document.getElementById('img-vid-thumb');
	var channel = $('input[name=channel]').val();
	var selected;
	$('#progress').hide();
	$('#upload').change(function() {
   		$(this).closest("#submit").submit();
   		$('#progress').show();
	});

	$('#img-thumb-1').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-2').css({'outline-style':'none'});
		$('#img-thumb-3').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'1.jpg';
		selected = 1;
	});
	$('#img-thumb-2').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-1').css({'outline-style':'none'});
		$('#img-thumb-3').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'2.jpg';
		selected = 2;
	});
	$('#img-thumb-3').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-1').css({'outline-style':'none'});
		$('#img-thumb-2').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'3.jpg';
		selected = 3;
	});
});