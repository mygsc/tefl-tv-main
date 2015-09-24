<div class="categoryNav hidden-sm hidden-xs">
    <div class="row">
        <div class="container">
            <div class="">
                <div class="col-md-6 col-sm-6"> 
                    <ul class="ctgryNav">
                        <li>
                            {{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}
                        </li>
                        <!--<li>
                            {--{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}--}
                        </li>-->
                        <li>
                            {{ link_to_route('homes.playlist', 'Playlists', null, array('class' => '')) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}
                        </li>
                    </ul> 
                </div><!--/.col-md-8-->
                <div class="col-md-6 col-sm-6">
                    <div class="row text-right">
                        <ul class="ctgryNav">
                            

                            @if(Auth::check())
                                <li><a href="{{route('users.channel')}}"><b> {{Auth::User()->channel_name}}</b></a></li>
                                <!--@r3mmel-->
                                <?php $watchVideoLink = stripos(Request::path(), 'watch'); ?>
                                <?php $notifLink = stripos(Request::path(),'upload'); ?>
                                <?php $viewUser = stripos(Request::path(),'channels/'); ?>
                                @if(($watchVideoLink !== false) OR ($notifLink !== false) OR ($viewUser !== false))
                                    
                                    <li>
                                    <div class="btn-group hand" id="notification">
                                        <a class="dropdown-toggle nl" data-toggle="dropdown">
                                            <span class="badge btn-danger " id="notification-counter"></span> &nbsp; Notifications
                                        </a>
                                        <span class="dropdown-menu scrollable-menu bullet noti" role="menu">
                                            <div id="loading-notification">
                                                {{ HTML::image('img/icons/uploading.gif',null,  array('height'=>'25px','width' => '25px')) }}
                                                <small>Looking for new Notification</small>
                                            </div>
                                            
                                            <div class="text-center"><a href="{{route('users.notifications')}}" class="inline tBlue"><small>see all</small></a></div>
                                        </span>
                                    </div>
                                </li>

                                @endif
                                <!--@r3mmel-->

                                <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => ''))}}</li>
                            @else
                                <li>{{ link_to_route('homes.signin', 'Sign-in / Sign-up', null, array('class' => '')) }}</li>
                 
                            @endif
                        </ul>
                    </div>
                </div><!--col-md-6 col-sm-6-->
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</div><!--/.categoryNav-->
<!------Realtime notification script--->

