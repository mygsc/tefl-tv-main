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
		var count = 0;
		$('#addToFavorites').click(function(e){
			count++;
			if(count<2){
				var text1 = $('#text1').val();
				e.preventDefault();
				$.post('/mychannels/addToFavorites/'+text1,function(data){
					$('#addToFavorites').remove();
					$('#favotite-list').append('<p id="removeToFavorites" style="cursor: pointer"><img src="/img/icons/starActive.png"/>&nbsp;&nbsp;Favorites</p>');
					removeToFavorites();
				});
			}
		});
	}
	function removeToFavorites(){
		var count = 0;
		$('#removeToFavorites').click(function(e){
			count++;
			e.preventDefault();
			if(count<2){
				var text1 = $('#text1').val();
				$.post('/mychannels/removeToFavorites/'+text1,function(data){
					$('#removeToFavorites').remove();
					$('#favotite-list').append('<p id="addToFavorites" style="cursor: pointer"><img src="/img/icons/star.png"/>&nbsp;&nbsp;Favorites</p>');
						addToFavorites();
				});
			}
		});
	}
	function addToWatchLater(){
		var count = 0;
		$('#addToWatchLater').click(function(e){
			count++;
			var text1 = $('#text1').val();
			e.preventDefault();
			if(count<2){
				$.post('/mychannels/addToWatchLater/'+text1,function(data){
						$('#addToWatchLater').remove();
						$('#watchlater-list').append('<p id="removeToWatchLater" style="cursor: pointer"><img src="/img/icons/clockActive.png"/>&nbsp;&nbsp;Watch Later</p>');
						removeToWatchLater();
					});
			}
		});
	}
	function removeToWatchLater(){
		var count = 0;
		$('#removeToWatchLater').click(function(e){
			count++;
			var text1 = $('#text1').val();
			e.preventDefault();
			if(count<2){
				$.post('/mychannels/removeToWatchLater/'+text1,function(data){
						$('#removeToWatchLater').remove();
						$('#watchlater-list').append('<p id="addToWatchLater" style="cursor: pointer"><img src="/img/icons/clock.png"/>&nbsp;&nbsp;Watch Later</p>');
						addToWatchLater();
					});
			}
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
					$('li#playlist-value').remove();
					var playlistCounter = 0 ;
					var playlistNotChosenCounter = 0;
					var counter = 1;
					var counter2 = 1;
					$.each(data['playlists'],function(i,val){
						$('ul#list-checkbox').html(function(){	
							$(this).append('<li><input id="playlist'+counter+'" name="'+val['name']+'" type="checkbox"  checked="true" value="'+val['id']+'"> &nbsp; '+val['name']+'</li>');
						});
					counter++;
					});

					$.each(data['playlistNotChosens'],function(i,val){
						$('ul#list-checkbox').html(function(){	
							$(this).append('<li><input id="availablePlaylist'+counter2+'" name="'+val['name']+'" type="checkbox" value="'+val['id']+'"> &nbsp; '+val['name']+'</li>');
						});
					counter2++;
					});
					deletelist();

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
		var count = 0;
		$('#like').click(function(e){
			count++;
			if(count<2){
				var text1 = $('#text1').val();
				e.preventDefault();
					$.post('/mychannels/likeVideo/'+text1,function(data){
						if(data['dislikeResult'] !== 0){
							$.post('/mychannels/removeDislikeVideo/'+text1,function(data){
								$('body').find('span#dislike-counter').text(data['dislikeResult']);
								$('#remove-dislike').remove();
								$('#dislike-span').append('<i class="fa fa-thumbs-down hand" title="like this" id="dislike"></i>');
								dislike();
							});
							$('body').find('span#like-counter').text(data['likeResult']);
							$('#like').remove();
							$('#like-span').append('<i id="remove-like"><img src="/img/icons/like_active.png" style="cursor:pointer"></i>');
							
						}else{
							$('body').find('span#like-counter').text(data['likeResult']);
							$('#like').remove();
							$('#like-span').append('<i id="remove-like"><img src="/img/icons/like_active.png" style="cursor:pointer"></i>');
							
						}
						
						removeLike();

					});
			}			
		});
	}

	function dislike(){
		var count = 0;
		$('#dislike').click(function(e){
			count++;
			if(count<2){
			var text1 = $('#text1').val();
			e.preventDefault();
				$.post('/mychannels/dislikeVideo/'+text1,function(data){
				if(data['likeResult'] !== 0){
						$.post('/mychannels/unlikeVideo/'+text1,function(data){
							$('body').find('span#like-counter').text(data['likeResult']);
							$('#remove-like').remove();
							$('#like-span').append('<i class="fa fa-thumbs-up hand" title="like this" id="like" style="cursor:pointer"></i>');
							like();
						});
						$('body').find('span#dislike-counter').text(data['dislikeResult']);
						$('#dislike').remove();
						$('#dislike-span').append('<i id="remove-dislike"><img src="/img/icons/unlike_active.png"></i>');
						

					}else{
						$('body').find('span#dislike-counter').text(data['dislikeResult']);
						$('#dislike').remove();
						$('#dislike-span').append('<i id="remove-dislike"><img src="/img/icons/unlike_active.png" style="cursor:pointer"></i>');
					}
					removeDislike();	
				});
			}
		});
	}

	function removeLike(){
		var count = 0;
		$('#remove-like').click(function(e){
			count++;
			if(count<2){
			var text1 = $('#text1').val();
			e.preventDefault();
				$.post('/mychannels/unlikeVideo/'+text1,function(data){
					$('body').find('span#like-counter').text(data['likeResult']);
					$('#remove-like').remove();
					$('#like-span').append('<i class="fa fa-thumbs-up hand" title="like this" id="like"></i>');
					like();
				});
			}
		});	
	}

	function removeDislike(){
		var count = 0;
		$('#remove-dislike').click(function(e){
			count++;
			if(count<2){
			var text1 = $('#text1').val();
			e.preventDefault();
				$.post('/mychannels/removeDislikeVideo/'+text1,function(data){
					$('body').find('span#dislike-counter').text(data['dislikeResult']);
					$('#remove-dislike').remove();
					$('#dislike-span').append('<i class="fa fa-thumbs-down hand" title="like this" id="dislike"></i>');
					dislike();
				});
			}
		});	
	}
	function loader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
		$('#alert-playlist').append('<div id="playlist-div-create"></div>');
			$('#playlist-div-create').html('<a class="alert-link"><i class="fa fa-check"></i><small>Successfully Created</small></a>');
			$('#playlist-div-create').addClass("alert alert-success alert-dismissible");
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
		});
	}
	function deleteLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('#alert-playlist').append('<div id="playlist-div-remove"></div>');
			$('#playlist-div-remove').html('<a class="alert-link"><i class="fa fa-check"></i><small>Sucessfully removed on your playlist</small></a>');
			$('#playlist-div-remove').addClass("alert alert-success alert-dismissible");
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
		});
	}

	function addLoader(){
		$("#dropdown").load(window.location.href+' #dropdown',function(){
			$('#alert-playlist').append('<div id="playlist-div-add"></div>');
			$('#playlist-div-add').html('<a class="alert-link"><i class="fa fa-check"></i><small>Sucessfully added on your playlist</small></a>');
			$('#playlist-div-add').addClass("alert alert-success alert-dismissible");
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
	removeLike();
	dislike();
	removeDislike();
});

$('#publish-video').click(function(e){
	e.preventDefault();
	$('.pub-ads').slideToggle(1000);
});
$('#embed-video').click(function(e){
	e.preventDefault();
	$('.embed-frame').slideToggle(1000);
	document.getElementById('code-embed').focus();
});
$('#embed-own-ads').click(function(e){
	e.preventDefault();
	$('#embed-pub').toggle();
	document.getElementById('embed-pub').focus();
});
$('button[name=ads-proceed]').click(function(){
	$('.video-spinner').remove();
	var loader = document.createElement('div');
	loader.className = 'video-spinner';
	$('.pub-ads').append(loader);
	setTimeout(function(){
		adsResponse('Your ads was successfully inserted.');
		$('.pub-ads').slideToggle(5000);
	},5000);
});

function adsResponse(status){
	var resDiv = document.createElement('div'),
		msg = document.createTextNode(status);
	resDiv.setAttribute('style','outline:1px solid #fc8b02;position:absolute;top:0;bottom:0;right:0;left:0;margin:auto;text-align:center;height:30px;width:300px;padding:5px;background:#f1f1f1;color:#fc8b02;');
	resDiv.className = 'ads-response';
	resDiv.appendChild(msg);
	$('.pub-ads').append(resDiv);
	$('.video-spinner').remove();
	setTimeout(function(){
		$('.ads-response').remove();
	},4000);
}

