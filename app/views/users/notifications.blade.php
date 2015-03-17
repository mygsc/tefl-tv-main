<?php
	$month = null;
	$day = null;
	$year = null;
?>

@extends('layouts.default')

@section('title')

@stop

@section('content')
<div class="container page">
	<div class="col-md-8">
		<div class="row">
			<h3>Notifications</h3>
			@foreach($notifications as $key => $notification)
			<hr/>
			<!------To Display date-------->
			<?php $r_date = strtotime($notification->created_at); ?>
			@if($month != date('m',$r_date)||$day != date('d',$r_date)||$year != date('Y',$r_date))
				<?php
					$month = date('m',$r_date);
					$day = date('d',$r_date);
					$year = date('Y',$r_date);
				?>
				{{$notification->created_at}}
				<br>
			@endif
				{{$notification->notification}}
			@endforeach
		</div>

		<div class="row text-center">
		{{$notifications->links()}}
		</div>
	</div>
	<div class="col-md-4">
		<div class="sideLinksDiv2">
			@include('elements/home/adverstisementSmall')
			@include('elements/home/carouselAds')	
			@include('elements/home/recommendedChannelList')
		</div>
	</div>

</div>
@stop

@section('script')

@stop