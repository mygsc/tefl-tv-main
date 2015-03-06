@foreach($searchResults as $result)
<div class="col-md-12">
	Title: <a href="#">{{$result->title}}</a><br />
	Description: {{$result->description}}<br />
	Author: <a href="#">{{$result->channel_name}}</a><br />
	<br /><br />
</div>
@endforeach