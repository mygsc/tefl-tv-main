@extends('layouts.default')

@section('title')
Upload
@stop
@section('some_script')
{{HTML::script('js/jquery.min.js')}}
{{HTML::script('js/user/upload.js')}}
{{HTML::script('js/user/upload-add-description.js')}}
{{HTML::script('js/video-player/jquery.form.min.js')}}
{{--HTML::script('js/video-player/media.player.upload.min.js')--}}
{{HTML::script('js/bootstrap.min.js')}}
{{--HTML::style('css/vid.player.min.css')--}}
{{HTML::style('css/upload.min.css')}}
@stop
@section('content')

<div class="row White h-minH">
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2"> 
			<div class="well text-center" style="margin-top:50px">
				<div class="row">
					<h1>Upload Video</h1>
					<p>Video allowed types: mp4, webm, ogg, wmv, avi, flv and mov.</p>
					<p>Maximum size limit: 150mb</p>
					@if ($errors->any())
					<ul style="list-style:none;color:red">
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
					@endif
					{{Form::open(array('route' => 'post.upload','files' => true,'id'=>'vidSubmit'))}}
					<div style="margin-lewft:auto; margin-right:auto;" >
						<label class="fileContainer" style="margin-left:auto;">
							<img src="/img/icons/upload.png">
							{{Form::file('video', array('id'=>'vids-upload','accept'=>"video/*"))}}      
						</label>
					</div>
					
					<br>
					<label class="myLabel">
						<div style="display:none" id="progress">
							<small>Please wait...</small><br>
							{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px'))}}
						</div>
					</label> <br>
					<label id="upload-error"></label>
					
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row" style="display:none" id='add-description'>
	<div class="container page White same-H"> 
		<div class="">


			{{Form::open(array('route' => 'post.addDescription', 'files'=>true, 'id'=>'post-save'))}}

			<div class="row">

				<div class="col-md-12 content-padding">
					<div class="mg-t-20 content-padding">
						<div class="row">
							<h3 id="up-msg" class="text-center"></h3>
							<div class="col-md-10">
								<div class="row">
								<div id="wrapper">
									<div id="progressbar-loaded" class="text-center">
										<b><span id="percentage"></span></b>

									</div>
								</div>
								<p id="msg-status"></p>

								</div>
							</div>
							<div class="col-md-2 text-right">
								<div class="row">
								{{Form::submit('Save',array('class'=>'btn btn-primary','id'=>'save'))}}
								{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'upload-cancel'))}}
								</div>
							</div>
							<div class="row-same-height">
								<div class="col-md-5 col-md-height greyDark col-top ">
									<div class="p-relative mg-t-15">
										{{-- <h3 id='upload-status' style="text-align:center">
										HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px'))
										Uploading and converting your video it takes several minutes please wait... </h3> --}}

										<!-- {{ HTML::image('img/icons/uploading.gif',null,array('height'=>'18px','width' => '18px', 'id'=>'loader-progress'))}} -->
										<div class="embed-responsive embed-responsive-16by9 h-video">
											<video preload="auto" width="400" id="media-video">
												<source id='mp4' src="" type="video/mp4">
												<source id='webm' src="" type="video/webm">
												<source id='ogg' src="" type="video/ogg">
											</video>
										</div>
										{{-- @include('elements/videoPlayer') --}}
									</div>
									<div class="col-sm-12" >
										<h4 style="text-align:center;padding-top:5px;">Thumbnails will show after the video is finished uploading.</h4>
										<center>
											<div id="screenshot">
												<img class="thumb-1" id="img-thumb-1" src="/img/thumbnails/150x100.jpg" alt="" width="120" height="80">     
												<img class="thumb-2" id="img-thumb-2" src="/img/thumbnails/150x100.jpg" alt="" width="120" height="80">
												<img class="thumb-3" id="img-thumb-3" src="/img/thumbnails/150x100.jpg" alt="" width="120" height="80">      
												<br/>
												<small class="mg-t-10">or browse your own thumbnail:</small><br><br/>
												<img id="thumbnail" class="upPoster" src="/img/thumbnails/video.png">
												<br>
												<div class="file-upload2 btn btn-primary">
													<span>Browse thumbnail</span>
													<input type="file" name="poster" id="poster" accept="image/*"/>
												</div>
											</div>
										</center>
									</div>
								</div>

								<div class="col-md-7 col-md-height grey col-top ">
									<div class="col-md-12">
										<h3>Add Information to your video</h3>

										<div class="row">

											<div class="col-md-8" >
												{{Form::label('Title:')}}
												{{Form::text('title',null,array('class'=>'form-control', 'id'=>'title'))}}
												@if ($errors->has('title'))
												<small style="color:red">{{$errors->first('title')}}</small>
												@endif
											</div>
											<div class="col-md-4">
												{{Form::label('Publish/Unpublish:')}}
												{{ Form::select('publish', array('1' => 'Publish','0' => 'Unpublish'), 1 , array('class' => 'form-control')) }}

											</div> 

										</div>
										<div class="textbox-layout">
											<br/>
											{{Form::label('Description:')}}<small id='char-limit'>0/5000</small>  &nbsp;<small class="notes">*Minimum characters should be atleast 50 and max 5000.</small>
											@if ($errors->has('description'))
											<small style="color:red">{{$errors->first('description')}}</small><br>
											@endif

											{{Form::textarea('description',null,array('class'=>'form-control', 'style' => 'height:150px!important;', 'id'=>'description', 'maxlength'=>5000))}}


											<br/>
											{{Form::label('Tags:')}} &nbsp;<small class="notes">*Use comma(,) to separate each tags. e.g. Education,Blog<br/></small>
											{{Form::text('tags',null,array('class'=>'form-control'))}}
											@if ($errors->has('tags'))
											<small style="color:red">{{$errors->first('tags')}}</small>
											@endif

											{{Form::label('Category:')}}<br>
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
												{{Form::checkbox('cat[]','For Students',false,['id'=>'music-vid'])}}
												<label for='music-vid'>For Students</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Teachers',false,['id'=>'instruct'])}}
												<label for='instruct'>For Teachers</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Interviews',false,['id'=>'insterviews'])}}
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

											{{Form::hidden('thumbnail', 0, array('id'=>'selected-thumbnail'))}}
										</div>
									</div>

								</div>
							</div>
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
									<a id='user-cancel-upload' href="/cancel-upload" class="btn btn-primary">Yes</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		{{Form::close()}}
		<br/>
	</div>

</div>

</div>


@stop



