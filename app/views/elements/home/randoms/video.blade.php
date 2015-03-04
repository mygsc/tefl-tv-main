<h1>Video</h1>
@foreach($randomResults as $randomResult)
<div class="col-md-3">
	
		<img src="/img/thumbnails/v7.png">
		<div class="v-Info">
			{{$randomResult->title}}<br />
		</div>
		<div class="count">
			{{$randomResult->views}} Views,
			{{$randomResult->likes}} Likes 
		</div>
	
</div>
@endforeach