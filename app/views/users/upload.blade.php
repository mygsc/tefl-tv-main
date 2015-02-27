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
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true))}}
						
						{{Form::file('video',null,array('class'=>'btn btrn-primary'))}}
					</span>
					
					<br/>
				</div>

				<div class="col-md-4">
					<label class="myLabel">
					{{Form::submit('Upload',array('class'=>'btn btn-primary btn-lg hidden'))}}
					<span class="btn btn-lg btn-primary whiteC"><i class="fa fa-upload"></i>&nbsp;Upload</span>
					{{Form::close()}}
					</label>
				</div>
			</div>

		</div>
	</div>
</div>
	
@stop