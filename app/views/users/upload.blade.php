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
				{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'submit'))}}
					<div class="col-md-4">
						
							{{Form::file('video', array('class'=>'btn btn-primary','id'=>'vids-upload'))}}
						
						
					</div>

					<div class="col-md-4">
						<label class="myLabel">
							<div id="progress">
								{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}
							</div>
						</label>
					</div>
				{{Form::close()}}
			</div>

		</div>
	</div>
</div>
	
@stop
 