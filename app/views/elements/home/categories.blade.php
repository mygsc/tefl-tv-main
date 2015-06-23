<div class="panel-group ctgryDiv mg-t-10" id="accordion" role="tablist" aria-multiselectable="true">
 @if(Auth::check())
 <div class="panel panel-info same-H ">
  <div class="panel-heading" role="tab" id="headingTwo">
    <p class="panel-title whiteC">
      <a href="">
        <i class="fa fa-user"></i> My Channel
      </a>
    </p>
  </div>
  <div id="myChannel" >
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
<div class="panel panel-info same-H ">
  <div class="panel-heading" role="tab" id="headingNot">
    <p class="panel-title whiteC">
      <a class="" id="notification">
        <span class="badge btn-danger " id="notification-counter"></span>Notifications
      </a>
    </p>
  </div>
  <div id="notifications">
    <div class="panel-body" style="font-size:12px;">
      @if(!$notifications->isEmpty())
        @foreach($notifications as $notification)
          <li>{{$notification->notification}}</li>
        @endforeach
      @else
        No notification
      @endif
      
      <div class="text-center mg-t-10">
      	{{link_to_route('users.notifications', 'See all notifications')}}
      </div>
      
    </div>
  </div>
</div>
@endif
<div class="panel panel-info same-H ">
  <div class="panel-heading" role="tab" id="headingOne">
    <p class="panel-title whiteC">
      <a class="">
        <i class="fa fa-video-camera"></i> Categories
      </a>
    </p>
  </div>
  <div id="categories">
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
