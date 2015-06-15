@extends('layouts.default')

@section('title')
	Learn more about TEFL TV Partners Program
@stop

@section('content')
	<h1>Learn more about partners</h1>

	<a href="{{route('partners.adsense')}}">{{Form::button('Apply now')}}</a>
@stop


