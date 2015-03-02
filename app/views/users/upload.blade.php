@extends('layouts.default')

@section('title')
Upload
@stop

@section('content')
<div class="container White">
	<div class="col-md-8">
		<br/>
		<div class="well text-center">
			<div class="row">
				<h1>Upload Video</h1>
				@if ($errors->any())
				<ul>
					{{ implode('', $errors->all('<li class="error">:message</li>')) }}
				</ul>
				@endif
				<div class="col-md-4">
					<span class="form-control">
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'submit'))}}
						
						{{Form::file('video',array('class'=>'btn btrn-primary','id'=>'upload'))}}
					</span>
					
					<br/>
				</div>

				<div class="col-md-4">
					<label class="myLabel">
					<div id="progress">{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}</div>
					{{Form::close()}}
					</label>
				</div>
			</div>

		</div>
	</div>
</div>
	
@stop
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
{{HTML::script('js/user/upload.js')}}