@extends('layouts.default')
@section('css')
	{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
	{{HTML::script('js/user/upload-add-description.js')}}
	{{HTML::script('js/video-player/media.player.upload.min.js')}}
@stop
@section('content')
<div class="row White">
	<div class="container page">	
		<div class="content-padding">
			{{--@if ($errors->any())
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
			@endif--}}
			@foreach($videos as $video)
			<br><br>
		{{Form::model($video, array('method' => 'PATCH','files'=>'true', 'route' => array('post.addDescription',Crypt::encrypt($video->id))))}}
				<div class="well">
					<div class="row">
						<div class="col-md-6">
							<div class="p-relative">
								<h3 style="text-align:center">Video Preview</h3>
								<div class="embed-responsive embed-responsive-16by9 h-video">
									<video preload="auto" width="400" id="media-video" poster="">
									   <source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.mp4" type="video/mp4">
										{{-- <source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.webm" type="video/webm">
										<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.ogg" type="video/ogg"> --}}
										
									</video>
									
								</div>
								@include('elements/videoPlayer')
							</div>
			
						</div>

						<div class="col-md-6">

							<div class="col-sm-12" >
								<h3 style="text-align:center;padding-top:5px;">Available video thumbnail:</h3>	
								<center>
									<div id="screenshot">				

										<img class="thumb-1" id="img-thumb-1" src="{{Session::get('thumbnail_1')}}" alt="" width="150" height="141">	
										<img class="thumb-2" id="img-thumb-2" src="{{Session::get('thumbnail_2')}}" alt="" width="150" height="141">	
										<img class="thumb-3" id="img-thumb-3" src="{{Session::get('thumbnail_3')}}" alt="" width="150" height="141">																
									</div>
									<br/>
									
										<small>Or select desire thumbnail:</small><br><br/>
										<img id="thumbnail" class="upPoster" src="/img/thumbnails/video.png">
										<br><br/>
										<div class="file-upload btn btn-primary">
											<span>Browse thumbnail</span>
											<input type="file" name="poster" id="poster" accept="image/*"/>
										</div>
										<br/><br/><br/><br/>
								</center>
							</div>
						</div>

						<div class="col-md-12">
							<h3>Add Information</h3>
							
							<div class="row">
								
								<div class="col-md-8" >
									{{Form::label('Title:')}}
									{{Form::text('title',null,array('class'=>'form-control', 'required'=>true, 'placeholder' => 'Title'))}}
									@if ($errors->has('title'))
										<small style="color:red">{{$errors->first('title')}}</small>
									@endif
								</div>
								<div class="col-md-4">
									{{Form::label('Publish/Unpublish:')}}
									{{ Form::select('publish', array('1' => 'Publish','0' => 'Unpublish'), 1 , array('class' => 'form-control','required'=>true)) }}

								</div> 
							
							</div>
							<div class="textbox-layout">
								<br/>
								{{Form::label('Description:')}}
								{{Form::textarea('description',null,array('class'=>'form-control', 'style' => 'height:200px!important;','required'=>true))}}
									@if ($errors->has('description'))
											<small style="color:red">{{$errors->first('description')}}</small><br>
									@endif
								{{Form::label('Tags:')}} &nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
								{{Form::text('tags',null,array('class'=>'form-control','required'=>true))}}
									@if ($errors->has('tags'))
											<small style="color:red">{{$errors->first('tags')}}</small>
									@endif
								<span class="span-tags">
									{{Form::checkbox('cat[]','Instructional',false,['id'=>'instruct'])}}
									<label for='instruct'>Instructional</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Video Blog',false,['id'=>'vid-blog'])}}
									<label for='vid-blog'>Video Blog</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Video CV',false,['id'=>'vid-cv'])}}
									<label for='vid-cv'>Video CV</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Job AD',false,['id'=>'job-ad'])}}
									<label for='job-ad'>Job AD</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Music',false,['id'=>'music'])}}
									<label for='music'>Music</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Music Video',false,['id'=>'music-vid'])}}
									<label for='music-vid'>Music Video</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Animated Video',false,['id'=>'anim-vid'])}}
									<label for='anim-vid'>Animated Video</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Animated Music Video',false,['id'=>'anim-music-vid'])}}
									<label for='anim-music-vid'>Animated Music Video</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Question and Answer',false,['id'=>'qa'])}}
									<label for='qa'>Question and Answer</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Advice',false,['id'=>'advice'])}}
									<label for='advice'>Advice</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Podcast',false,['id'=>'podcast'])}}
									<label for='podcast'>Podcast</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Interviews',false,['id'=>'insterviews'])}}
									<label for='interviews'>Interviews</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Documentaries',false,['id'=>'documentaries'])}}
									<label for='documentaries'>Documentaries</label>
								</span>
								<span class="span-tags">
									{{Form::checkbox('cat[]','Miscellaneous',false,['id'=>'miscellaneous'])}}
									<label for='miscellaneous'>Miscellaneous</label>
								</span>
									{{Form::hidden('encrypt',$video->file_name,array('id'=>'encrypt'))}}
									{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
									{{Form::hidden('thumbnail', 0, array('id'=>'selected-thumbnail'))}}
									{{Form::hidden('totalTime', 0, array('id'=>'total-time'))}}
									{{--Form::hidden('tokenId')--}}
							</div>
							<div class="text-right">
							<br>
								
								{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'upload-cancel'))}}
								{{Form::submit('Save',array('class'=>'btn btn-primary'))}} {{--,'onclick'=>'return checkThumbnail();'--}}
								
							</div>	
						</div>
							


							<div class="modal fade" id="cancel-upload-vid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel">Cancel Upload</h4>
							      </div>
							      <div class="modal-body">
							       		<p>Are you sure you want to cancel?</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							        <a href="{{route('user.upload.video.cancel',"v=". $video->file_name)}}" class="btn btn-primary">Yes</a>
							      </div>
							    </div>
							  </div>
							</div>
							@endforeach
							<input type="hidden" name="channel" value="{{Auth::User()->channel_name}}"/>

						</div>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>


@stop



