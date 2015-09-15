@extends('layouts.default')

@section('title')
    Edit Channels - {{Auth::User()->channel_name}} | TEFL Tv
@stop

@section('content')

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div class="row">
    <div class="container">
    	<br/>
        <ul class="nav nav-tabs hidden-sm hidden-xs White same-H text-center" role="tablist">
            <li role="presentation"> {{link_to_route('users.channel', 'Back to Channel Home')}}</li>
            <li role="presentation">{{link_to_route('users.edit.channel', 'Update Profile')}}</li>
            <li role="presentation" >{{ link_to_route('users.change-password', 'Change Password', null) }}</li>
            <li role="presentation" >{{ link_to_route('users.change-email', 'Change Email', null) }}</li>
            @if(Auth::User()->role == '3' || Auth::User()->role == '4' || Auth::User()->role == '5')
            <li role="presentation">{{ link_to_route('users.earnings.settings', 'Earnings Settings', null) }}</li>
            @endif
            <li role="presentation" class="active">{{ link_to_route('users.privacy.settings', 'Privacy Settings', null) }}</li>
            <li role="presentation">{{ link_to_route('users.deactivate', 'Deactivate TEFL TV account', null) }}</li>
        </ul><!--tabNav-->
        {{Form::open(array('route' => ['post.users.privacy.settings', Auth::User()->channel_name]))}}

            <div class="col-md-12 top-div_t mg-t-20">
                <h3 class="whiteC text-center">-Privacy-</h3>
            </div>
            <div class="col-md-12 White same-H">
                <div class="pad-10 textbox-layout">
                    <i>Show your information to other users:</i>
                    <br/><br/>

                    {{Form::label('Email address: ')}}
                    <span class="v-category">
                        {{Form::checkbox('email', ($privacySettings->email ? 'Yes' : 'No'), $privacySettings->email,['id'=>'email'])}}
                    </span>
                    <br />

                    {{Form::label('Name: ')}}
                    <span class="v-category">
                        {{Form::checkbox('name', ($privacySettings->name ? 'Yes' : 'No'), $privacySettings->name,['id'=>'name'])}}
                    </span>
                    <br />

                    {{Form::label('Address: ')}}
                    <span class="v-category">
                        {{Form::checkbox('address', ($privacySettings->address ? 'Yes' : 'No'), $privacySettings->address,['id'=>'address'])}}
                    </span>
                    <br />

                    {{Form::label('Subscriber count: ')}}
                    <span class="v-category">
                        {{Form::checkbox('name', ($privacySettings->subscriber_count ? 'Yes' : 'No'), $privacySettings->subscriber_count,['id'=>'subscriber_count'])}}
                    </span>
                    <br />

                    {{Form::label('Birthday: ')}}
                    <span class="v-category">
                        {{Form::checkbox('birthday', ($privacySettings->birthday ? 'Yes' : 'No'), $privacySettings->birthday,['id'=>'email'])}}
                    </span>
                    <br />

                    {{Form::label('Country: ')}}
                    <span class="v-category">
                        {{Form::checkbox('country', ($privacySettings->country ? 'Yes' : 'No'), $privacySettings->country,['id'=>'email'])}}
                    </span>
                    <br />
                </div>
            </div>
    
            <div class="col-md-12 White same-H mg-t-20">
                <div class="pad-10 textbox-layout">
                    <div class="text-center col-md-12">
                        <br/><br/>
                        {{Form::submit('Save Changes', array('class' => 'btn btn-info mg-b-20'))}}
                    </div>
                </div>
            </div>
        {{ Form::close()}}

    </div><!--/.container row-->
</div>
@stop