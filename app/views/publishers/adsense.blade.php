@extends('layouts.default')

@section('title')
	Apply as publisher of TEFL TV
@stop

@section('content')
<h1>Publishers</h1>
<span>Please enter your adsense account</span>
{{Form::text('adsense')}}
<span> Don't know how to retrieve your adsense ID? <a href="#">click here</a></span>
<br />
<a href="{{route('partnerships.success')}}">{{Form::button('Apply', array('class' => 'btn btn-primary'))}}</a>
@stop