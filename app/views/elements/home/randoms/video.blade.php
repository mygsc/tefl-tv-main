
<h1>Videos</h1>
@foreach($datas as $randomResult)


	<div class="col-md-3 col-sm-6 hidden-xs">
		<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">	
			<div class="thumbnail"> 
				@if(file_exists($randomResult->video_poster))
					<img class="hvr-grow-rotate" src="{{$randomResult->poster_path}}">
				@else
					<img class="hvr-grow-rotate" src="/img/thumbnails/video.png">
				@endif

				
			</div>
			<div class="v-Info">
				<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">{{$randomResult->title}}</a>
			</div>
		
			<div class="count">
				by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
				<br />
				<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($randomResult->created_at))}}
			</div>
		</a>
	</div>


	<div class="col-xs-12 visible-xs">
		<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">
			<div class="row">
				<div class="col-xs-4">
					@if(file_exists($randomResult->video_poster))
						<img class="thumbnail" src="{{$randomResult->poster_path}}">
					@else
						<img class="thumbnail" src="/img/thumbnails/video.png">
					@endif
				</div>
				<div class="col-xs-8">
					<div class="v-Info">
						<a href="{{route('homes.watch-video', array($randomResult->file_name))}}">{{$randomResult->title}}</a>
					</div>
			
					<div class="count">
						by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
						<br />
						<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}}| <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($randomResult->created_at))}}
					</div>
				</div>
			</div>
		</a>
	</div>
@endforeach