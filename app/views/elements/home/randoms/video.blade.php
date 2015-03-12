<h1>Videos</h1>
@foreach($randomResults as $randomResult)
<div class="col-md-3">
	
		<img src="/img/thumbnails/v7.png">
		<div class="v-Info">
			<a href="{{route('homes.watch-video')}}">{{$randomResult->title}}</a>
		</div>
	
		<div class="count">
			by: <a href="{{route('view.users.channel', array($randomResult->channel_name))}}">{{$randomResult->channel_name}}</a>
			<br />
			<i class="fa fa-eye"></i> {{$randomResult->views}} | <i class="fa fa-thumbs-up"></i> {{$randomResult->likes}} | <i class="fa fa-calendar"></i> {{$randomResult->created_at}}
		</div>

	
</div>
@endforeach