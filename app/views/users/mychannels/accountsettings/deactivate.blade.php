
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
                <li role="presentation" class="active">{{ link_to_route('users.deactivate', 'Activate/Deactivate account', null) }}</li>
            </ul><!--tabNav-->
        </div>

        <div class="mg-t-20 same-H">
            <div class="White div-change">
                <div class="row mg-t-20">
                    <div class="col-md-12">
                        <div class="col-md-12 white">
                            <div class=""> 
                                <br/><br/>
                                <h3 class="orangeC text-center">To {{$keyword}} your acccount we must verify that you are the account owner</h3>
                                
                                <div class="col-md-8 col-md-offset-2">
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
