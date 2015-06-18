<div class="panel-group ctgryDiv" id="accordion" role="tablist" aria-multiselectable="false">
 @if(Auth::check())
 <div class="panel panel-info">
  <div class="panel-heading" role="tab" id="headingTwo">
    <p class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#myChannel" aria-expanded="false" aria-controls="myChannel">
        <i class="fa fa-user"></i> My Channel
      </a>
    </p>
  </div>
  <div id="myChannel" class="panel-collapse" role="tabpanel" aria-labelledby="headingTwo">
    <div class="panel-body">
      <li role="presentation">{{link_to_route('users.channel', 'Home')}}</li>
      <li role="presentation">{{link_to_route('users.about', 'About')}}</li>
      <li role="presentation">{{link_to_route('users.myvideos', 'My Videos')}}</li>
      <li role="presentation">{{link_to_route('users.myfavorites', 'My Favorites')}}</li>
      <li role="presentation">{{link_to_route('users.watchlater', 'Watch Later')}}</li>
      <li role="presentation">{{link_to_route('users.playlists', 'My Playlists')}}</li>
      <li role="presentation">{{link_to_route('users.feedbacks', 'Feedbacks')}}</li>
      <li role="presentation">{{link_to_route('users.subscribers', 'Subscribers/Subscriptions')}}</li>

    </div>
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading" role="tab" id="headingNot">
    <p class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#notifications" aria-expanded="false" aria-controls="notifications" id="notification">
        <span class="badge btn-danger " id="notification-counter"></span>Notifications
      </a>
    </p>
  </div>
  <div id="notifications" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNot">
    <div class="panel-body" style="font-size:12px;">
      @if(!empty($notifications))
        @foreach($notifications as $notification)
          <li>{{$notification->notification}}</li>
        @endforeach
      @else
        No new notifcation
      @endif
      
      <div class="text-center mg-t-10">
      	{{link_to_route('users.notifications', 'See all notifications')}}
      </div>
      
    </div>
  </div>
</div>
@endif
<div class="panel panel-info">
  <div class="panel-heading" role="tab" id="headingOne">
    <p class="panel-title">
      <a class="" data-toggle="collapse" data-parent="#accordion" href="#categories" aria-expanded="true" aria-controls="categories">
        <i class="fa fa-video-camera"></i> Categories
      </a>
    </p>
  </div>
  <div id="categories" class="panel-collapse" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body cat-h">
      <span class="">
        @if(!empty($categories))
          @foreach($categories as $category)
          <span class="capitalize"> {{$category}}</span>
          @endforeach
        @endif
      </span>
    </div>
  </div>
</div> 
</div>
