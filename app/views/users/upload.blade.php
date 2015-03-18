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
					@if(Session::has('success'))
						<div class="success">
							<p style="color:green">{{Session::pull('success')}}</p>
						</div>
					@endif()
					{{Form::open(array('route' => 'post.upload', 'method' => 'POST' ,'files' => true,'id'=>'vidSubmit'))}}

					{{Form::file('video', array('class'=>'btn btn-primary center-block','id'=>'vids-upload'))}}
					
					 <label class="myLabel">
						<div style="display:none" id="progress">
							<small>Please wait...</small><br>
							{{ HTML::image('img/icons/uploading.gif',null,array('height'=>'25px','width' => '25px')) }}
						</div>
					</label> 
					
					
				</div>

			</div>
		</div>
	</div>

<div class="container White" style="display:none" id="vids-thumbnails">	
	<div class="content-padding">
		<div class="col-md-6">
		<br><br>
			<div class="well">
				<div class="embed-responsive embed-responsive-16by9 h-video">
				    <video  onloadeddata="$(this).trigger('video_really_ready')" id="video"  width="400" poster="/img/thumbnails/video.png">
							<source src="/videos/movie.mp4" type="video/mp4" >
							<source src="/videos/movie.mov" type="video/mov" >
							<source src="/videos/movie.ogg" type="video/ogg" >
					</video>
				</div>
					
			</div>
			<div class="col-sm-12">
				<h4 style="text-align:center;padding-top:5px;">To change your video thumbnail click the image</h4>	
					<div id="screenshot">
						{{--DISPLAY THUMBNAIL DON'T DELETE THIS DIV--}}
					</div>	
				</div>
			</div>
			<div class="col-md-6">

				<div class="row">
				<div class="col-md-8" >
					<h1>Add Information</h1>
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
				{{Form::hidden('encrypt',null,array('id'=>'encrypt'))}}
				{{Form::hidden('encrypt2',null,array('id'=>'encrypt2'))}}
				{{Form::hidden('thumbnail', 1, array('id'=>'selected-thumbnail'))}}
				<div class="text-right">
				<br>
					<span class="pull-left">*Use comma(,) to separate each tags. e.g. Education,Blog<br/></span><br/>
					{{Form::button('Cancel',array('class'=>'btn btn-danger' , 'id'=>'cancel'))}}
					{{Form::submit('Start Upload',array('class'=>'btn btn-primary btn-md'))}}
					
				</div>	
				
				<input type="hidden" name="channel" value="{{Auth::User()->channel_name}}"/>

			</div>
		</div>
	</div>

	
{{Form::close()}}

@stop

@section('css')
{{-- <script language="javascript">
var VideoSnapper = {
        captureAsCanvas: function(video, options, handle) {
        
            // Create canvas and call handle function
            var callback = function() {
                // Create canvas
                var canvas = $('<canvas/>').attr({
                    width: options.width,
                    height: options.height
                })[0];
                // Get context and draw screen on it
                canvas.getContext('2d').drawImage(video, 0, 0, options.width, options.height);
                // Seek video back if we have previous position 
                if (prevPos) {
                    // Unbind seeked event - against loop
                    $(video).unbind('seeked');
                    // Seek video to previous position
                    video.currentTime = prevPos;
                }
                // Call handle function (because of event)
                handle.call(this, canvas);    
            }

            // If we have time in options 
            if (options.time && !isNaN(parseInt(options.time))) {
                // Save previous (current) video position
                var prevPos = video.currentTime;
                // Seek to any other time
                video.currentTime = options.time;
                // Wait for seeked event
                $(video).bind('seeked', callback);              
                return;
            }
            
            // Otherwise callback with video context - just for compatibility with calling in the seeked event
            return callback.apply(video);
        }
};

$(function() {
        $('video').bind('video_really_ready', function() {
            var video = this;
            $('#captures').click(function() {
            	alert('hello');
                var canvases = $('canvas');	
				//for(var start=1; start<=3; start++){
					//var img = Math.floor((Math.random() * 15) + 1);
					//var img = start*5;

					VideoSnapper.captureAsCanvas(video, { width: 160, height: 108, time:10}, function(canvas) {
					$('#screen').append(canvas);     
					                    
                        if (canvases.length == 4) 
                          canvases.eq(0).remove();
					});
					
				//}// end of for loop
                
            }); 
        });
    
    });
	

</script> --}}
@stop

