<h1>Videos</h1>
@foreach($datas as $randomResult)
<div class="col-md-3">
	<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">
		@if(file_exists($randomResult->video_poster))
							<img width="100%" src="{{$randomResult->poster_path}}">
						@else
							<img width="100%" src="/img/thumbnails/video.png">
						@endif
		<div class="v-Info">
			<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">{{$randomResult->title}}</a>
		</div>
	
		<div class="count">
			by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
			<br />
			<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($randomResult->created_at))}}
		</div>

	
</div>
</a>
@endforeach