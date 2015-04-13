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
								if(name === ""){
									$('input[id=tags]').focus();
								}else{
									$.post('/mychannels/edit_tag/'+text1, {name:name,encrypt:encrypt},function(data){
										loader();
									});
								}
							
						});
				}
				$('input[id=close]').click(function(){
					loader();
				});
				$('span[id^="tagDelete"]').remove();
			});
		});
			$('span[id^="tagDelete"]').click(function(){
				var text1 = $('#text1').val();
				var encrypt = $(this).attr('data-encrypt');
				var divs = $('span[id^="tagDelete"]').length;
				if(confirm("Are you sure do you want to delete this tag?")){
					if(divs === 1){
						alert('Deleting the last tag is not available.');
					}
					else{
						$.post('/mychannels/removeTag/'+text1,{encrypt:encrypt},function(data){
								loader();
						});
					}	
				}else{}
			});

	}
	function loader(){
		$("#wrapper").load(window.location.href+' #wrapper',function(){
			edit();	
		});
	}
	edit();
});