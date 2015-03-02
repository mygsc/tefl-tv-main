@extends('layouts.default')


@section('content')

	{{ Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}
		{{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture'))}}
		<br>
		{{Form::label('website', 'website: ')}} {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}
		<br>
		{{Form::label('organization', 'Organization: ')}} {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'website'))}}
		<br>
		{{Form::label('interests', 'Interests: ')}}	{{Form::textarea('interests',$user_channel->interests, array('placeholder' => 'Interests'))}}
		<br>
		{{Form::label('first_name', 'Firstname: ')}} {{ Form::text('first_name',$user_channel->first_name, array('placeholder' => 'Firstname'))}}
		<br>
		{{Form::label('last_name', 'Lastname: ')}} {{ Form::text('last_name', $user_channel->last_name, array('placeholder' => 'Lastname'))}}
		<br>
		{{ Form::label('contact_number', 'Contact Number: ')}} {{ Form::text('contact_number', $user_channel->contact_number, array('placeholder' => 'Contact Number'))}}
		<br>
		{{ Form::label('address', 'Address: ')}} {{ Form::text('address', $user_channel->address, array('placeholder' => 'address'))}}
		<br>
		{{Form::label('work', 'Work: ')}} {{Form::text('work', $user_channel->work, array('placeholder' => 'Work'))}}
		<br>
		{{Form::label('birthdate', 'Birthdate: ')}} {{Form::text('birthdate', $user_channel->birthdate, array('placeholder' => 'Birthdate'))}}
		<br>
		{{Form::label('zip_code', 'Zip Code: ')}} {{Form::text('zip_code', $user_channel->zip_code, array('placeholder' => 'Zip Code'))}}
		<br>
		{{Form::submit('Save Changes')}}
	{{ Form::close()}}

@stop

<!-- Modal -->
<div class="modal fade" id="display_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        {{Form::open(array('route' => ['users.upload.image', Auth::User()->channel_name], 'files' => 'true'))}}
        	{{Form::file('image', array('id' => 'uploaded_image'))}}
        	{{Form::submit("Change profile's picture")}}
        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>