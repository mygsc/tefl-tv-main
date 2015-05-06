
 @extends('layouts.default')

 @section('content')

<div class="row">
    <div class="container pageH">
        <br/>
        <div class="same-H">
           <div class="Div-channel-border">
                <div class="well White div-change">
                    <div class="row">
                        <br/>
                        <div class="text-center">
                            <span class=""><i class="fa fa-arrow-left blueC"></i> {{link_to_route('users.channel', 'Channel Home')}}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class="active">{{link_to_route('users.edit.channel', 'Update Profile', Auth::User()->channel_name)}}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span><b>{{ link_to_route('users.change-password', 'Change Password', null) }}</b></span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</span>
                        </div>
                        <br/>
                        <div class="col-md-12">
                            <div class=""> 
                                <h3 class="orangeC text-center">-For a stronger password mix characters and numbers-</h3>
                                <div class="well2">
                                    {{Form::open(array('route' => 'users.post.change-password'))}}
                                    
                                    {{Form::label('currentPassword', ' Current Password: ')}}
                                    {{Form::password('currentPassword', null, array('required' => true))}}
                                    <span class="inputError">
                                        {{$errors->first('currentPassword')}}
                                    </span>
                                    <br/><br/>
                                    {{Form::label('newPassword', 'New Password: ')}}
                                    {{Form::password('newPassword', null, array('required' => true))}}
                                    <span class="inputError">
                                        {{$errors->first('newPassword')}}
                                    </span>
                                    <br/><br/>
                                   
                                    {{Form::label('confirmPassword', 'Confirm New Password: ')}}
               
                                    {{Form::password('confirmPassword', null, array('required' => true))}}
                                    <span class="inputError">
                                        {{$errors->first('confirmPassword')}}
                                    </span>
                                    <br/> <br/>
                                    <div class="text-right">
                                        {{Form::submit('Save Changes' ,array('class' => 'btn btn-info'))}}
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div><!--/.well-->
            </div><!--/.wrapperAccount-->
        </div><!--/.col-md-12-->
        <br/>
    </div><!--/.container row-->
</div>
@stop