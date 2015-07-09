
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
                <li role="presentation" >{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
                @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
                <li role="presentation" class="active">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
                @endif
            </ul><!--tabNav-->
        </div>

        <div class="mg-t-20 same-H">
            <div class="White div-change">
                <div class="row">
                    <h1 class="text-center">Please select an option</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Please select this option to update your adsense credentials</h2>
                        <a href="{{route('edit.partners')}}">{{Form::button('Partners', array('class' => 'btn btn-primary'))}}</a>
                    </div>
                    <div class="col-md-6">
                        <h2>Please select this option to update your adsense credentials</h2>
                        <a href="{{route('edit.publishers')}}">{{Form::button('Publishers', array('class' => 'btn btn-primary'))}}</a>
                    </div>
                </div>
            </div><!--/.row-->
        </div><!--/.well-->
    </div>
</div>
</div>
<br/>
@stop
