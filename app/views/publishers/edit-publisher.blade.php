
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
                        {{Form::open(array())}}
                            {{Form::label('adsense_id', 'Adsense Publisher ID')}}
                            {{Form::text('adsense_id')}}
                             <br/><br/>
                            {{Form::label('ad_slot_id', 'Adsense Publisher ID')}}
                            {{Form::text('ad_slot_id')}}
                             <br/><br/>
                            {{Form::label('password', 'Account Password')}}
                            {{Form::text('password')}}
                             <br/><br/>
                            {{Form::label('re-password', 'Verify Account Password')}}
                            {{Form::text('re-password')}}
                            <div class="text-right mg-t-20"> 
                                {{Form::submit('Save', array('class' => 'btn btn-info'))}}
                            </div>

                        {{Form::close()}}
                    </div>
                </div><!--/.row-->
            </div><!--/.well-->
        </div>
    </div>
    </div>
</div>
<br/>
@stop
