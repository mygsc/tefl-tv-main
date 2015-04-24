<?php
	$month = null;
	$day = null;
	$year = null;
?>

@extends('layouts.default')

@section('title')

@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9 same-H h-minH White">
			<div class="">
			<h3>Notifications</h3>
			@if($notifications->isEmpty())
			<div class="text-center">
				<hr/>
					<p>No notification</p>
				<hr/>

			</div>
			@endif
				@foreach($notifications as $key => $notification)
				
				<!------To Display date-------->
				<?php $r_date = strtotime($notification->created_at); ?>
				@if($month != date('m',$r_date)||$day != date('d',$r_date)||$year != date('Y',$r_date))
					<?php
						$month = date('m',$r_date);
						$day = date('d',$r_date);
						$year = date('Y',$r_date);
					?>
					<hr/>
					<p><b>{{date('F d, Y',strtotime($notification->created_at))}}</b></p>
					<hr/>
				@endif
					<p><img src="{{$notification->profile_picture}}" class="un-img"> &nbsp; {{$notification->notification}}
					&nbsp; - &nbsp;
					{{$notification->time_difference}}
					</p>
				
					
				@endforeach
			</div>

			<div class="row text-center">
			{{$notifications->links()}}
			</div>
		</div>
		<div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
			<div class="same-H grey pad-s-10">
				<div>
					@include('elements/home/carouselAds')
				</div>
				<div class="mg-t-10">
					@include('elements/home/adverstisementSmall')
						
				</div>
			</div>
		</div>

</div>
@stop

@section('script')

@stop