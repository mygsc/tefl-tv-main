<div class="row">
	<h2 class="orangeC mg-l-10">Popular Videos</h2>
	@foreach($populars as $popular)
	<div class="col-lg-3 col-md-4 col-sm-6">
		<div class="p-relative">
			<a href="{{route('homes.watch-video', array($popular->file_name))}}">
				<span class="v-time inline">{{$popular->total_time}}</span>
				<div class="thumbnail-2">
					<img class="hvr-grow-rotate" src="{{$popular->thumbnail}}">
				</div>
				<div class="video-info">
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($popular->file_name))}}">{{$popular->title}}</a>
					</div>
					<div class="count">
						by: <a href="{{route('view.users.channel', array($popular->channel_name))}}">{{$popular->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{number_format($popular->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$popular->likes}} | {{date('F d, Y',strtotime($popular->created_at))}}
					</div>
				</div>
			</a>
		</div>
	</div>
	@endforeach
	
</div>