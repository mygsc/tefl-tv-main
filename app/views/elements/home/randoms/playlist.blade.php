<h1>playlist</h1>
@foreach($randomResults as $randomResult)
	<div class="col-md-12">
		<div class="row">
			<a href="#">{{$randomResult->name}}</a>
		</div>
	</div>

@endforeach