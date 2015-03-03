<h1>Top Channels</h1>
@foreach($randomResults as $randomResult)
	<div class="col-md-12">
		<div class="row">
			@if(file_exists('public/img/user/'.$randomResult->id.'.jpg'))
			<img src ="{{asset('img/user/'.$randomResult->id.'.jpg')}}">
			@else
			<img src ="{{asset('img/user/0.jpg')}}">
			@endif

			<a href="#">{{$randomResult->channel_name}}</a>

		</div>
	</div>
@endforeach

