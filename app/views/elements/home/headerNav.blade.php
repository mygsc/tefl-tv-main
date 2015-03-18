<div class="categoryNav">
    <div class="row">
        <div class="container">
            <div class="col-md-6 text-left col-sm-6"> 
                <div class="row">
                    <ul class="ctgryNav" style="margin-left:-40px;">
                        <li>
                            {{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.random', 'Random', null, array('class' => '')) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}
                        </li>
                    </ul>

                </div>
            </div><!--/.col-md-8-->
            <div class="col-md-6 col-sm-6">
                <ul class="ctgryNav pull-right">
                    @if(Auth::check())
                    <li><b>{{link_to_route('users.channel', 'My Channel', null, array('class' => ''))}}</b></li>
                    <li>
                        <div class="btn-group hand" id="notification">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                Notifications<span class="badge btn-danger " id="notification-counter"></span>
                            </a>
                            <ul class="dropdown-menu scrollable-menu bullet" role="menu" id="notifcation-area">
                                <div id="loading-notification">
                                    {{ Form::hidden('notif_u_token', Crypt::encrypt(Auth::User()->id), array('id' => 'notif_u_token'))}}
                                    {{ HTML::image('img/icons/uploading.gif',null,  array('height'=>'25px','width' => '25px')) }}
                                </div>
                                <small id="looking-notification">Looking for new Notification</small>
                                <li><a href="{{route('users.notifications')}}"><small>see all</small></a></li>
                            </ul>
                        </div>
                    </li>
                    {{HTML::script('js/user/realtime-notification.js')}}


                    <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => ''))}}</li>
                    @else
                    <li>{{ link_to_route('homes.signin', 'Sign-in', null, array('class' => '')) }}</li>
                    @endif
                </ul>
            </div><!--col-md-6 col-sm-6-->
        </div><!--/.row-->
    </div><!--/.container-->
</div><!--/.categoryNav-->
<!------Realtime notification script------------>

