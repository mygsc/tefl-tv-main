@extends('layouts.default')


@section('content')
<div class="container White">	
	<div class="content-padding">
		<h1>Add Information</h1>
		@if ($errors->any())
		<ul>
			{{ implode('', $errors->all('<li class="error">:message</li>')) }}
		</ul>
		@endif
		@foreach($videos as $video)
		
		<div class="col-md-6">
			<div class="well">
				<div class="embed-responsive embed-responsive-16by9 h-video">
					<video width="400" controls>
						<source src="http://localhost:8000/videos/{{$video->file_name}}.{{$video->extension}}" type="video/{{$video->extension}}" >
						</video>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				{{Form::model($video, array('method' => 'PATCH',
				'route' => array('post.addDescription',
				Crypt::encrypt($video->id))))}}
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

				{{Form::label('Description:')}}
				{{Form::textarea('description',null,array('class'=>'form-control'))}}
				{{Form::label('Tags:')}}
				{{Form::text('tags',null,array('class'=>'form-control'))}}
				{{Form::hidden('encrypt',Crypt::encrypt($video->id),array('id'=>'encrypt'))}}
				{{Form::hidden('encrypt2',Crypt::encrypt($video->user_id),array('id'=>'encrypt2'))}}
				<div class="text-right">
					<span class="pull-left">*Use comma(,) to separate each tags. eg. Education,Blog<br/></span>
					{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'cancel'))}}
					{{Form::submit('Save',array('class'=>'btn btn-primary'))}}
					{{Form::close()}}
				</div>	
				@endforeach
			</div>
		</div>
	</div>
@stop