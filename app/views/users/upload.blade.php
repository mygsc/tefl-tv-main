@extends('layouts.default')

@section('title')
Upload
@stop

@section('content')
<style type="text/css">
.image-upload > input{
    display: none;
}div canvas{
    	padding: 3px;
    	cursor:pointer;
    	position: relative;
 }
 div canvas:hover{
    	outline:2px solid green;
 }
</style>


<div class="row White">
	<div class="container page" id="select-upload">
		<div class="col-md-8 col-md-offset-2">
			
			<div class="well text-center" style="margin-top:50px">
				<div class="row">

					<h1>Upload Video</h1>

					@if ($errors->any())
					<ul>
						{{ implode('', $errors->all('<li class="error">:message</li>')) }}
					</ul>
					@endif
	
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'vidSubmit'))}}

					{{Form::file('video', array('class'=>'btn btn-primary center-block','id'=>'vids-upload'))}}
					
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

