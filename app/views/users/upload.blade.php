@extends('layouts.default')

@section('title')
Upload
@stop

@section('content')
<style type="text/css">
.image-upload > input{
    display: none;
}
.file-upload {
	position: relative;
	overflow: hidden;
	margin: 10px;
}
.file-upload input#vids-upload {
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
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2">
			
			<div class="well text-center" style="margin-top:50px">
				<div class="row">

					<h1>Upload Video</h1>
					<p>Video allowed types: wmv, mp4, webm, ogg</p>
					<p>Maximum size limit: 300mb</p>

					@if ($errors->any())
					<ul style="list-style:none;color:red">
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
					@endif
	
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'vidSubmit'))}}

					<div class="file-upload btn btn-primary">
					<span>Select video to upload</span>
					{{Form::file('video', array('class'=>'','id'=>'vids-upload','accept'=>"video/*"))}}
					</div>

					<br>
					 <label class="myLabel">
						<div style="display:none" id="progress">
							<small>Please wait...</small><br>
							{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}
						</div>
					</label> 
					{{Form::close()}}
					
					
					
				</div>

			</div>
		</div>
	</div>


@stop

@section('css')
{{HTML::script('js/user/upload.js')}}
@stop

