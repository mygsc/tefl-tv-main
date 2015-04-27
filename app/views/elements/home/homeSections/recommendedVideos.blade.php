	<!--RECOMMENDED VIDEOS SECTION -->
	<br/>
	<div class="row grey">
		
		<h2 class="orangeC mg-l-10">Recommended Videos</h2>
		<div class="col-md-12">
			<div class="row ">
				@foreach($recommendeds as $recommended)
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="p-relative">
						<a href="{{route('homes.watch-video', array($recommended->file_name))}}">
							<span class="v-time inline">{{$recommended->total_time}}</span> 	
							<div class="thumbnail-2">
								<img class="hvr-grow-rotate"  src="{{$recommended->thumbnail}}">
							</div>
							<div class="video-info">
								<div class="v-Info">
									<a href="{{route('homes.watch-video', array($recommended->file_name))}}">{{$recommended->title}}</a>
								</div>
								<div class="count">
									by: <a href="{{route('view.users.channel', array($recommended->channel_name))}}">{{$recommended->channel_name}}</a>
									<br />
									<i class="fa fa-eye"></i> {{number_format($recommended->views,0,null,',')}} | <i class="fa fa-thumbs-up"></i> {{$recommended->likes}} | {{date('F d, Y',strtotime($recommended->created_at))}}
								</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach
			</div>
		</div><!--/.col-md-12-->	
	</div><!--/.row for recommended videos-->