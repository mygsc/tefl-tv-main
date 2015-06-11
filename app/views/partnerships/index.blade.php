@extends('layouts.default')

@section('title')
	Welcome to TEFL TV's partnership programs
@stop

@section('content')

<h1>Welcome to TEFL TV's partnership programs</h1>

<a href="{{route('partners.learnmore')}}">{{Form::button('Partners Program', array('class' => 'btn btn-primary'))}}</a>
<a href="{{route('publishers.learnmore')}}">{{Form::button('Publishers Program', array('class' => 'btn btn-primary'))}}</a>
@stop
