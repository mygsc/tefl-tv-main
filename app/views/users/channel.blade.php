@extends('layouts.default')


@section('content')

	{{ Form::open()}}
		{{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt')}}
		<br>
		{{Form::label('website', 'website: ')}} {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website', 'disabled'))}}
		<br>
		{{Form::label('organization', 'Organization: ')}} {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'website', 'disabled'))}}
		<br>
		{{Form::label('interests', 'Interests: ')}}	{{Form::textarea('interests',$user_channel->interests, array('placeholder' => 'Interests', 'disabled'))}}
		<br>
		{{Form::label('first_name', 'Firstname: ')}} {{ Form::text('first_name',$user_channel->first_name, array('placeholder' => 'Firstname', 'disabled'))}}
		<br>
		{{Form::label('last_name', 'Lastname: ')}} {{ Form::text('last_name', $user_channel->last_name, array('placeholder' => 'Lastname', 'disabled'))}}
		<br>
		{{ Form::label('contact_number', 'Contact Number: ')}} {{ Form::text('contact_number', $user_channel->contact_number, array('placeholder' => 'Contact Number', 'disabled'))}}
		<br>
		{{ Form::label('address', 'Address: ')}} {{ Form::text('address', $user_channel->address, array('placeholder' => 'address', 'disabled'))}}
		<br>
		{{Form::label('work', 'Work: ')}} {{Form::text('work', $user_channel->work, array('placeholder' => 'Work', 'disabled'))}}
		<br>
		{{Form::label('birthdate', 'Birthdate: ')}} {{Form::text('birthdate', $user_channel->birthdate, array('placeholder' => 'Birthdate', 'disabled'))}}
		<br>
		{{Form::label('zip_code', 'Zip Code: ')}} {{Form::text('zip_code', $user_channel->zip_code, array('placeholder' => 'Zip Code', 'disabled'))}}
		<br>
	{{ Form::close()}}

@stop
