@extends('layouts.default')

@section('title')
	TOP 50 Channels
@stop

@section('content')
<div class="container White h-minH same-H">
	<h1> TOP 50 Channels</h1>
	@include('elements.home.randoms.channel')
	<br>
	<br>
</div>
@stop