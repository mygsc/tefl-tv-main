@extends('layouts.admin')

@section('title')
Latest Videos
@stop

@section('content')
<div class="container">
@foreach($latest_videos as $video)
<div class="row">
title: <a href="{{route('homes.watch-video', 'v='.$video->file_name)}}">{{$video->title}}</a> <br/>
description: ..... <br/>
views: {{$video->views	}} <br/>
date: {{$video->created_at}}
</div>
@endforeach
</div>
@stop