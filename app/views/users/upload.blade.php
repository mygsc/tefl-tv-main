@extends('layouts.default')

@section('title')
	Upload
@stop
@section('some_script')
	{{HTML::script('js/user/upload.js')}}
	{{HTML::script('js/video-player/jquery.form.min.js')}}
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
	height: 20px;
	background:transparent;
	border:1px solid #000000;
	display: none;
}div#wrapper div#progressbar-loaded{
	width:0;
	height: 100%;
	background:#0C78D6;
	
}


</style>


<div class="row White">
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2">	
			<div class="well text-center" style="margin-top:50px">
				<div class="row">
					<h1>Upload Video</h1>
					<p>Video allowed types: mp4, webm, ogg</p>
					<p>Recommended file extension: mp4</p>
					<p>Maximum size limit: 150mb</p>

					@if ($errors->any())
					<ul style="list-style:none;color:red">
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
					@endif
					{{Form::open(array('route' => 'post.upload','files' => true,'id'=>'vidSubmit'))}}
					<div style="margin-left:auto; margin-right:auto;" >
						<label class="fileContainer" style="margin-left:auto;">
							<img src="/img/icons/upload.png">
							{{Form::file('video', array('id'=>'vids-upload','accept'=>"video/*"))}}						
						</label>
					</div>
					
					<br>
					<label class="myLabel">
						<div style="display:none" id="progress">
							<small>Please wait...</small><br>
							{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}
						</div>
					</label> 
					<div id="wrapper">
							<div id="progressbar-loaded"></div> 
					</div><br/>
					 <label id="percentage"></label> 
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
</div>


@stop



