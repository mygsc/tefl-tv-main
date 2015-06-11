@extends('layouts.default')

@section('title')
	Learn more about TEFL TV Partners Program
@stop

@section('content')
	<h1>Learn more about partners</h1>

	<a href="{{route('partnerships.verification')}}">{{Form::button('Apply now')}}</a>
@stop


