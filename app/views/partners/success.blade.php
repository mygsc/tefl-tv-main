@extends('layouts.partnership')

@section('title')
	Congratulation you just became a TEFL TV's partner
@stop

@section('content')
<div class="container same-H White h-minH">
	<div class="content-padding">
		<div class="col-md-8 col-md-offset-2 mg-t-20 ">
			<br/><br/><br/><br/><br/><br/>
			<!--for publisher-->
			<div class="good text-center">
				<h3 class="">
					Congratulations you just became a TEFLTV partner.
					<!--{{Session::get('partnership_type')}}-->
					<br/>
					We are excited for you! Go browse, watch, share videos and start earning now!
				</h3>
				<a href="{{route('homes.index')}}">Go to TEFLTV homepage.</a>
			</div>
			<!--for partner
			<div class="text-center good">
				<h3>
					Congratulations you just became a TEFLTV Partner.
					<br/>
					We are excited for you! Go upload, share, embed your vidoes and start earning now!
				</h3>
				<a href="">Go to your TEFLTV channel.</a>
			</div>-->
		</div>
	</div>
</div>

@stop