
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
                    <div class="col-md-12">
                        <h1 class="text-center">Please choose what you want to update</h1>
                        <div class="col-md-6 white">
                            <div class="row">
                            <a href="#" id="choose-partner"><h1 class="text-center">Partner Settings</h1></a>
                            </div>
                            <div class ="row" style="display:none">
                            a
                            </div>
                        </div><!--/.tabContent-->

                        <div class="col-md-6 white">
                            <div class="row">
                             <a href="#" id="choose-publisher"><h1 class="text-center">Publisher Settings</h1></a>
                             </div>
                             <div class ="row" style="display:none">
                            a
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
