 @extends('layouts.default')

 @section('content')

 {{Form::open(array('route' => 'users.post.change-password'))}}
        {{Form::label('currentPassword', ' Current Password: ')}}
        {{Form::password('currentPassword', null, array('class' => 'form-control'))}}
        {{$errors->first('currentPassword')}}
        <br>
        {{Form::label('newPassword', 'New Password: ')}}
        {{Form::password('newPassword', null, array('class' => 'form-control'))}}
        {{$errors->first('newPassword')}}
        <br>
        {{Form::label('confirmPassword', 'Confirm New Password: ')}}
        {{Form::password('confirmPassword', null, array('class' => 'form-control'))}}
        {{$errors->first('confirmPassword')}}
        <br>
        {{Form::submit('Save Changes')}}
{{Form::close()}}

@stop