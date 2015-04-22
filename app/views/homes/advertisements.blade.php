@extends('layouts.default')

@section('css')
	{{HTML::style('css/vid.player.css')}}
@stop
@section('content')
<style type="text/css">
	img{
		width: 100%
	}
</style>
<div class="container page">

	<div class="col-md-8 col-md-offset-2">
		<br/><br/><br/><br/><br/><br/>
		<div class="well text-center">
			<h1>Page under construction.</h1>
		</div>
	</div>

	<div class="col-md-4">
		<div class="row">
			<img src="/img/thumbnails/video.png">
		</div>
	</div>
	<div class="col-md-2">
		<div class="row">
			<img src="/img/thumbnails/video.png">
			<img src="/img/thumbnails/video.png">
		</div>
	</div>
	<div class="col-md-2">
		<div class="row">
			<img src="/img/thumbnails/video.png">
			<img src="/img/thumbnails/video.png">
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<img src="/img/thumbnails/video.png">
		</div>
	</div>


</div>


@stop
@section('script')
	{{HTML::script('js/media.player.js')}}
@stop