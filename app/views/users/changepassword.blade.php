
 @extends('layouts.default')

 @section('content')

<div class="row White">
    <div class="container page">
        <br/> <br/>
        <div class="">
           <div class="Div-channel-border">
              <div class="well White " style="margin-bottom:0;min-height:350px;">
                    <div class="row">
                        <br/>
                        <div class="text-center">
                            <span class="active">{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span><b>{{ link_to_route('users.change-password', 'Change Password', null) }}</b></span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</span>
                        </div>
                        <br/>
                        <div class="col-md-12 LighterBlue">
                            <div class="textbox-layout "> 
                                <h3 class="tBlue text-center">-For a stronger password mix characters and numbers-</h3>
                                <div class="well2">
                                    {{Form::open(array('route' => 'users.post.change-password'))}}
                                    {{Form::label('currentPassword', ' Current Password: ')}}
                                    {{Form::password('currentPassword', null)}}
                                    {{$errors->first('currentPassword')}}
                                    <br/>
                                    {{Form::label('newPassword', 'New Password: ')}}
                                    {{Form::password('newPassword', null)}}
                                    {{$errors->first('newPassword')}}
                                    <br/>
                                    {{Form::label('confirmPassword', 'Confirm New Password: ')}}
                                    {{Form::password('confirmPassword', null)}}
                                    {{$errors->first('confirmPassword')}}
                                    <br/>
                                    <div class="text-right">
                                        {{Form::submit('Save Changes' ,array('class' => 'btn btn-info'))}}
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>

                                </div>
                            </div><!--/.tabContent-->
                        </div><!--/.tabbable tabs-left-->
                    </div><!--/.row-->
                </div><!--/.well-->
            </div><!--/.wrapperAccount-->
            <br/>
        </div><!--/.col-md-12-->
    </div><!--/.container row-->
</div>
@stop