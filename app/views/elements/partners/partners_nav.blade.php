<div class="categoryNav hidden-sm hidden-xs">
    <div class="row">
        <div class="container">
            <div class="">
                <div class="col-md-6 col-sm-6"> 
                    <ul class="ctgryNav">
                        <li>
                            {{ link_to_route('partners.index', 'Home', null, array('class' => '')) }}
                        </li>
                        <!--<li>
                            {{ link_to_route('partners.faqs', 'FAQs', null, array('class' => '')) }}
                        </li>
                        <li>
                            {{ link_to_route('partners.privacy', 'Privacy', null, array('class' => '')) }}
                        </li>-->
                    </ul> 
                </div><!--/.col-md-8-->
                <div class="col-md-6 col-sm-6">
                    <div class="row text-right">
                       
                    </div>
                </div><!--col-md-6 col-sm-6-->
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</div><!--/.categoryNav-->
<!------Realtime notification script--->

<!-- Navigation -->
<nav class="navbar navbar-inverse visible-sm visible-xs categoryNav" role="navigation" style="z-index:99999">
    <div class="LightestBlue">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
           
            <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
                    <div class="input-group div-search">
                        
                        {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5')) }}
                        <span class="input-group-addon pad-0">
                            {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info')) }}
                        </span>
                    </div><!--/.input group-->
                    {{Form::close()}}
                </li>
                <li>{{ link_to_route('homes.popular', 'Popular', null, array('class' => '')) }}</li>
                <li>{{ link_to_route('homes.latest', 'Latest', null, array('class' => '')) }}</li>
                <li>{{ link_to_route('homes.playlist', 'Playlists', null, array('class' => '')) }}</li>
                <li>{{ link_to_route('homes.top-channels', 'Channels', null, array('class' => '')) }}</li>
                <li><hr/></li>
                @if(Auth::check())

                    <li class="visible-xs"><h4>&nbsp;&nbsp;Account</h4></li>
                
                 
                  
                    <li>{{link_to_route('users.channel', 'My Channel', null, array('class' => ''))}}</li>
                    <li>{{link_to_route('users.notifications', 'Notifications', null, array('class' => ''))}}</li>
                    <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => ''))}}</li>
                @else
                    <li>{{ link_to_route('homes.signin', 'Sign-in', null, array('class' => '')) }}</li>
                @endif
                <li><hr/></li>
                <li class="visible-xs"><h4>&nbsp;&nbsp;TEFL TV Links</h4></li>
                <li class="visible-xs">{{ link_to_route('homes.aboutus', 'About Us', null) }}</li>
                <li class="visible-xs">{{ link_to_route('homes.privacy', 'Privacy', null) }}</li> 
                <li class="visible-xs">{{ link_to_route('homes.copyright', 'Copyright', null) }}</li>
                <li class="visible-xs">{{ link_to_route('homes.advertisements', 'Advertisement', null) }}</li>
                <li class="visible-xs">{{ link_to_route('homes.termsandconditions', 'Terms and Condition', null) }}</li>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
