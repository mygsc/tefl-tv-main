@extends('layouts.default')

@section('title')
Upload
@stop

@section('content')

<style type="text/css">
	.image-upload > input
{
    display: none;
}
</style>


<div class="row White">
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2">
			
			<div class="well text-center" style="margin-top:50px">
				<div class="row">

					<h1>Upload Video</h1>

					@if ($errors->any())
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
					@endif

					
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'submit'))}}
					{{Form::file('video', array('class'=>'btn btn-primary center-block','id'=>'vids-upload'))}}

					
					
					<label class="myLabel">
						<div id="progress">
							{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}
						</div>
					</label>
					
					
				</div>

			</div>
		</div>
	</div>

<div class="container White" style="display:none" id="vids-thumbnails">	
	<div class="content-padding">
		<div class="col-md-6">
		<br><br>
			<div class="well">
				<div class="embed-responsive embed-responsive-16by9 h-video">
					    <video width="400" id="img-vid-thumb" poster="/img/thumbnails/video.png">
								<source src="/videos/bowlingmoa.mp4" type="video/mp4" >
								<source src="/videos/bowlingmoa.mov" type="video/mov" >
								<source src="/videos/bowlingmoa.ogg" type="video/ogg" >
						</video>
				</div>
				<div class="col-sm-12" >
				<h3 style="text-align:center;padding-top:5px;">Select your video thumbnail</h3>	
					<img style="cursor:pointer" id="img-thumb-1" src="/videos/tmp-img/upload-thumbnail.jpg" alt="" width="150" height="100" class="img-thumbnail">
						<img style="cursor:pointer" id="img-thumb-2" src="/videos/tmp-img/upload-thumbnail.jpg" alt="" width="150" height="100" class="img-thumbnail">
					<img style="cursor:pointer" id="img-thumb-3" src="/videos/tmp-img/upload-thumbnail.jpg" alt="" width="150" height="100" class="img-thumbnail">
				</div>	
			</div>
			</div>
			<div class="col-md-6">

				<div class="row">
				<div class="col-md-8" >
					<h1>Add Information</h1>
						{{Form::label('Title:')}}
						{{Form::text('title',null,array('class'=>'form-control'))}}
					</div>
					<div class="col-md-4">
						{{Form::label('Publish/Unpublish:')}}
						{{ Form::select('publish', array('0' => 'Unpublish', '1' => 'Publish'), null , array('class' => 'form-control')) }}

					</div> 
				</div>

				{{Form::label('Description:')}}
				{{Form::textarea('description',null,array('class'=>'form-control'))}}
				{{Form::label('Tags:')}}
				{{Form::text('tags',null,array('class'=>'form-control'))}}
				{{Form::hidden('encrypt',null,array('id'=>'encrypt'))}}
				{{Form::hidden('encrypt2',null,array('id'=>'encrypt2'))}}
				{{Form::hidden('thumbnail', 1, array('id'=>'selected-thumbnail'))}}
				<div class="text-right">
				<br>
					<span class="pull-left">*Use comma(,) to separate each tags. e.g. Education,Blog<br/></span>
					{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'cancel'))}}
					{{Form::submit('Start Upload',array('class'=>'btn btn-primary btn-md'))}}
					{{Form::close()}}
				</div>	
				
				<input type="hidden" name="channel" value="{{Auth::User()->channel_name}}"/>

			</div>
		</div>
	</div>





	
{{Form::close()}}

@stop

