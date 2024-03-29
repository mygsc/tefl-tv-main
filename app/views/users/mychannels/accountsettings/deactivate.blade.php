
@extends('layouts.default')

@section('content')
<br/>
<div class="row">
    <div class="container pageH">
        <div class="text-center whiteC">
            <ul class="nav nav-tabs hidden-sm hidden-xs White same-H text-center" role="tablist">
                <li role="presentation"> {{link_to_route('users.channel', 'Back to Channel Home')}}</li>
                <li role="presentation" >{{link_to_route('users.edit.channel', 'Update Profile')}}</li>
                <li role="presentation" >{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
                <li role="presentation">{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
                <li role="presentation">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
                @endif
                <li role="presentation">{{ link_to_route('users.privacy.settings', 'Privacy Settings', null) }}</li>
                <li role="presentation" class="active">{{ link_to_route('users.deactivate', 'Activate/Deactivate account', null) }}</li>
            </ul><!--tabNav-->
        </div>

        <div class="mg-t-20 same-H">
            <div class="White div-change">
                <div class="row mg-t-20">
                    <div class="col-md-12">
                        <div class="col-md-12 white">
                             <div class="col-md-8 col-md-offset-2">
                                <br/><br/>
                                @if(Auth::User()->status == '0')
                                    <h2 class="text-center">Your account is <span class="orangeC">inactive</span></h2>
                                @else
                                    <h2 class="text-center">Your account is <span class="orangeC">active</span></h2>
                                @endif
                                <p>Please take note that deactivating will not result in deletion of your account. However, it will disable you from using TEFLtv's features, such as:</p>
                                <ul class="mg-l--20">
                                    <li>Uploading videos</li>
                                    <li>Leaving comments/feedback to videos and users</li>
                                    <li>Liking other users/channel comments and videos</li>
                                    <li>Your activites will be hidden from the public</li>
                                    <li>Your videos and channel will not be available for public view</li>
                                    <li>If you are a partner/publisher of TEFLtv, then your account will also be disabled</li>                              
                                </ul>
                                <br/>
                                <p>Once your account is deactivated, you will be given an option to activate it again. Just come back to this page and you will be given an option to reactivate.</p>

                                <h3 class="orangeC text-center">To {{$keyword}} your acccount we must verify that you are the account owner</h3>

                               
                                    <hr/>
                                   {{Form::open(array('route' => 'post.users.deactivate'))}}
                                        {{Form::hidden('key', Crypt::encrypt($set_status))}}
                                        {{Form::hidden('keyword', $keyword)}}
                                        {{Form::label('password', '*Password: ')}}
                                        {{Form::password('password', null, array('placeholder' => 'Password'))}}
                                        <span class="inputError">
                                            {{$errors->first('password')}}
                                        </span>
                                        <br/><br/>
                                        {{Form::label('password_confirmation', '*Confirm Password: ')}}
                                        {{Form::password('password_confirmation', null, array('placeholder' => 'Confirm Password'))}}
                                        <span class="inputError">
                                            {{$errors->first('confirmPassword')}}
                                        </span>
                                        <br/><br/>
                                        <div class="text-right">
                                            {{Form::submit($submit_text,array('class' => 'btn btn-primary'))}}
                                        </div>
                                    {{Form::close()}}
                                    <br/>
                                </div>
                            </div>
                        </div><!--/.tabContent-->
                    </div><!--/.tabbable tabs-left-->
                </div><!--/.row-->
            </div><!--/.well-->
        </div>
    </div>
</div>
<br/>


@stop
