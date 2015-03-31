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
 }div#wrapper{
	width:100%;
	height: 10px;
	background:transparent;
	border:1px solid #000000;
}div#wrapper div#progressbar-loaded{
	width:0;
	height: 8px;
	background:#337AB7;
}


</style>


<div class="row White">
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2">	
			<div class="well text-center" style="margin-top:50px">
				<div class="row">
					<h1>Upload Video</h1>
					<p>Video allowed types: wmv, mp4, webm, ogv</p>
					<p>Recommended file extension: mp4</p>
					<p>Maximum size limit: 150mb</p>

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
							<div id="wrapper">
								<div id="progressbar-loaded"></div>
							</div><br/>
							<label id="percentage"></label>
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

