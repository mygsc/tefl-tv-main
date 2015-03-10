@foreach($searchResults as $result)
<div class="col-md-12">
	Title: <a href="#">{{$result->title}}</a><br />
	Description: {{$result->description}}<br />
	Author: <a href="#">{{$result->channel_name}}</a><br />
	Tags: 
	@foreach($result->tag as $tag)
		<a href="{{$tag['url']}}">{{ $tag['tags'] }}</a>
	@endforeach
	<br /><br />
</div>
@endforeach