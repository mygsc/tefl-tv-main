@extends('layouts.default')
@section('css')
{{HTML::style('css/vid.player.min.css')}}
{{HTML::style('css/update-video.css')}}
@stop
@section('some_script')
{{HTML::script('js/subscribe.js')}}
{{HTML::script('js/user/edit.js')}}
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/updatevideo.js')}}

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

						<div class="col-md-8">
							<br/>

							<div id="vid-controls" class="p-relative">
								<div class="embed-responsive embed-responsive-16by9" id='custom-annotation'>
									<div id='preview-annotation'></div> 
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
											
											

										</div><!--/.col-md-8-->
										<div class="col-md-4 text-center">
											
											@if(file_exists($thumbnail))
											<h3 class="text-center">Available thumbnails:</h3>
												<div class="col-md-6 col-md-offset-3">
												<div id='t-1' style='position:relative;display:block' class="center-block">
												<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb1.png'}}" id='thumb-1' class='img-thumbnail thumbnail-2' width="150" height="100" >
												<label class='caption-t-1'></label>
												</div>
												<div id='t-2' style='position:relative;display:block' class="center-block">
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb2.png'}}" id='thumb-2' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<div id='t-3' style='position:relative;display:block' class="center-block">
													<img src="{{'/videos/'.$video->user_id.'-'.$owner->channel_name.'/'.$video->file_name.'/'.$video->file_name.'_thumb3.png'}}" id='thumb-3' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
												</div>
											@else
											<h3 class="text-center">No available thumbnail:</h3>
												<div id='t-1' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-1' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-1'></label>
												</div>
												<br/>
												<div id='t-2' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-2' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-2'></label>
												</div>
												<br/>
												<div id='t-3' style='position:relative;display:block' class="center-block">
													<img src="/img/thumbnails/125x125.jpg" id='thumb-3' class='img-thumbnail thumbnail-2' width="150" height="100" >
													<label class='caption-t-3'></label>
												</div>
											@endif
											<span class="file-upload mg-t-10">
												<span class="btn btn-primary"><i class="fa fa-arrow-up"></i> Upload Video Cover</span>
												<input type="file" name="poster" id="poster" accept="image/*"/>
												<input type="hidden" value="{{$video->file_name}}" name="filename" id="filename"/>
											</span>
											
											
										</div>

										<div class="col-md-12 content-padding">
											
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
														<li role="presentation"> <a id='annotation-note' role="menuitem" tabindex="-1" href="#"> <span class='glyphicon glyphicon-file'></span> Note</a></li>
														<li role="presentation"><a id='annotation-title' role="menuitem" tabindex="-2" href="#"><span class='glyphicon glyphicon-font'></span> Title</a></li>
														<li role="presentation"><a id='annotation-spotlight' role="menuitem" tabindex="-3" href="#"><span class='glyphicon glyphicon-link'></span> Spotlight</a></li>
														<li role="presentation"><a id='annotation-speech' role="menuitem" tabindex="-4" href="#"><span class='glyphicon glyphicon-comment'></span> Speech</a></li>
													</ul>
											</span>
											<span class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"> <span class='glyphicon glyphicon-pencil'></span> Edit Existing Annotation
													<span class="caret"></span></button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id='annotation-lists'>
														@if($countAnnotation > 0)
															@foreach($annotations as $annotation)
																<li id='forever-remove-annot-{{$annotation->id}}' role="presentation"><a id='{{$annotation->id}}'role="menuitem" class='option-annot' tabindex="-1" href="#">{{$annotation->types}}-{{str_limit($annotation->content,15)}}</a></li>
															@endforeach
														@else
																<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Empty</a></li>
														@endif                                                                                                                                                                                                     
													</ul>
											</span>
											
													<br>
													<ul id='editor-annotation'>
														<li><span id='edit-types'> </span> <div><span id='sv-annot' class="sv-annot glyphicon glyphicon-floppy-saved" title='Save changes'></span> <span id='rm-annot' title='Remove' class="rm-annot glyphicon glyphicon-trash"></span></div></li>
														<li>Content:{{Form::text('content',null,['id'=>'edit-content'])}}</li>
														<li>Start:{{Form::text('start',null)}}</li>
														<li>End:{{Form::text('end',null)}}</li>
														<li>Link: {{Form::checkbox('chk-link','grald',false,['id'=>'chk-link'])}}</li>
														<li>{{Form::text('link',null,['Placeholder'=>'Enter url e.g: http://www.tefltv.com', 'style'=>'display:none;','id'=>'annot-link'])}}</li>
													</ul>
													<div class="" id="annotation">
														<!--ANNOTATION AREA-->
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
															{{Form::label('Category:')}}<br/>
															<span class="v-category">
												{{Form::checkbox('cat[]','Advice',$videoCategory[0],['id'=>'advice'])}}
												<label for='advice'>Advice</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Music Video',$videoCategory[1],['id'=>'anim-music-vid'])}}
												<label for='anim-music-vid'>Animated Music Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Animated Video',$videoCategory[2],['id'=>'anim-vid'])}}
												<label for='anim-vid'>Animated Video</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Documentaries',$videoCategory[3],['id'=>'documentaries'])}}
												<label for='documentaries'>Documentaries</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Students',$videoCategory[4],['id'=>'for-students'])}}
												<label for='for-students'>For Students</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','For Teachers',$videoCategory[5],['id'=>'for-teachers'])}}
												<label for='for-teachers'>For Teachers</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Interviews',$videoCategory[6],['id'=>'interviews'])}}
												<label for='interviews'>Interviews</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Job AD',$videoCategory[7],['id'=>'job-ad'])}}
												<label for='job-ad'>Job AD</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Miscellaneous',$videoCategory[8],['id'=>'miscellaneous'])}}
												<label for='miscellaneous'>Miscellaneous</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Music',$videoCategory[9],['id'=>'music'])}}
												<label for='music'>Music</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Podcast',$videoCategory[10],['id'=>'podcast'])}}
												<label for='podcast'>Podcast</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','qa',$videoCategory[11],['id'=>'qa'])}}
												<label for='qa'>Question and Answer</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video Blog',$videoCategory[12],['id'=>'vid-blog'])}}
												<label for='vid-blog'>Video Blog</label>
											</span>
											<span class="v-category">
												{{Form::checkbox('cat[]','Video CV',$videoCategory[13],['id'=>'vid-cv'])}}
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




