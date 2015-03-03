@extends('layouts.default')


@section('content')

	{{ Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}
		{{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture'))}}
		<br>
		{{Form::label('website', 'website: ')}} {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}
		<br>
		{{Form::label('organization', 'Organization: ')}} {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'website'))}}
		{{$errors->first('organization')}}
		<br>
		{{Form::label('interests', 'Interests: ')}}	{{Form::textarea('interests',$user_channel->interests, array('placeholder' => 'Interests'))}}
		<br>
		{{Form::label('first_name', 'Firstname: ')}} {{ Form::text('first_name',$user_channel->first_name, array('placeholder' => 'Firstname'))}}
		{{$errors->first('first_name')}}
		<br>
		{{Form::label('last_name', 'Lastname: ')}} {{ Form::text('last_name', $user_channel->last_name, array('placeholder' => 'Lastname'))}}
		{{$errors->first('last_name')}}
		<br>
		{{ Form::label('contact_number', 'Contact Number: ')}} {{ Form::text('contact_number', $user_channel->contact_number, array('placeholder' => 'Contact Number'))}}
		{{$errors->first('contact_number')}}
		<br>
		{{ Form::label('address', 'Address: ')}} {{ Form::text('address', $user_channel->address, array('placeholder' => 'address'))}}
		{{$errors->first('address')}}
		<br>
		{{Form::label('work', 'Work: ')}} {{Form::text('work', $user_channel->work, array('placeholder' => 'Work'))}}
		<br>
		{{Form::label('birthdate', 'Birthdate: ')}} {{Form::text('birthdate', $user_channel->birthdate, array('placeholder' => 'Birthdate'))}}
		{{$errors->first('birthdate')}}
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
     				<div class="uploaded_img">
        			{{HTML::image('img/user/' . Auth::User()->id . '.jpg', 'Nothing to display.', array('id' => 'preview'))}}
        		</div>

        {{Form::open(array('route' => ['users.upload.image', Auth::User()->id], 'files' => 'true'))}}
        	{{ Form::file('image', array('id' => 'uploaded_img'))}}
        	{{Form::submit("Change profile's picture")}}
        {{Form::close()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@section('script')
{{HTML::script('js/user/upload_image.js')}}
{{HTML::script('js/user/modalclearing.js')}}
@stop