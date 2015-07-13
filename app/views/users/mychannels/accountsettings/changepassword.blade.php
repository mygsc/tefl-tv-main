
 @extends('layouts.default')

 @section('content')

<div class="row">
    <div class="container pageH">
        <div class="text-center whiteC">
            <ul class="nav nav-tabs hidden-sm hidden-xs White same-H text-center" role="tablist">
                <li role="presentation"> {{link_to_route('users.channel', 'Back to Channel Home')}}</li>
                <li role="presentation" >{{link_to_route('users.edit.channel', 'Update Profile')}}</li>
                <li role="presentation" class="active">{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
                <li role="presentation" >{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
                <li role="presentation">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
                @endif
                <li role="presentation">{{ link_to_route('users.deactivate', 'Deactivate TEFL TV account', null) }}</li>
            </ul><!--tabNav-->
        </div>
           <div class="mg-t-20 same-H">
                <div class="White div-change">
                    <div class="row mg-t-20">
                        <div class="col-md-12">
                            <div class="">
                                <br/><br/>
                                <h3 class="orangeC text-center">-For a stronger password mix characters and numbers-</h3>
                               
                                <div class="col-md-8 col-md-offset-2">
                                     <hr/>
                                    {{Form::open(array('route' => 'users.post.change-password'))}}
                                    
                                    {{Form::label('currentPassword', ' Current Password: ')}}
                                    {{Form::password('currentPassword', null, array('required' => true))}}
                                    <span class="inputError">
                                        @if(isset($PassNotEqual))
                                            <span class="inputError">
                                                {{$PassNotEqual}}
                                            </span>
                                        @endif
                                    </span>
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