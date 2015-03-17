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
	<div class="col-md-12">
		<div class="row">
		@if($notifications->isEmpty())
		No notification
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
				{{$notification->created_at}}
				<br>
			@endif
				{{$notification->notification}}
				<br />
			@endforeach
		</div>

		<div class="row">
		{{$notifications->links()}}
		</div>
	</div>
</div>
@stop

@section('script')

@stop