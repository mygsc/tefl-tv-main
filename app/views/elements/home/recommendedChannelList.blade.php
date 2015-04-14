<div class="h-title">Recommended Channels</div>
<div class="sideLinksDiv VSthumbnails">     
@foreach($datas as $channel)
    <li>   
        <a href="channels/{{$channel->channel_name}}">
            @if(file_exists(public_path('img/user/') . $channel->id . '.jpg'))
                {{HTML::image('img/user/'. $channel->id . '.jpg', 'alt')}}
            @else
                {{HTML::image('/img/user/0.jpg', 'alt')}}
            @endif
            <br>
            <span>{{$channel->channel_name}}<br>
            <small>{{count($channel->subscribers)}} Subscriber(s)</small>
            <button class="btn btn-primary btn-xs pull-right mg-r-10">Subscribe</button>
            </span>
        </a>
    </li><!--/first recommended channel-->
@endforeach
    <div class="text-center">
       {{ link_to_route('homes.top-channels', 'see more..', null) }}
    </div> 
</div><!--/.sideLinksDiv VSthumbnails-->
