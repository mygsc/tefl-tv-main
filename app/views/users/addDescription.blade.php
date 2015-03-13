@extends('layouts.default')


@section('content')
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
			<div class="well">
				<div class="row">
					<div class="col-md-6">
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

					<div class="col-md-6">
						<h1>Add Information</h1>
						{{Form::model($video, array('method' => 'PATCH','route' => array('post.addDescription',Crypt::encrypt($video->id))))}}
						<div class="row">
							
							<div class="col-md-8" >
								{{Form::label('Title:')}}
								{{Form::text('title',null,array('class'=>'form-control'))}}
							</div>
							<div class="col-md-4">
								{{Form::label('Publish/Unpublish:')}}
								{{ Form::select('publish', array('0' => 'Unpublish', '1' => 'Publish'), null , array('class' => 'form-control')) }}

							</div> 
						
						</div>
						<div class="textbox-layout">
							<br/>
							{{Form::label('Description:')}}
							{{Form::textarea('description',null,array('class'=>'form-control', 'style' => 'height:200px!important;'))}}
							{{Form::label('Tags:')}} &nbsp;<span class="notes">( *Use comma(,) to separate each tags. e.g. Education,Blog )<br/></span>
							{{Form::text('tags',null,array('class'=>'form-control'))}}
							{{Form::hidden('encrypt',Crypt::encrypt($video->id),array('id'=>'encrypt'))}}
							{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
							{{Form::hidden('thumbnail', 1, array('id'=>'selected-thumbnail'))}}
						</div>
						<div class="text-right">
						<br>
							
							{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'cancel'))}}
							{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
							{{Form::close()}}
						</div>	
						@endforeach
						<input type="hidden" name="channel" value="{{Auth::User()->channel_name}}"/>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
