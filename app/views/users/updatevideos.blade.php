@extends('layouts.default')
@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/edit.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
<script type="text/javascript">
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
			var annotation = document.getElementById('annotation');
			var createDiv = document.createElement('div');
			var createSpan = document.createElement('span');
			var createTextarea = document.createElement('textarea');        
			var elem = document.createTextNode(title);
			var spanContent = document.createTextNode('Delete');       
			createDiv.appendChild(elem);
			createSpan.appendChild(spanContent);  
			createDiv.setAttribute('id', 'annotation-'+id);    
			createDiv.setAttribute('style', 'width:100%;height:25px;color:#000;margin-top:10px;');
			annotation.appendChild(createDiv); 
			annotation.appendChild(createTextarea); 
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
});
$('#t-2').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-3').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-2').src;
	getId('selected-thumbnail').value = thumbSrc;
});
$('#t-3').bind('click',function(){
	var selector = this.id;
	$(this).css({'border':'3px solid #0b8ddd'});
	$('#t-1').css({'border':'0px solid #0b8ddd'});
	$('#t-2').css({'border':'0px solid #0b8ddd'});
	var thumbSrc = document.getElementById('thumb-3').src;
	getId('selected-thumbnail').value = thumbSrc;
});
function setAsThumbnail(selector){
	$('.caption-' + selector).html('Set as thumbnail').css({'line-height':'90px', 'cursor':'pointer', 'background':'rgba(42,42,42,0.5)', 'text-align':'center', 'width':'100%','height':'100%', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'3px solid #0b8ddd','background':'rgba(42,42,42,0.5)'});
}
function removeThumbnailCaption(selector){
	$('.caption-' + selector).html('').css({'background':'transparent', 'margin':'auto','position':'absolute','top':'0','left':'0','right':'0','bottom':'0'});
	$('#'+selector).css({'outline':'0px solid #0b8ddd','background':'transparent'});
}
function getId(id){
 	return document.getElementById(id);
}
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

								<div class="embed-responsive embed-responsive-16by9">
									<div style="color:#fff;padding:3px;background:rgba(42,42,42,0.9);position:absolute;top:0;left:0;z-index:1111;"class='annotation-custom'>
										Annotation
									</div>
									@if(file_exists(public_path('/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'.jpg')))
									<video id="media-video" width="100%" poster="/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}_600x338.jpg" class="embed-responsive-item">
										<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
											<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
											</video>
											@else
											<video id="media-video" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
												<source id='mp4' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.mp4' type='video/mp4'>
													<source id='webm' src='/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.webm' type='video/webm'>
													</video>
													@endif

												</div><!--embed-responsive-->
												@include('elements/videoPlayer')
											</div><!--vid-controls-->
											<br/>
											<p>Available thumbnails:</p>
											<div id='t-1' style='position:relative;display:inline-block'>
												<img src="{{Session::get('thumbnail_1')}}" id='thumb-1' class='img-thumbnail' width="150" height="100" >
												<label class='caption-t-1'></label>
											</div>
											<div id='t-2' style='position:relative;display:inline-block'>
												<img src="{{Session::get('thumbnail_2')}}" id='thumb-2' class='img-thumbnail' width="150" height="100" >
												<label class='caption-t-2'></label>
											</div>
											<div id='t-3' style='position:relative;display:inline-block'>
												<img src="{{Session::get('thumbnail_3')}}" id='thumb-3' class='img-thumbnail' width="150" height="100" >
												<label class='caption-t-3'></label>
											</div>


										</div><!--/.col-md-5-->

										<div class="col-md-7 content-padding">
											<span class="file-upload mg-l--2">
												<span class="btn btn-default"><i class="fa fa-arrow-up"></i> Update Video Cover</span>
												<input type="file" name="poster" id="poster" accept="image/*"/>
												<input type="hidden" value="{{$video->file_name}}" name="filename"/>
											</span>
											@if($video->publish == 0)
											@if($errors->has('publish'))
											<span class="inputError">
												{{$errors->first('publish')}}
											</span>
											@endif
											<?php $publish = array('0' => 'Unpublish', '1' => 'Publish');?>
											{{ Form::select('publish', $publish, null,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}

											<span class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">+ Add Annotation
													<span class="caret"></span></button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
														<li role="presentation"><a id='annotation-note' role="menuitem" tabindex="-1" href="#">Note</a></li>
														<li role="presentation"><a id='annotation-title' role="menuitem" tabindex="-1" href="#">Title</a></li>
														<li role="presentation"><a id='annotation-spotlight' role="menuitem" tabindex="-1" href="#">Spotlight</a></li>
														<li role="presentation"><a id='annotation-label' role="menuitem" tabindex="-1" href="#">Label</a></li>
													</ul>
												</span>
												@else
												<?php $publish = array('1' => 'Publish' , '0' => 'Unpublish');?>
												{{ Form::select('publish', $publish, null,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}

												<span class="dropdown">
													<button class="btn btn-default dropdown-toggle mg-l-10" type="button" id="menu1" data-toggle="dropdown">+ Add Annotation
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
														{{ Form::textarea('description', null, array('class'=>'form-control','style'=>"height:150px!important;",'required'=>true)) }}
													</div>
													<div class="well">
														{{ Form::label('Tags:')}}&nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
														{{ Form::text('new_tags', null, array('class'=>'form-control','placeholder'=>'Add new tags...')) }}<br/><br/>
														{{ Form::hidden('text1',Crypt::encrypt($video->id), array('class'=>'form-control','id'=>'text1')) }}
														{{ Form::hidden('selected-thumbnail',0,['id'=>'selected-thumbnail'])}}

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
													<br/>
													<div class="text-right mg-b-10"> 
														{{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
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


						@if(Session::has('success'))
						<div class="success">
							<p style="color:green">{{Session::pull('success')}}</p>
						</div>
						@endif


						@stop




