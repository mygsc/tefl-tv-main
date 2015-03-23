@extends('layouts.default')

@section('title')
Upload
@stop

@section('content')
<style type="text/css">
.image-upload > input{
    display: none;
}
div canvas{
    	padding: 3px;
    	cursor:pointer;
    	position: relative;
 }
 div canvas:hover{
    	outline:2px solid green;
 }
 .fileContainer {
    overflow: hidden;
    position: relative;
}

.fileContainer [type=file] {
    cursor: inherit;
    display: block;
    font-size: 999px;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
}

/* Example stylistic flourishes */

.fileContainer {
    border-radius: .5em;
    margin-right: auto!important;
    margin-left: auto!important;
    padding: .5em;
}

.fileContainer [type=file] {
    cursor: pointer;
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
					<div style="margin-left:auto; margin-right:auto;" >
						{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'vidSubmit'))}}
						<label class="fileContainer" style="margin-left:auto;">
							<img src="/img/icons/upload.png">
							{{Form::file('video', array('class'=>'','id'=>'vids-upload','accept'=>"video/*"))}}
						</label>
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
</div>


@stop

@section('css')
{{HTML::script('js/user/upload.js')}}
@stop

