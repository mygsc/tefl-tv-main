
<br /><br />
@foreach($searchResults as $result)
<div class="row">
	<div class="col-md-4">
		<a href="{{route('homes.watch-video', array($result->file_name))}}">
		<div class="thumbnail-2">
		<img src="{{$result->thumbnail}}"  class="hvr-grow-rotate" >
		<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
		</div>
		</a>
	</div>
	<div class="col-md-8">
		<a href="{{route('homes.watch-video', array($result->file_name))}}">{{$result->title}}</a><br />
		By: <a href="/channels/{{$result->channel_name}}">{{$result->channel_name}}</a><br />
		<p class="text-justify">{{str_limit($result->description, $limit = 100, $end = '...')}}</p>
		<i class="fa fa-eye"></i> {{$result->views}} | <i class="fa fa-thumbs-up"></i> {{$result->likes}} | <i class="fa fa-calendar"></i> {{date('F d, Y',strtotime($result->created_at))}}
		<br/>
		<small><b>Tags:</b></small>
		@foreach($result->tags as $tag)
			<a href="/search-result?search={{$tag}}">{{ $tag }}</a> |
		@endforeach

	<br /><br />
	</div>
</div>
<hr/>
@endforeach
{{$searchResults->appends(Input::get())->links()}}