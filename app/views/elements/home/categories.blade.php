
          <div class="panel-group ctgryDiv" id="accordion" role="tablist" aria-multiselectable="true">
               @if(Auth::check())
              <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <p class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="fa fa-user"></i> My Channel
                    </a>
                  </p>
                </div>
                <div id="collapseTwo" class="panel-collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <li role="presentation">{{link_to_route('users.channel', 'Home', Auth::User()->channel_name)}}</li>
                  <li role="presentation">{{link_to_route('users.about', 'About')}}</li>
                  <li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
                  <li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
                  <li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
                  <li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
                  <!--<li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>-->
                  <li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>
                  
                 </div>
                </div>
             </div>
              <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingNot">
                  <p class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNot" aria-expanded="false" aria-controls="collapseNot">
                    <span class="badge btn-danger " id="notification-counter"></span>Notifications
                    </a>
                  </p>
                </div>
                <div id="collapseNot" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNot">
                  <div class="panel-body">
                        
                 </div>
                </div>
             </div>
             @endif
              <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="headingOne">
                  <p class="panel-title">
                    <a class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <i class="fa fa-video-camera"></i> Categories
                    </a>
                  </p>
                </div>
                <div id="collapseOne" class="panel-collapse " role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body cat-h">
                      <span class="">
                    @if(!empty($categories))
                    @foreach($categories as $category)
                      {{$category}}
                    @endforeach
                    @endif
                  </span>
                  </div>
                </div>
            </div> 
          </div>