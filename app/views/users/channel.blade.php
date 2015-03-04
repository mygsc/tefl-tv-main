@extends('layouts.default')


@section('content')
	<div class="container page">
	<br/>
	<div class="row">
		<div style="border:5px solid #8b9dc1;" class="shadow">
			<div class="col-md-2 hidden-xs">
				<div class="row">
					<img src="/img/user/u4.png" class="pic-Dp">
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">


	{{ Form::open()}}
		{{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt')}}
		<br>
		{{Form::label('website', 'website: ')}} {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website', 'disabled'))}}
		<br>
		{{Form::label('organization', 'Organization: ')}} {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'website', 'disabled'))}}
		<br>
		{{Form::label('interests', 'Interests: ')}}	{{Form::textarea('interests',$usersChannel->interests, array('placeholder' => 'Interests', 'disabled'))}}
		<br>
		{{Form::label('first_name', 'Firstname: ')}} {{ Form::text('first_name',$usersChannel->first_name, array('placeholder' => 'Firstname', 'disabled'))}}
		<br>
		{{Form::label('last_name', 'Lastname: ')}} {{ Form::text('last_name', $usersChannel->last_name, array('placeholder' => 'Lastname', 'disabled'))}}
		<br>
		{{ Form::label('contact_number', 'Contact Number: ')}} {{ Form::text('contact_number', $usersChannel->contact_number, array('placeholder' => 'Contact Number', 'disabled'))}}
		<br>
		{{ Form::label('address', 'Address: ')}} {{ Form::text('address', $usersChannel->address, array('placeholder' => 'address', 'disabled'))}}
		<br>
		{{Form::label('work', 'Work: ')}} {{Form::text('work', $usersChannel->work, array('placeholder' => 'Work', 'disabled'))}}
		<br>
		{{Form::label('birthdate', 'Birthdate: ')}} {{Form::text('birthdate', $usersChannel->birthdate, array('placeholder' => 'Birthdate', 'disabled'))}}
		<br>
		{{Form::label('zip_code', 'Zip Code: ')}} {{Form::text('zip_code', $usersChannel->zip_code, array('placeholder' => 'Zip Code', 'disabled'))}}
		<br>
	{{ Form::close()}}

	<div id="videos">
		<h1>Videos</h1>
		@foreach($usersVideos as $userVideo)
			<video controls src="/videos/{{$userVideo->file_name}}.{{$userVideo->extension}}" type="video/mp4">Video</video>
		@endforeach
	</div>

	<div id="subscriber">
		<h3>Subscriber</h3>
		@foreach($subscriberLists as $subscriberList )
			{{$subscriberList->first_name . ' ' . $subscriberList->last_name}}<br>
		@endforeach
	</div>

	<div id="subscription">
		<h3>Subscription</h3>
		@foreach($subscriptionLists as $subscriptionList)
			{{$subscriptionList[0]['first_name'] .' '. $subscriptionList[0]['last_name']}}<br>
		@endforeach
	</div>

@stop
