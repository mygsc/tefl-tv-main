@extends('layouts.default')

@section('content')
	{{-- */$tagID = 1;/* --}}
	{{-- */$explodeID = 0;/* --}}
	{{-- */$tagDelete = 1;/* --}}
	{{-- */$explodeRemove = 0;/* --}}
	<style type="text/css" media="screen">
	.file-upload {
position: relative;
overflow: hidden;
margin: 10px;
}
.file-upload input#poster {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
	</style>
<div class="row White">
	<div class="container page">
		<br/>
		<div class="row">
			@include('elements/users/profileTop')
			<br/>
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

					</ul><!--tabNav-->
				</div>

				<br/>

				<div id="videosContainer" class='container'>
					<!--upload update Video modal-->
			{{Form::model($video, array('route' => array('video.post.edit',Crypt::encrypt($video->id)), 'files'=>true))}}
					<div class="col-md-5">
						<br/>
						@if(file_exists(public_path("/videos/".$video->user_id."-".$owner->channel_name."/".$video->file_name."/".$video->file_name.".jpg")))
							<img id="thumbnail" src="/videos/{{$video->user_id}}-{{$owner->channel_name}}/{{$video->file_name}}/{{$video->file_name}}.jpg">
						@else
							<img id="thumbnail" src="/img/thumbnails/video.png">
						@endif
						<div class="file-upload btn btn-primary">
							<span>Browse thumbnail</span>
							<input type="file" name="poster" id="poster" accept="image/*"/>
							<input type="hidden" value="{{$video->file_name}}" name="filename"/>
						</div>
					</div>

					<div class="col-md-7">
						@if($video->publish == 0)
						@if($errors->has('publish'))
							<span class="inputError">
								{{$errors->first('publish')}}
							</span>
						@endif
						<?php $publish = array('0' => 'Unpublish', '1' => 'Publish');?>
						{{ Form::select('publish', $publish, null,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}
						@else
						<?php $publish = array('1' => 'Publish' , '0' => 'Unpublish');?>
						{{ Form::select('publish', $publish, null,array('class'=>"form-control",'style'=>"width:auto;margin-top:10px;margin-bottom:10px"))}}
						@endif
						<br/>
						{{ Form::label('Title:')}}
						@if($errors->has('title'))
							<span class="inputError">
								{{$errors->first('title')}}
							</span>
						@endif
						{{ Form::text('title', null, array('class'=>'form-control','required'=>true)) }}
						{{ Form::label('Description:')}}
						@if($errors->has('description'))
							<span class="inputError">
								{{$errors->first('description')}}
							</span>
						@endif
						{{ Form::textarea('description', null, array('class'=>'form-control','style'=>"height:150px!important;",'required'=>true)) }}
						{{ Form::label('Tags:')}}
						{{ Form::text('new_tags', null, array('class'=>'form-control','placeholder'=>'Add new tags...')) }}<br/><br/>
						{{ Form::hidden('text1',Crypt::encrypt($video->id), array('class'=>'form-control','id'=>'text1')) }}
						<p><font color="red">*Double click the existing tag to edit.</font></p>
							<div id="wrapper">
								@foreach($tags as $key=>$tag)
									<div style="	
										background-color:#1f3359;
										padding: 10px 5px;
										color: #fff;
										margin-bottom:5px;
										display: inline-block;" id="tagID{{$tagID++}}" data-encrypt="{{Crypt::encrypt($explodeID++)}}">{{$tag}} <span class="glyphicon glyphicon-remove-circle"  data-encrypt="{{Crypt::encrypt($explodeRemove++)}}" id="tagDelete{{$tagDelete++}}" style="cursor: pointer"></span></div>
								@endforeach
							</div>
							<br/>
							<div class="text-right"> 
								{{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
							</div>
					</div>
			{{Form::close()}}


				</div>


			</div>

		</div>
	</div>
</div>


@if(Session::has('success'))
<div class="success">
	<p style="color:green">{{Session::pull('success')}}</p>
</div>
@endif()


@stop

@section('script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/edit.js')}}
{{HTML::script('js/media.player.js')}}

<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>

<script type="text/javascript">
	$(document).ready( function( $ ) {
		var success = $('#uploaded').val();
		if(success == 1){
			$('<div id="success" style="width:400px;height:40px;display:block;color:green">New video has been uploaded successfully.</div>').appendTo('body');
			$('#success').fadeOut(20000);
		}
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
		                var thumb = document.getElementById('thumbnail');//$("#thumbnail-local").css("background-image", "url("+this.result+")");
		                  
		                  thumb.src=this.result;
		                  videoPlayer.poster=this.result;
		                   thumb.height=150;
		                    thumb.width=250;
		              }
		          }
		    });
	} );
</script>
@stop


