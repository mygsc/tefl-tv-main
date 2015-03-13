$(document).ready(function(){
	$('#progress').hide();
	var img = document.getElementById('img-vid-thumb');
	var channel = $('input[name=channel]').val();
	var selected = 1;
  
	$('#vids-upload').change(function(){
   		//$(this).closest("#vidSubmit").submit();
   		//document.getElementById('vidSubmit').submit();
   		$('#progress').show();
   		$('#select-upload').fadeOut();
   		$('#vids-thumbnails').fadeIn(1500);
	});
	$('#img-thumb-1').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-2').css({'outline-style':'none'});
		$('#img-thumb-3').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'1.jpg';
		selected = 1;
		document.getElementById('selected-thumbnail').value = selected;
	});
	$('#img-thumb-2').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-1').css({'outline-style':'none'});
		$('#img-thumb-3').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'2.jpg';
		selected = 2;
		document.getElementById('selected-thumbnail').value = selected;
	});
	$('#img-thumb-3').click(function(){
		$(this).css({'outline':'2px solid green'});
		$('#img-thumb-1').css({'outline-style':'none'});
		$('#img-thumb-2').css({'outline-style':'none'});
		img.poster = "/videos/tmp-img/"+channel+'3.jpg';
		selected = 3;
		document.getElementById('selected-thumbnail').value = selected;
	});
});