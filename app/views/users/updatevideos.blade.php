@extends('layouts.default')
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/edit.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{--HTML::script('js/angular.min.js')--}}
<script type="text/javascript">
	var annotation = document.getElementById('annotation'), checkbox, count=0, annot = 'annotation', h=0, m=0,s=0, filename = document.getElementById('filename').value,types,content,start,end,link,
	hms = document.getElementById('hms').value, min=50, max=5000, limitChar = document.getElementById('description').value.length;
	$('#char-limit').html(limitChar);
	document.getElementById("submit-save-changes").disabled = true;
	if(limitChar>=50){
		document.getElementById("submit-save-changes").disabled = false;
	}
	$(document).ready(function() {

		$('#form-add-setting').on('submit', function() {
		        //.....
		        //show some spinner etc to indicate operation in progress
		        //.....
		        $.post(
		        	$(this).prop( 'action' ),{
		        		"_token": $( this ).find( 'input[name=_token]' ).val(),
		        		"setting_name": $( '#setting_name' ).val(),
		        		"setting_value": $( '#setting_value' ).val()
		        	},
		        	function( data ) {
		                //do something with data/response returned by server
		            },'json'
		            );
		        //.....
		        //do anything else you might want to do
		        //.....
		        //
		        //prevent the form from actually submitting in browser
		        return false;
		    } );
		$("#poster").on("change", function(){
			var reader = new FileReader();
			var files = !!this.files ? this.files : [];
		            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

		          if (/^image/.test( files[0].type)){ // only image file
		              reader.readAsDataURL(files[0]); // read the local file

		              reader.onloadend = function(){ // set image data as background of div
		                //var thumb = document.getElementById('thumbnail');//$("#thumbnail-local").css("background-image", "url("+this.result+")");
		                  //thumb.src=this.result;
		                  var videoPlayer = document.getElementById('media-video');
		                  videoPlayer.poster=this.result;
		                  videoPlayer.height='100%';
		                  videoPlayer.width='100%';
		              }
		          }
		      });
		$('#annotation-note').on('click',function(e){
			e.preventDefault();
			createAnnotation('Note:','note');    
		});
		$('#annotation-title').on('click',function(e){
			e.preventDefault();
			createAnnotation('Title:','title');     
		});
		$('#annotation-spotlight').on('click',function(e){
			e.preventDefault();
			createAnnotation('Spotlight:','spotlight');     
		});
		$('#annotation-label').on('click',function(e){
			e.preventDefault();
			createAnnotation('Label:','label');     
		});

		function createAnnotation(title,id){
			count += 1; 
			var annotationTypeTag = document.createElement('span');
			if(id=='note'){annotationTypeTag.className = 'glyphicon glyphicon-file';}
			else if(id=='title'){annotationTypeTag.className = 'glyphicon glyphicon-font';}
			else if(id=='spotlight'){annotationTypeTag.className = 'glyphicon glyphicon-link';}
			else if(id=='label'){annotationTypeTag.className = 'glyphicon glyphicon-comment';}
			var annotationTypeCaption = document.createTextNode(title);
			var types = document.createTextNode(title);
			var createDiv = document.createElement('div');
			var close = document.createElement('span');
			//close.id = 'close-annotation-' + id + '-' + count;
			close.title = 'Delete';
			close.className = 'glyphicon glyphicon-trash';
			var save = document.createElement('span');
			save.className = 'glyphicon glyphicon-floppy-save';
			save.title = 'Save-' + id;
			content = document.createElement('textarea'); 
			checkbox = document.createElement('input');
			checkbox.type = 'checkbox';  
			checkbox.name = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			checkbox.id = 'checkbox' + '-url-' + annot +'-' + id + '-' + count;
			var label = document.createElement('label');
			var labelText = document.createTextNode('link');
			var closeText = document.createTextNode(''); 
			var saveText = document.createTextNode('');  
			createDiv.appendChild(annotationTypeTag);
			annotationTypeTag.appendChild(annotationTypeCaption);
			close.appendChild(closeText);
			save.appendChild(saveText); 
			label.appendChild(labelText);
			close.setAttribute('style', 'color:#3f3b3b;cursor:pointer;border-bottom:1px solid red;padding:4px;background:rgba(42,42,42,0.3); text-align:center; float:right;');
			close.setAttribute('id', 'close-annotation-' + id + '-' + count);
			save.setAttribute('style', 'margin-right:2px;color:#3f3b3b;cursor:pointer;border-bottom:1px solid red;padding:4px;background:rgba(42,42,42,0.3); text-align:center; float:right;');
			save.setAttribute('id', 'save-annotation-' + id + '-' + count);
			createDiv.setAttribute('id', 'annotation-' + id + '-' + count);    
			createDiv.setAttribute('style', 'margin-bottom:5px;border-radius:4px;width:100%;height:100%;padding:19px;background:#e8e5e5;');
			content.setAttribute('placeholder', 'Enter text here...');
			content.setAttribute('id', 'content-annotation-'+id+'-'+count);
			content.style.marginTop = '5px';
			content.name = 'content-annotation-'+id+'-'+count;
			label.setAttribute('for', 'checkbox' + '-url-' + annot +'-' + id + '-' + count);
			label.setAttribute('style', 'margin-left:3px;cursor:pointer');
			annotation.appendChild(createDiv); 
			createDiv.appendChild(close);
			createDiv.appendChild(save);
			createDiv.appendChild(content); 
			
			 
			var startTagLabel = document.createElement('label');
			var startTagCaption = document.createTextNode('Start:');
				startTagLabel.appendChild(startTagCaption);
				createDiv.appendChild(startTagLabel);
			var startTime = document.createElement('input'); 
				startTime.type = 'text';
				startTime.id = 'start' + '-time-' + annot + '-' + id + '-' + count;
				startTime.name = 'start' + '-time-annotation-' + id + '-' + count;
				startTime.value = h+'0:'+m+'0:'+s+'0';
				createDiv.appendChild(startTime);
				
			var endTagLabel = document.createElement('label');
			var endTagCaption = document.createTextNode('End:');
				endTagLabel.appendChild(endTagCaption);
				createDiv.appendChild(endTagLabel);
			var endTime = document.createElement('input');  
				endTime.type = 'text';
				endTime.id = 'end' + '-time-annotation-' + id + '-' + count;
				endTime.name = 'end' + '-time-annotation-' + id + '-' +count;
				endTime.value = hms;
				createDiv.appendChild(endTime);
				createDiv.appendChild(checkbox); 
				createDiv.appendChild(label);
			var url = document.createElement('input');
					url.type = 'text';
					url.id = 'url' + '-annotation-' + id + '-' + count;
					url.name = 'url' + '-annotation-' + id + '-' + count;
					url.setAttribute('placeholder', 'Enter url');
					url.setAttribute('style', 'display:none');
					createDiv.appendChild(url);
			/*
			* Create div of Annotation at video 
			*/
			var annotWrapper = document.createElement('div');
			var annotDiv = document.createElement('div');
			var annotClose = document.createElement('span');
			if(id=="note"){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;top:0;left:0;background:rgba(42,42,42,0.6);');
			}
			else if(id=="title"){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;top:0;right:0;background:rgba(42,42,42,0.6);');
			}
			else if(id=='spotlight'){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;bottom:0;left:0;background:rgba(42,42,42,0.6);');
			}
			else if(id=='label'){
				annotDiv.setAttribute('style','padding:3px;color:#fff;min-width:200px;min-height:25px;position:absolute;bottom:0;right:0;background:rgba(42,42,42,0.6);');
			}
			annotDiv.setAttribute('id','div-annotation-' + id + '-' + count);
			annotClose.setAttribute('style','padding:2px;color:#fff;border-radius:0px 0px 0px 5px;position:absolute;top:0;right:0;background:rgba(42,42,42,0.8);cursor:pointer;');
			annotClose.setAttribute('id', 'close-annotation-' + id + '-' + count);
			document.getElementById("custom-annotation").appendChild(annotDiv);
			//var wrap = document.getElementById("custom-annotation");
			//wrap.insertBefore(annotDiv, wrap.firstChild);
			annotDiv.appendChild(annotClose);
			var annotContent = document.createTextNode(''); 
			var x = document.createTextNode('x');
			annotDiv.appendChild(annotContent);
			annotClose.appendChild(x);
			/*
			* Event listener of annotation builder 
			*/
			checkbox.onclick = function(){
				var getid = this.id;
				console.log(getid);
				var textbox = getid.replace('checkbox-','');
				if(document.getElementById(getid).checked == true) $('#' + textbox).fadeIn('fast');
				else $('#' + textbox).fadeOut('fast');
			  	
			};
			close.onclick = function(){
				var getid = this.id;
				var id = this.className; id = id.replace('glyphicon glyphicon-trash','');
				var removeDiv = getid.replace('close-','');
				$('#'+removeDiv).remove();
				$('#div-'+removeDiv).remove();
				annotations.remove(id);
			}
			close.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			close.onmouseleave = function(){
				var getid = this.id;
				$('.'+getid).css({'border-bottom':'1px solid red'});
				
			}
			save.onclick = function(){
				 var getid = this.id;
				 var titles = this.title;
				  content = getid.replace('save','content');
				  content = selector(content).value;
				  types = titles.replace('Save-','');
				  start = getid.replace('save','start-time');
				  start = selector(start).value;
				  end = getid.replace('save','end-time');
				  end = selector(end).value;
				  link = getid.replace('save','url');
				  link = selector(link).value;
				  filename = filename;
				 // start = getid.replace('save','content');
				 // var getNewId = getid.replace('save-', 'start-time-');
				 // var time = selector(getNewId).value;
				 // var getTime = time.split(":");
				 // console.log(filename,types,content,start,end,link);
				 annotations.add(filename,types,content,start,end,link);

				 
				
			}
			save.onmouseover = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'2px solid #0f85e0'});
			}
			save.onmouseleave = function(){
				var getid = this.id;
				$('#'+getid).css({'border-bottom':'1px solid red'});
			}
			annotClose.onclick = function(){
				var getid = this.id;
				var removeDiv = getid.replace('close-','');
				$('#'+removeDiv).remove();
				$('#div-'+removeDiv).remove();
			}
			content.onkeyup = function(){
				var getid = this.id;
				var getCurrentId = getid.replace('content','div');
				var contents = content.value;
				$('#'+getCurrentId).html(contents);
			}
			startTime.onkeyup = function(){
				var getid = this.id;
				var len = selector(getid).value.length;
				if(len>8){selector(getid).value='00:00:00';}
			}
			endTime.onkeyup = function(){
				var getid = this.id;
				var len = selector(getid).value.length;
				if(len>8){selector(getid).value=hms;}
			}
			annotDiv.onmousedown = function(e){
				 mov(e);
			} 
			annotDiv.onmouseup = function(){
				
			} 
			function mouseUp(){
				document.removeEventListener('mousemove',function(e){
					mov(e);
				},false);
			}
			function mouseDown(){
				document.addEventListener('mousemove',function(e){
					mov(e);
				},true);
			}
			function mov(e){
			  var div = selector('div-annotation-note-1');
			  div.style.top = e.pageY - (e.pageY - div.offsetTop) + "px";
			  div.style.left = e.pageX - (e.pageX - div.offsetLeft) + "px";
			}

			function selector(name){
				return document.getElementById(name);
			}
			var annotations = function(){
			return	{
						add: function(filename,types,content,start,end,link){
								$.ajax({
									type: 'POST',
									url:'/addannotation',
									data: {filename:filename, types:types,content:content,start:start,end:end,link:link},
									success: function(e){
										console.log(e.msg);
										close.className = 'glyphicon glyphicon-trash ' + e.id;
									},
									error: function(){
										console.log('OOps error while adding annotation.');
									}
								});
							},
						remove: function(id){
							$.ajax({
									type: 'POST',
									url:'/deleteannotation/'+id,
									data: {filename:filename},
									success: function(e){
										console.log(e.msg);
									},
									error: function(){
										console.log('OOps error while deleting annotation.');
									}
								});
						 }
					}
			}();
		}

	});

$('#t-1').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});
$('#t-2').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});
$('#t-3').bind('mouseover',function(){
	var selector = this.id;
	setAsThumbnail(selector);
});

$('#t-1').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-2').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-3').bind('mouseleave',function(){
	var selector = this.id;
	removeThumbnailCaption(selector);
});
$('#t-1').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-2').css({'border':'0px solid #0b8ddd'});
	$('#t-3').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-1').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
$('#t-2').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-3').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-2').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
$('#t-3').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-2').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-3').src;
	getId('selected-thumbnail').value = thumbSrc;
	document.getElementById('media-video').poster = thumbSrc;
});
function setAsThumbnail(selector){
	$('.caption-' + selector).html('Set as thumbnail').css({'color':'#0b8ddd','line-height':'90px', 'cursor':'pointer', 'background':'rgba(42,42,42,0.5)', 'text-align':'center', 'width':'100%','height':'100%', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'3px solid #0b8ddd','background':'rgba(42,42,42,0.5)'});
}
function removeThumbnailCaption(selector){
	$('.caption-' + selector).html('').css({'background':'transparent', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'0px solid #0b8ddd','background':'transparent'});
}
function getId(id){
 	return document.getElementById(id);
}
$('textarea#description').keyup(function(e){
	var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
$('textarea#description').mousemove(function(e){
	var getLength = document.getElementById('description').value.length;
   checkLimit(getLength);
});
function checkLimit(limit){
   $('#char-limit').html(limit);
   if(limit<=min){$('#char-limit').html(limit).css({'color':'#ff0000'});$('#max-limit').html('/5000');}
   if(limit>=min && limit < max){$('#char-limit').html(limit).css({'color':'#0b58dd'});document.getElementById("submit-save-changes").disabled = false;$('#max-limit').html('/5000');}
   else{document.getElementById("submit-save-changes").disabled = true;}
   if(limit>=max){
   	var charLen = document.getElementById('description').value.length;
   	$('#char-limit').html(limit);$('#max-limit').html('/5000 &nbsp;' + "<small style='font-style:italic;color:red'>Oops you reach the limit.</small>");
   	}
   	
}
$('#upload-cancel').on('click',function(){
        $('#cancel-upload-vid').modal('show');
    });

</script>
@stop
@section('content')
{{-- */$tagID = 1;/* --}}
{{-- */$explodeID = 0;/* --}}
{{-- */$tagDelete = 1;/* --}}
{{-- */$explodeRemove = 0;/* --}}




<div class="row">
	<div class="container page">
		<br/>
		<div class="row same-H White">
			@include('elements/users/profileTop')
			<div class="Div-channel-border">
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
						<li role="presentation" class="active">{{link_to_route('users.myvideos', 'My Videos')}}</li>
						<li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
						<li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
						<li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
						<!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
						<li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>

					</ul>
				</div><!--tabpanel-->
				<br/>

				<div id="videosContainer" class='container'>
					<div class="col-md-12">
						<!--upload update Video modal-->
						{{Form::model($video, array('route' => array('video.post.edit',$video->file_name), 'files'=>true))}}

						<div class="col-md-5">
							<br/>

							<div id="vid-controls" class="p-relative">

								<div class="embed-responsive embed-responsive-16by9" id='custom-annotation'>
									 
									@if(file_exists(public_path('/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'.jpg')))
									<video id="media-video" preload="auto" width="100%" poster="/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_600x338.jpg" class="embed-responsive-item">
										<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
											<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
											</video>
											@else
											<video id="media-video" preload="auto" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
												<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
													<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
													</video>
													@endif

												</div><!--embed-responsive-->
												@include('elements/videoPlayer')
											</div><!--vid-controls-->
											<br/>
											
											
											@if(file_exists($thumbnail))
											<h3>Available thumbnails:</h3>
												<div id='t-1' style='position:relative;display:inline-block'>
												<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb1.png'}}" id='thumb-1' class='img-thumbnail' width="150" height="100" >
												<label class='caption-t-1'></label>
												</div>
												<div id='t-2' style='position:relative;display:inline-block'>
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb2.png'}}" id='thumb-2' class='img-thumbnail' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<div id='t-3' style='position:relative;display:inline-block'>
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb3.png'}}" id='thumb-3' class='img-thumbnail' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
											@else
											<h3>No available thumbnail:</h3>
												<div id='t-1' style='position:relative;display:inline-block'>
													<img src="/img/thumbnails/125x125.jpg" id='thumb-1' class='img-thumbnail' width="150" height="100" >
													<label class='caption-t-1'></label>
												</div>
												<div id='t-2' style='position:relative;display:inline-block'>
													<img src="/img/thumbnails/125x125.jpg" id='thumb-2' class='img-thumbnail' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<div id='t-3' style='position:relative;display:inline-block'>
													<img src="/img/thumbnails/125x125.jpg" id='thumb-3' class='img-thumbnail' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
											@endif
											

										</div><!--/.col-md-5-->

										<div class="col-md-7 content-padding">
											<span class="file-upload mg-l--2">
												<span class="btn btn-default"><i class="fa fa-arrow-up"></i> Change Video Cover</span>
												<input type="file" name="poster" id="poster" accept="image/*"/>
												<input type="hidden" value="{{$video->file_name}}" name="filename" id="filename"/>
											</span>
											@if($video->publish == 0)
											@if($errors->has('publish'))
											<span class="inputError">
												{{$errors->first('publish')}}
											</span>
											@endif
											
											{{ Form::select('publish', ['1'=>'Publish','0'=>'Unpublish'], $video->publish,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}

											<span class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"> <span class='glyphicon glyphicon-comment'></span> Add Annotation
													<span class="caret"></span></button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														<li role="presentation"><a id='annotation-note' role="menuitem" tabindex="-1" href="#">Note</a></li>
														<li role="presentation"><a id='annotation-title' role="menuitem" tabindex="-1" href="#">Title</a></li>
														<li role="presentation"><a id='annotation-spotlight' role="menuitem" tabindex="-1" href="#">Spotlight</a></li>
														<li role="presentation"><a id='annotation-label' role="menuitem" tabindex="-1" href="#">Label</a></li>
													</ul>
												</span>
												@else
											
												{{ Form::select('publish', ['1'=>'Publish','0'=>'Unpublish'], $video->publish,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}

												<span class="dropdown">
													<button class="btn btn-default dropdown-toggle mg-l-10" type="button" id="menu1" data-toggle="dropdown"><span class='glyphicon glyphicon-comment'></span> Add Annotation
														<span class="caret"></span></button>
														<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
															<li role="presentation"><a id='annotation-note' role="menuitem" tabindex="-1" href="#">Note</a></li>
															<li role="presentation"><a id='annotation-title' role="menuitem" tabindex="-1" href="#">Title</a></li>
															<li role="presentation"><a id='annotation-spotlight' role="menuitem" tabindex="-1" href="#">Spotlight</a></li>
															<li role="presentation"><a id='annotation-label' role="menuitem" tabindex="-1" href="#">Label</a></li>
														</ul>
													</span>
													@endif
													<br>
													<div class="" id="annotation">
														<!--ANNOTATION AREA DON'T REMOVE-->
													</div>
													<br/>
													<div class="well">
														{{ Form::label('Title:')}}
														@if($errors->has('title'))
														<span class="inputError">
															{{$errors->first('title')}}
														</span>
														@endif
														{{ Form::text('title', null, array('class'=>'form-control','required'=>true)) }}
													</div>
													<div class="well">
														{{ Form::label('Description:')}}
														@if($errors->has('description'))
														<span class="inputError">
															{{$errors->first('description')}}
														</span>
														@endif
														{{ Form::textarea('description', null, array('class'=>'form-control','id'=>'description', 'style'=>"height:150px!important;",'required'=>true, 'maxlength'=>5000)) }}
														<small id='char-limit'>0</small><small id='max-limit'>/5000</small><br/>
														<small>Note: Minimum characters should be atleast 50 and max 5000.</small>
														
													</div>
													<div class="well">
														{{ Form::label('Tags:')}}&nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
														{{ Form::text('new_tags', null, array('class'=>'form-control','placeholder'=>'Add new tags...')) }}<br/><br/>
														{{ Form::hidden('text1',Crypt::encrypt($video->id), array('class'=>'form-control','id'=>'text1')) }}
														{{ Form::hidden('selected-thumbnail',0,['id'=>'selected-thumbnail'])}}
														{{ Form::hidden('hms',$hms,['id'=>'hms'])}}
														<p class="notes">*Double click the existing tag to edit.</p>
														<div id="wrapper">
															@if($tags == null)
															No tags available.
															@else
															@foreach($tags as $key=>$tag)
															<div class="span-tags" id="tagID{{$tagID++}}" data-encrypt="{{Crypt::encrypt($explodeID++)}}">{{$tag}} <span class="glyphicon glyphicon-remove-circle"  data-encrypt="{{Crypt::encrypt($explodeRemove++)}}" id="tagDelete{{$tagDelete++}}" style="cursor: pointer"></span>
															</div>
															@endforeach
															@endif
														</div>
														
													</div>
													<div class="well">
															{{Form::label('Categories:')}}<br/>
															<span class="v-category">
												{{Form::checkbox('cat[]','Advice',false,['id'=>'advice'])}}
												<label for='advice'>Advice</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Music Video',false,['id'=>'anim-music-vid'])}}
												<label for='anim-music-vid'>Animated Music Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Video',false,['id'=>'anim-vid'])}}
												<label for='anim-vid'>Animated Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Documentaries',false,['id'=>'documentaries'])}}
												<label for='documentaries'>Documentaries</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Students',false,['id'=>'for-students'])}}
												<label for='for-students'>For Students</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Teachers',false,['id'=>'for-teachers'])}}
												<label for='for-teachers'>For Teachers</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Interviews',false,['id'=>'interviews'])}}
												<label for='interviews'>Interviews</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Job AD',false,['id'=>'job-ad'])}}
												<label for='job-ad'>Job AD</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Miscellaneous',false,['id'=>'miscellaneous'])}}
												<label for='miscellaneous'>Miscellaneous</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Music',false,['id'=>'music'])}}
												<label for='music'>Music</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Podcast',false,['id'=>'podcast'])}}
												<label for='podcast'>Podcast</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Question and Answer',false,['id'=>'qa'])}}
												<label for='qa'>Question and Answer</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video Blog',false,['id'=>'vid-blog'])}}
												<label for='vid-blog'>Video Blog</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video CV',false,['id'=>'vid-cv'])}}
												<label for='vid-cv'>Video CV</label>
											</span>
														</div>	
													<br/>
													<div class="text-right mg-b-10"> 
														{{Form::submit('Save Changes', array('id'=>'submit-save-changes', 'class' => 'btn btn-info'))}}
													</div>
												</div><!--/.col-md-7-->
												{{Form::close()}}
											</div><!--/.col-md-12-->
										</div><!--/.videos-container-->
									</div><!--/.Div-channel-border-->
								</div><!--/.row same-H-->
								<br/>
							</div><!--/.containerpage row-->
						</div><!--/.row-->


						


						@stop




