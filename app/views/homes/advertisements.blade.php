@extends('layouts.default')

@section('css')
	{{HTML::style('css/vid.player.css')}}
@stop
@section('content')

<div class="container White h-minH">

	<div class="col-md-8 col-md-offset-2">
		<br/><br/><br/><br/><br/><br/>
		<div class="well text-center">
			<h1>Page under construction.</h1>
			<div class="spinner2" id='spinner'>
		<div class="spinner2-containerb containerb1">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
		<div class="spinner2-containerb containerb2">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
		<div class="spinner2-containerb containerb3">
			<div class="circle1"></div>
			<div class="circle2"></div>
			<div class="circle3"></div>
			<div class="circle4"></div>
		</div>
	</div>
		</div>
	</div>


</div>


@stop
@section('script')
	{{HTML::script('js/media.player.js')}}
@stop