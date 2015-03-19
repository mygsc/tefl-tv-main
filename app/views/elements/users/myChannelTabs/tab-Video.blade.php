<div class="row">
	<br/>
	<div class="col-md-12">
	<button class="btn btn-default pull-right">Manage Videos</button>
	<div class="col-md-6 pull-right">
		<div class="input-group">
			{{ Form::text('add', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
			<span class="input-group-btn">
				{{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
			</span>
		</div>
	</div>
	<br/>
		<hr/>
		@foreach($usersVideos as $usersVideo)
		<div class="videos">
			<div class="col-md-3">
				<video height="auto" width="100%" class="h-video controls">
					<source src="/videos/{{$usersVideo->file_name}}.{{$usersVideo->extension}}" type="video/mp4" />		 
				</video>
				<div class="v-Info">
					{{$usersVideo->title}}
				</div>
				<div class="count">
					{{$usersVideo->views}} Views, {{$usersVideo->likes}} Likes
				</div>
			</div>
		</div>
		@endforeach	
	</div>
</div>
