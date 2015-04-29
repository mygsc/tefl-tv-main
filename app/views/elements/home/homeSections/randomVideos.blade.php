	<div class="row">
		<h2 class="orangeC mg-l-10">Random Videos</h2>
		@foreach($randoms as $random)
		<div class="col-lg-3 col-md-4 col-sm-6">
			<div class="p-relative">
				<a href="{{route('homes.watch-video', array($popular->file_name))}}">
					<span class="v-time inline">{{$popular->total_time}}</span>
					<div class="thumbnail-2">
						<img class="hvr-grow-rotate" src="{{$random->thumbnail}}">
					</div>
					<div class="video-info">
						<div class="v-Info">
							<a href="{{route('homes.watch-video', array($random->file_name))}}">{{$random->title}}</a>
						</div>
						<div class="count">
							by: <a href="{{route('view.users.channel', array($random->channel_name))}}">{{$random->channel_name}}</a>
							<br />
							<i class="fa fa-eye"></i> {{number_format($random->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$random->likes}} | {{date('F d, Y',strtotime($random->created_at))}}
						</div>
					</div>
				</a>
			</div>
		</div>
		@endforeach
		
	</div>