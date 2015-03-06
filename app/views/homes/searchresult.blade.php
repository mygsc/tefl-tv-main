@extends('layouts.default')

@section('title')
	Search Result
@stop

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				@foreach($videoResults as $video)
					<div class="col-md-12">
						Title: <a href="#">{{$video->title}}</a><br />
						Description: {{$video->description}}<br />
						Author: <a href="#">{{$video->channel_name}}</a><br />
						<br /><br />
					</div>
				@endforeach
			</div>
		</div>
	</div>
@stop