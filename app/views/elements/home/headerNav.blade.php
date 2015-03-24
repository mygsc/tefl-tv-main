<div class="categoryNav hidden-sm hidden-xs">
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

 <!-- Navigation -->
 <nav class="navbar navbar-inverse visible-sm visible-xs categoryNav" role="navigation">
    <div class="">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="col-sm-2 col-xs-2">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="col-sm-10 col-xs-10">
                {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
                <div class="input-group" style="background:#eee; padding:3px 3px; margin-bottom:5px;margin-top:5px;">
                    {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5')) }}
                    <span class="input-group-addon" style="padding:0!important;">
                        {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info')) }}
                    </span>
                </div><!--/.input group-->
                {{Form::close()}}
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
               @if(Auth::check())
                    <li>{{link_to_route('users.channel', 'My Channel', null, array('class' => ''))}}</li>
                    <li>{{link_to_route('users.notifications', 'Notifications', null, array('class' => ''))}}</li>
                        {{HTML::script('js/user/realtime-notification.js')}}
                    <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => ''))}}</li>
                @else
                    <li>{{ link_to_route('homes.signin', 'Sign-in', null, array('class' => '')) }}</li>
               @endif
                    <li>{{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}</li>
                    <li>{{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}</li>
                    <li>{{ link_to_route('homes.random', 'Random', null, array('class' => '')) }}</li>
                    <li>{{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}</li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
