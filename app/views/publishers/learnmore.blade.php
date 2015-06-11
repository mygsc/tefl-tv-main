@extends('layouts.default')

@section('title')
	Learn more about TEFL TV Publishers Program
@stop

@section('content')
	<h1>Learn more about publishers</h1>

	<a href="{{route('partnerships.verification')}}">{{Form::button('Apply now')}}</a>
@stop


