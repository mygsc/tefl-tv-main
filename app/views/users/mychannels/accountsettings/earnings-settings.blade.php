
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
                <li role="presentation">{{ link_to_route('users.deactivate', 'Deactivate TEFL TV account', null) }}</li>
            </ul><!--tabNav-->
        </div>

        <div class="mg-t-20 same-H">
            <div class="White div-change">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row text-center mg-t-20">
                        <br/><br/><br/>
                        <h3 class="text-center ">Select which account you want to update credentials.</h3>
                            <br/>
                             @if(Auth::User()->role !='3' && Auth::User()->role != '5')
                            <a href="{{route('partners.index')}}">{{Form::button('Click here to become a partners', array('class' => 'btn btn-partner'))}}</a>
                            @else
                            <a href="{{route('edit.partners')}}">{{Form::button('Partners', array('class' => 'btn btn-partner mg-r-20'))}}</a>
                            @endif
                            @if(Auth::User()->role != '5' && Auth::User()->role !='4')
                            <a href="{{route('publishers.index')}}">{{Form::button('Click here to become a publisher', array('class' => 'btn btn-publisher'))}}</a>
                            @else
                            <a href="{{route('edit.publishers')}}">{{Form::button('Publishers', array('class' => 'btn btn-publisher'))}}</a>
                            @endif
                    </div>
                </div>
            </div><!--/.row-->
        </div><!--/.well-->
    </div>
</div>
</div>
<br/>
@stop
