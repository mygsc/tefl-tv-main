<div class="categoryNav">
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
                    <li>
                    @if(Auth::check())
                    <li><b>{{link_to_route('users.channel', 'My Channel', Auth::User()->channel_name, array('class' => ''))}}</b></li>
                    <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => ''))}}</li>
                    @else
                    {{ link_to_route('homes.signin', 'Sign-in', null, array('class' => '')) }}
                    @endif


                  </li>
                </ul>  
            </div>
      
  </div><!--/.container-->
</div><!--/.categoryNav-->
