    <div class="categoryNav">

        <div class="container">

        <div class="row">
            <div class="col-md-8 text-left"> 
                <div class="row">
                    <ul class="ctgryNav" style="margin-left:-40px;">
                        <li>
                            {{ link_to_route('homes.popular', 'Popular', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.latest', 'Latest', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.random', 'Random', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.channel', 'Channels', null) }}
                        </li>

                        
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row text-right">
                    <ul class="ctgryNav" >
                        
                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-info whiteC accntbtn" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Account   <span class="caret"></span>
                                </a>
                              <ul class="dropdown-menu" role="menu">
                                <li>{{ link_to_route('users.index', 'View Profile', array('id' => 'menu')) }}</li>
                                <li>{{ link_to_route('user.myVideos', 'My Videos', null, array('id' => 'menu')) }}</li>
                                <li>{{ link_to_route('users.subscription', 'Subscription', null, array('id' => 'menu')) }}</li>
                                <li>{{ link_to_route('user.logout', 'Logout', null, array('id' => 'menu')) }}</li>
                              </ul>
                            </li>
                        <li class="">
                           {{ link_to_route('user.upload', 'Upload', null, array('class' => 'btn btn-primary orangeC')) }}
                        </li>
                      
                    </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

