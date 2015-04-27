<div class="row grey">
	<h2 class="orangeC mg-l-10">Latest Videos</h2>

	@foreach($latests as $latest)
	<div class="col-lg-3 col-md-4 col-sm-6">
		<div class="p-relative">
			<a href="{{route('homes.watch-video', array($latest->file_name))}}">

				<span class="v-time inline">{{$latest->total_time}}</span>
				<div class="thumbnail-2">
					<img class="hvr-grow-rotate"  src="{{$latest->thumbnail}}">
				</div>
				<div class="video-info">
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($latest->file_name))}}">{{$latest->title}}</a>
					</div>

					<div class="count">
						by: <a href="{{route('view.users.channel', array($latest->channel_name))}}">{{$latest->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{number_format($latest->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$latest->likes}} | {{date('F d, Y',strtotime($latest->created_at))}}
					</div>
				</div>
			</a>
		</div>
	</div>
	@endforeach
	
</div>