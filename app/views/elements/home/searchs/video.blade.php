
<br /><br />
@foreach($searchResults as $result)
<div class="row">
	<div class="col-md-4">
		<img src="{{$result->thumbnail}}">
	</div>
	<div class="col-md-8">
		<a href="#">{{$result->title}}</a><br />
		By: <a href="#">{{$result->channel_name}}</a><br />
		<p class="text-justify">{{$result->description}}</p>
		<i class="fa fa-eye"></i> {{$result->views}} | <i class="fa fa-thumbs-up"></i> {{$result->likes}} | <i class="fa fa-calendar"></i> {{$result->created_at}}
		<br/>
		<small><b>Tags:</b></small>
		@foreach($result->tag as $tag)
			<a href="{{$tag['url']}}">{{ $tag['tags'] }}</a>
		@endforeach

	<br /><br />
	</div>
</div>
<hr/>
@endforeach