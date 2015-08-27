<div class="">
	<div class="col-md-12">
		<div class="row" id="vid-wrapper">
			<div id="vid-controls">
				<div class="embed-responsive embed-responsive-16by9">
					@if(file_exists(public_path('/videos/'.$videos->user_id.$videos->file_name.'/'.$videos->file_name.'.jpg')))
					<video preload="auto" id="media-video" width="100%" poster="/videos/{{$videos->user_id}}-{{$owner->channel_name}}/{{$videos->file_name}}/{{$videos->file_name}}_600x338.jpg" class="embed-responsive-item">
						<source id='mp4' src='/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4' type='video/mp4'>
						<source id='webm' src='/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.webm' type='video/webm'>
					</video>
					@else
					<video preload="auto" id="media-video" width="100%" poster="/img/thumbnails/video.png" class="embed-responsive-item">
						<source id='mp4' src='/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.mp4' type='video/mp4'>
						<source id='webm' src='/videos/{{$videos->user_id}}/{{$videos->file_name}}/{{$videos->file_name}}.webm' type='video/webm'>
					</video>
					@endif
				</div>
				@if($videos->monetize == 1 and $disableAds == false)
					@include('ads/responsive')
				@endif
				@include('elements/videoPlayer')
				@if($countAnnotation > 0)
					@for($i=0;$i < $countAnnotation;$i++)
						@if(strlen($annotations[$i]->link)>0)
							<div id='close-{{$i}}' class='annotation' style='{{$annotations[$i]->css}}'>
								<span id='annotation-close-{{$i}}' class='annotation-close glyphicon glyphicon-remove'></span>
								<a href="{{$annotations[$i]->link}}" target='_blank'>{{$annotations[$i]->content}}</a>
								{{Form::hidden('start-t-annotation'.$i,$annotations[$i]->start,['id'=>'start-t-annotation'.$i])}}
								{{Form::hidden('end-t-annotation'.$i,$annotations[$i]->end,['id'=>'end-t-annotation'.$i])}}
							</div>
						@else
							@if($annotations[$i]->types == 'speech')
								<div id='close-{{$i}}' class='speech' style='{{$annotations[$i]->css}}'>
									<span id='annotation-close-{{$i}}' class='annotation-close glyphicon glyphicon-remove'></span>
									{{$annotations[$i]->content}}
									{{Form::hidden('start-t-annotation'.$i,$annotations[$i]->start,['id'=>'start-t-annotation'.$i])}}
									{{Form::hidden('end-t-annotation'.$i,$annotations[$i]->end,['id'=>'end-t-annotation'.$i])}}
								</div>
							@else
							<div id='close-{{$i}}' class='annotation' style='{{$annotations[$i]->css}}'>
								<span id='annotation-close-{{$i}}' class='annotation-close glyphicon glyphicon-remove'></span>
								{{$annotations[$i]->content}}
								{{Form::hidden('start-t-annotation'.$i,$annotations[$i]->start,['id'=>'start-t-annotation'.$i])}}
								{{Form::hidden('end-t-annotation'.$i,$annotations[$i]->end,['id'=>'end-t-annotation'.$i])}}
							</div>

							@endif
						@endif

					@endfor
				@endif
				{{Form::hidden('count-annotation',$countAnnotation)}}
			</div>
		</div><!--/.row-->
	</div><!--/.col-md-7-->
</div>
