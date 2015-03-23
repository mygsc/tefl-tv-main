$(document).ready(function(){
	function edit(){
		var count = 0;
		$('div[id^="tagID"]').each(function(){
			var encrypt = $(this).attr('data-encrypt');
			var text1 = $('#text1').val();
			$(this).dblclick(function(){
				count++;
				if(count<2){
					$(this).append('<input type="text"  value="'+ $(this).text().trim() +'" id="tags"><input type="button" value="Close" class="btn btn-danger" id="close"> <input type="button" value="Update" id="button" class="btn btn-info">');
						$('input[id=button]').click(function(e){
						var name = $('input[id=tags]').val();			
							e.preventDefault();
							$.post('http://localhost:8000/mychannels/edit_tag/'+text1, {name:name,encrypt:encrypt},function(data){
								loader();
							});
						});
				}
				$('input[id=close]').click(function(){
					loader();
				});
			});
		});
			$('span[id^="tagDelete"]').click(function(){
				var text1 = $('#text1').val();
				var encrypt = $(this).attr('data-encrypt');
				$.post('http://localhost:8000/mychannels/removeTag/'+text1,{encrypt:encrypt},function(data){
						loader();
				});
			});

	}
	function loader(){
		$("#wrapper").load(window.location.href+' #wrapper',function(){
			edit();	
		});
	}
	edit();
});