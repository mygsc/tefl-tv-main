@extends('layouts.default')


@section('content')
<style type="text/css" media="screen">
	#img-thumb-1{
		position:relative;
	}#img-thumb-1:hover{
		outline:2px solid green;
	}.img-thumb1:hover,.img-thumb2:hover, .img-thumb3:hover{
		outline: 2px solid green;
	}
	video#video canvas{
		display: none;
	}
</style>
<div class="row White">
	<div class="container page">	
		<div class="content-padding">
			@if ($errors->any())
			<ul>
				{{ implode('', $errors->all('<li class="error">:message</li>')) }}
			</ul>
			@endif
			@foreach($videos as $video)
			<br><br>
		{{Form::model($video, array('method' => 'PATCH','files'=>'true', 'route' => array('post.addDescription',$video->id)))}}
				<div class="well">
					<div class="row">
						<div class="col-md-6">
							<div class="embed-responsive embed-responsive-16by9 h-video">
								<video width="400" id="video" controls poster="/img/thumbnails/video.png">
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.webm" type="video/webm" >
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.ogg" type="video/ogg" >
									<source src="/videos/{{Auth::User()->id.'-'.Auth::User()->channel_name.'/'.$video->file_name.'/'.$video->file_name}}.mp4" type="video/mp4" >
								</video>
							</div>

							<div class="col-sm-12" >
								<h3 style="text-align:center;padding-top:5px;">Browse your video thumbnail</h3>	
								
									{{--<div id="screenshot"><center>
										<div class="thumb" >
											<input type="file" name="poster" id="poster" style="position:absolute;width:100%;height:100%;opacity:0;cursor:pointer">
											Browse thumbnail
										</div>							
									</center></div>--}}
									<center>
										<img id="thumbnail" src="/img/thumbnails/video.png" width="250" height="150">		
											<input type="file" name="poster" id="poster"/>										
										</img>
									</center>
							</div>	
						</div>

						<div class="col-md-6">
							<h1>Add Information</h1>
							
							<div class="row">
								
								<div class="col-md-8" >
									{{Form::label('Title:')}}
									{{Form::text('title',null,array('class'=>'form-control', 'required'=>true))}}
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
								{{Form::label('Tags:')}} &nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
								{{Form::text('tags',null,array('class'=>'form-control','required'=>true))}}
								{{Form::hidden('encrypt',$video->file_name,array('id'=>'encrypt'))}}
								{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
								{{Form::hidden('thumbnail', 1, array('id'=>'selected-thumbnail'))}}
								{{Form::hidden('totalTime', 0, array('id'=>'total-time'))}}
								{{Form::hidden('tokenId', Session::get('tokenId'))}}
							</div>
							<div class="text-right">
							<br>
								
								{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'upload-cancel'))}}
								{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
								
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
{{HTML::script('js/user/upload.js')}}

@stop
