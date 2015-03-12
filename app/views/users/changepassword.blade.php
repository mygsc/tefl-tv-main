 @extends('layouts.default')

 @section('content')


<div class="container page">
    <br/> <br/>

    <div class="col-md-row">
       <div class="wrapper-account">
            <div class="well White " style="margin-bottom:0;min-height:350px;">
               <div class="row">

                    <!-- tabs left -->
                    <div class="tabbable tabs-left">
                        <br/><br/>
                        <ul class="nav nav-tabs" style="margin-left:-20px">
                          <li >{{link_to_route('users.edit.channel', 'Account Setting', Auth::User()->channel_name)}}</li>
                          <li class="active">{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
                          <li class="">{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                        </ul>


                        <div class="tab-content">
                            <div class="tab-pane active" id="changePassword">
                                <div class="col-md-6 col-md-offset-2 textbox-layout"> 
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
                                {{Form::close()}}
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

@stop