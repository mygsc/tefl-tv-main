@extends('layouts.default')

@section('title')
    Cancel Publisher | TEFLTV Publisher
@stop

@section('content')
<br/>
<div class="row">
    <div class="container pageH">
        <div class="text-center whiteC">
            <ul class="nav nav-tabs hidden-sm hidden-xs White same-H text-center" role="tablist">
                <li role="presentation"> {{link_to_route('users.channel', 'Back to Channel Home')}}</li>
                <li role="presentation" >{{link_to_route('users.edit.channel', 'Update Profile')}}</li>
                <li role="presentation" >{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
                <li role="presentation" >{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
                <li role="presentation" class="active">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
                @endif
                <li role="presentation">{{ link_to_route('users.deactivate', 'Activate/Deactivate account', null) }}</li>
            </ul><!--tabNav-->
        </div>
        <div class="mg-t-20 same-H">
            <div class="White div-change">
                <div class="row mg-t-20">
                    <br/><br/>
                    <div class="col-md-8 col-md-offset-2">
                        @if(Auth::User()->role == '5' || Auth::User()->role == '5')
                        <h2 class="orangeC inline">Publishers Settings</h2>
                        @endif
                        @if(Auth::User()->role == '3' || Auth::User()->role == '5')
                        <a href="{{route('edit.partners')}}"> &nbsp; | &nbsp; Partners Settings</a>
                        @endif
                        <hr/>
                        <div class="mg-t-20">
                         <div class="mg-t-20">
                            <div class="col-md-3">
                                <div class="list-group">
                                    <a href="{{route('edit.partners')}}" class="list-group-item" >
                                        Edit Adsense Credentials
                                    </a>
                                    <a href="{{route('cancel.partners')}}" class="list-group-item active">Cancel Publisher Account</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <p>*Please take note that canceling your publisher account will remove the following features from your account:</p>
                                    <ul>
                                        <li>Publishing any video with your ads on it</li>
                                        <li>Ability to earn revenue</li>
                                        <li>Publisher status on TEFLtv</li>
                                    </ul>
                                    <p>If you would like to proceed please fill the following fields to confirm your account ownership or <a href="{{route('homes.index')}}">click here</a> to return home.</p>
                                </div>
                                <div class="row">
                                    {{Form::open(array('route' => 'post.cancel.publishers'))}}
                                    {{Form::label('password', 'Account Password')}}
                                    {{Form::password('password')}}
                                    <span class="inputError">
                                        {{$errors->first('password')}}
                                    </span>
                                    <br/><br/>
                                    {{Form::label('password_confirmation', 'Confirm Account Password')}}
                                    {{Form::password('password_confirmation')}}
                                    <span class="inputError">
                                        {{$errors->first('confirm_password')}}
                                    </span>
                                    <div class="text-right mg-t-20"> 
                                        {{Form::submit('Cancel Publisher Account', array('class' => 'btn btn-info'))}}
                                    </div>
                                </div>

                                {{Form::close()}}
                            </div>
                        </div>
                    </div><!--/.row-->
                </div><!--/.well-->
            </div>
        </div>
    </div>
</div>
<br/>
@stop
