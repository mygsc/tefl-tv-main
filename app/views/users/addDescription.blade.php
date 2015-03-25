@extends('layouts.default')


@section('content')
<style type="text/css" media="screen">
canvas.thumb-1, canvas.thumb-2, canvas.thumb-3, .file-choose{
	width:180px;
	height:101px;
	border:1px solid #ccc;
	cursor:pointer;
	margin-right: auto;
	margin-left: auto;
}
canvas.thumb-1:hover, canvas.thumb-2:hover, canvas.thumb-3:hover , .file-choose:hover {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
}
.file-upload {
position: relative;
overflow: hidden;
margin: 10px;
z-index: 9999999999;
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
		<div class="content-padding">
			{{--@if ($errors->any())
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
			@endif--}}
			@foreach($videos as $video)
			<br><br>
		{{Form::model($video, array('method' => 'PATCH','files'=>'true', 'route' => array('post.addDescription',$video->id)))}}
				<div class="well">
					<div class="row">
						<div class="col-md-6">
						<h3 style="text-align:center">Video Preview</h3>
							<div class="embed-responsive embed-responsive-16by9 h-video">

								<video preload="auto" width="400" id="media-video" controls poster="/img/thumbnails/video.png">
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.webm" type="video/webm" >
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.ogg" type="video/ogg" >
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.mp4" type="video/mp4" >
								</video>
							</div>

							<div class="col-sm-12" >
								<h3 style="text-align:center;padding-top:5px;">Available video thumbnail:</h3>	
								<center>
									<div id="screenshot">				
											<canvas class="thumb-1" id="img-thumb-1"></canvas>
																
											<canvas class="thumb-2" id="img-thumb-2"></canvas>
																													
											<canvas class="thumb-3" id="img-thumb-3"></canvas>
																															
									</div>
									<br/>
									
										<small>Or select desire thumbnail:</small><br>
										<img id="thumbnail" class="file-choose" src="/img/thumbnails/video.png">
										<br><br/>
										<div class="file-upload btn btn-primary">
											<span>Browse thumbnail</span>
											<input type="file" name="poster" id="poster" accept="image/*"/>
										</div>
										<br/><br/><br/><br/>
									</center>
							</div>
						</div>

						<div class="col-md-6">
							<h3>Add Information</h3>
							
							<div class="row">
								
								<div class="col-md-8" >
									{{Form::label('Title:')}}
									{{Form::text('title',null,array('class'=>'form-control', 'required'=>true))}}
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
								{{Form::hidden('encrypt',$video->file_name,array('id'=>'encrypt'))}}
								{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
								{{Form::hidden('thumbnail', 0, array('id'=>'selected-thumbnail'))}}
								{{Form::hidden('totalTime', 0, array('id'=>'total-time'))}}
								{{Form::hidden('tokenId', Session::get('tokenId'))}}
							</div>
							<div class="text-right">
							<br>
								
								{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'upload-cancel'))}}
								{{Form::submit('Save',array('class'=>'btn btn-primary'))}} {{--,'onclick'=>'return checkThumbnail();'--}}
								
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


@section('script')
{{HTML::script('js/user/upload-add-description.js')}}

@stop
