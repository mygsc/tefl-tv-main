@extends('layouts.default')


@section('content')
<div class="container White">	
	<div class="content-padding">
		@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
		@endif
		@foreach($videos as $video)
		<br><br>
		<div class="col-md-6">
			<div class="well">
				<div class="embed-responsive embed-responsive-16by9 h-video">
					    <video width="400" id="img-vid-thumb" controls poster="/img/thumbnails/video.png">
								<source src="/videos/{{$video->file_name}}.{{$video->extension}}" type="video/mp4" >
								<source src="/videos/{{$video->file_name}}.mov" type="video/mov" >
								<source src="/videos/{{$video->file_name}}.ogg" type="video/ogg" >
						</video>
				</div>
				<div class="col-sm-12" >
				<h3 style="text-align:center;padding-top:5px;">Select your video thumbnail</h3>	
					<img style="cursor:pointer" id="img-thumb-1" src="/videos/tmp-img/{{Auth::User()->channel_name}}1.jpg" alt="" width="150" height="100" class="img-thumbnail">
						<img style="cursor:pointer" id="img-thumb-2" src="/videos/tmp-img/{{Auth::User()->channel_name}}2.jpg" alt="" width="150" height="100" class="img-thumbnail">
					<img style="cursor:pointer" id="img-thumb-3" src="/videos/tmp-img/{{Auth::User()->channel_name}}3.jpg" alt="" width="150" height="100" class="img-thumbnail">
				</div>	
			</div>
			</div>
			<div class="col-md-6">

				{{Form::model($video, array('method' => 'PATCH','route' => array('post.addDescription',Crypt::encrypt($video->id))))}}
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
				{{Form::hidden('encrypt',Crypt::encrypt($video->id),array('id'=>'encrypt'))}}
				{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
				{{Form::hidden('thumbnail', 1, array('id'=>'selected-thumbnail'))}}
				<div class="text-right">
				<br>
					<span class="pull-left">*Use comma(,) to separate each tags. e.g. Education,Blog<br/></span>
					{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'cancel'))}}
					{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
					{{Form::close()}}
				</div>	
				@endforeach
				<input type="hidden" name="channel" value="{{Auth::User()->channel_name}}"/>

			</div>
		</div>
	</div>
@stop
