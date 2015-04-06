$(document).ready(function(){
	function counter(){
		var count = 0;
		$('#play-pause,.play-icon').click(function(e){
			count++;
			var text1 = $('#text1').val();
			e.preventDefault();
			if(count<2){
				$.post('/counter/'+text1,function(data){
					});
			}
		});
	}
	function addToFavorites(){
		$('#addToFavorites').click(function(e){
			var text1 = $('#text1').val();
			e.preventDefault();
			$.post('/mychannels/addToFavorites/'+text1,function(data){
					favoriteLoader();
				});
		});
	}
	function removeToFavorites(){
		$('#removeToFavorites').click(function(e){
			e.preventDefault();
			var text1 = $('#text1').val();
			$.post('/mychannels/removeToFavorites/'+text1,function(data){
					favoriteLoader();
				});
		});
	}
	function addToWatchLater(){
		$('#addToWatchLater').click(function(e){
			var text1 = $('#text1').val();
			e.preventDefault();
			$.post('/mychannels/addToWatchLater/'+text1,function(data){
					watchLaterLoader();
				});
		});
	}
	function removeToWatchLater(){
		$('#removeToWatchLater').click(function(e){
			var text1 = $('#text1').val();
			e.preventDefault();
			$.post('/mychannels/removeToWatchLater/'+text1,function(data){
					watchLaterLoader ();
				});
		});
	}
	function deletelist(){
	$('input[id^="playlist"]').each(function(){
		var list = $(this);
		list.click(function(e){
			var text1 = $('#text1').val();
			var value = list.val();
			e.preventDefault();
				$.post('/mychannels/removePlaylist/'+text1, {value:value},function(data){
					deleteLoader();
				});
			});

		});
	}
	function addToPlaylist(){
	$('input[id^="availablePlaylist"]').each(function(){
		var list = $(this);
		list.click(function(e){
			var text1 = $('#text1').val();
			var value = list.val();
			e.preventDefault();
				$.post('/mychannels/addChkBoxPlaylist/'+text1, {value:value},function(data){
					addLoader();
				});
			});
		});
	}
	function createPlaylist(){
		var count = 0;
		$('#createPlaylist').click(function(){
			var create = $(this);
			count++;
			if(count<2){
				createtext(create);
				
			}
		});
	}
	function createtext(create){
		$('#list').append('<input type="text" name="playlist" id="create" placeholder="Create playlist" style="margin-bottom:5px;"><textarea placeholder="Description" id="description"></textarea><select id="privacy" class="form-control"><option value="1">Publish</option><option value="0">Unpublish</option></select><br/><br/><button id="back" class="btn-ico" title="Back"><i class="fa fa-arrow-left"></i></button>&nbsp;<button type="submit" id="submit" value="Create" class="btn-ico pull-right" title="Create"><i class="fa fa-floppy-o"></i> Save</button>');
			create.hide();
			$('#list-checkbox').hide();
			$('#search-playlist').hide();
			$('#back').click(function(){
				backlist(create);	
			});
			$('#submit').click(function(e){
			var text1 = $('#text1').val();
			var name = $('input[id=create]').val();
			var description = $('textarea[id=description]').val();
			var privacy = $('select[id=privacy]').val();
			if(name === ""){
				$('input[id=create]').focus();
			}
			else if(description === ""){
				$('textarea[id=description]').focus();
			}
			else{
				e.preventDefault();
				$.post('/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
					loader();
				});
			}
			});
			
	}
	function backlist(create){
		
			create.show();
			$('#list-checkbox').show();
			$('#search-playlist').show();
			$('#create').hide();
			$('#description').hide();
			$('#privacy').hide();
			$('#back').hide();
			$('#submit').hide();
			createPlaylist2();
		
	}
	function createPlaylist2(){
		var count = 0;
		$('#createPlaylist').click(function(){
			var create = $(this);
			count++;
			if(count<2){
				create.hide();
				$('#create').show();
				$('#description').show();
				$('#privacy').show();
				$('#back').show();
				$('#submit').show();
				$('#list-checkbox').hide();
				$('#search-playlist').hide();
				$('#back').click(function(){
					backlist(create);	
				});
				$('#submit').click(function(e){
				var text1 = $('#text1').val();
				var name = $('input[id=create]').val();
				var description = $('textarea[id=description]').val();
				var privacy = $('select[id=privacy]').val();
					e.preventDefault();
					$.post('/mychannels/addPlaylist/'+text1, {name:name,description:description,privacy:privacy},function(data){
						loader();
					});
				});
			}
		});
	}
	function like(){
		$('#like').click(function(e){
			var text1 = $('#text1').val();
			e.preventDefault();
				$.post('/mychannels/likeVideo/'+text1,function(data){
					likeLoader();
				});
			});
		}
	function unlike(){
		$('#unlike').click(function(e){
			var text1 = $('#text1').val();
			e.preventDefault();
				$.post('/mychannels/unlikeVideo/'+text1,function(data){
					likeLoader();
				});
			});
		}
	function loader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
		$('body').append('<div id="playlist-div-create"></div>');
			$('#playlist-div-create').html('Sucessfully created');
			$('#playlist-div-create').css({
	         'opacity' : 0.7,
	         'position': 'absolute',
	         'top': 0,
	         'left': 0,
	         'background-color': 'black',
	         'color':'white',
	         'width': '150px',
	         'height':'50px',
	         'z-index': 5000
			});
			setTimeout(function(){
				if ($('#playlist-div-create').length > 0) {
					$('#playlist-div-create').remove();
				}
			}, 2000)
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();
				counter();
				like();
				unlike();
		});
	}
	function deleteLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="playlist-div-remove"></div>');
			$('#playlist-div-remove').html('Sucessfully removed on your playlist');
			$('#playlist-div-remove').css({
	         'opacity' : 0.7,
	         'position': 'fixed',
	         'top': 0,
	         'left': 0,
	         'background-color': 'black',
	         'color':'white',
	         'width': '150px',
	         'height':'50px',
	         'z-index': 5000
			});
			setTimeout(function(){
				if ($('#playlist-div-remove').length > 0) {
					$('#playlist-div-remove').remove();
				}
			}, 2000)
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();	
				removeToWatchLater();
				counter();
				like();
				unlike();
		});
	}

	function addLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('body').append('<div id="playlist-div-add"></div>');
			$('#playlist-div-add').html('Sucessfully added on your playlist');
			$('#playlist-div-add').css({
	         'opacity' : 0.7,
	         'position': 'fixed',
	         'top': 0,
	         'left': 0,
	         'background-color': 'black',
	         'color':'white',
	         'width': '150px',
	         'height':'50px',
	         'z-index': 5000
			});
			setTimeout(function(){
				if ($('#playlist-div-add').length > 0) {
					$('#playlist-div-add').remove();
				}
			}, 2000)
				addToPlaylist();
				createPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();	
				counter();
				like();
				unlike();
		});
	}

	function favoriteLoader(){
		$("#favotite-list").load(window.location.href+' #favotite-list',function(){
			addToPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();	
			removeToWatchLater();
			counter();
			like();
			unlike();
		});
	}	
	function watchLaterLoader(){
		$("#watchlater-list").load(window.location.href+' #watchlater-list',function(){
			addToPlaylist();
			deletelist();
			addToFavorites();
			removeToFavorites();
			addToWatchLater();
			removeToWatchLater();
			counter();
			like();
			unlike();
		});	
	}
	function likeLoader(){
		$("#like-span").load(window.location.href+' #like-span',function(){
			$("#like-counter").load(window.location.href+' #like-counter',function(){
				addToPlaylist();
				deletelist();
				addToFavorites();
				removeToFavorites();
				addToWatchLater();
				removeToWatchLater();
				counter();
				like();
				unlike();
			});
		});
	}
	addToPlaylist();
	createPlaylist();
	deletelist();
	addToFavorites();
	removeToFavorites();
	addToWatchLater();
	removeToWatchLater();
	counter();
	like();
	unlike();
});