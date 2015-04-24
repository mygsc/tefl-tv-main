<h1>Playlists</h1>
@foreach($datas as $randomResult)

<div class="col-md-4">
	<div class="p-relative">
		<div class="playlist-info" >
			{{$randomResult->video_count}}
			<br/>
			Videos
			<br/>
			<span class="glyphicon glyphicon-list fs-24"></span>
		</div>
		<a href="#">
		<img src="/img/thumbnails/v1.png" class="h-video">
		</a>
	</div>
	<div class="v-Info">
		<a href="#">{{$randomResult->name}}</a>
	</div>
	<div class="count">
		by:<a href="/channels/{{$randomResult->channel_name}}">{{$randomResult->channel_name}}</a>
	</div>
</div>




@endforeach