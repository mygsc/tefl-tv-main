<h1>Video</h1>
@foreach($randomResults as $randomResult)
<div class="col-md-12">
	<div class="row">
		{{$randomResult->title}}<br />
		Views {{$randomResult->views}}
		Like {{$randomResult->likes}}
	</div>
</div>
@endforeach