@extends('layouts.partnership')

@section('title')
	TEFLTV Programs
@stop

@section('content')
<img src="/img/partnerships.png">
<div class="row  White">
<div class="container ">
	<div class="row ">
		<h1 class="text-center">Welcome to TEFLTV Programs	<br/>
			<small>Thank you for your interest to participate in our programs. Please read the following information, it will surely give you the idea what are TEFLTV Programs.</small>
		</h1>
		
		<div class="content-padding">
		
		<div class="row">
			<div class="row-same-height">
				<div class="col-sm-6 col-sm-height text-center">
					<h1 class="tBlue">PARTNER</h1>
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<div class="row">
						<img src="/img/icons/par-upload.png" class="part-ico">
						<i class="fa fa-arrow-right fs-24"></i>
						<img src="/img/icons/par-earn.png" class="part-ico">
						<i class="fa fa-arrow-left fs-24"></i>
						<img src="/img/icons/par-share.png" class="part-ico">
						<br/><br/><br/>
						<a href="{{route('partners.learnmore')}}">{{Form::button('Learn more', array('class' => 'btn btn-primary'))}}</a>
						<br/><br/><br/>
					</div>
				</div>
				<div class="col-sm-6 col-sm-height text-center">
					<h1 class="orangeC">PUBLISHER</h1>
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					<div class="row">
						<img src="/img/icons/select-ico.png" class="part-ico ">
						<i class="fa fa-arrow-right fs-24"></i>
						<img src="/img/icons/share-ico.png" class="part-ico">
						<i class="fa fa-arrow-right fs-24"></i>
						<img src="/img/icons/earn-ico.png" class="part-ico">
						<br/><br/><br/>
						<a href="{{route('publishers.learnmore')}}">{{Form::button('Learn more', array('class' => 'btn btn-warning'))}}</a>
						<br/><br/><br/>
					</div>					
				</div>
			</div>
		</div>

		<div class="col-md-6"></div>



	</div>
	</div>
</div>

@stop
