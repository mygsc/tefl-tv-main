    <div class="same-H">
        <div class="h-title">
            <div class="row">
                Recommended Channels
            </div>
        </div>
        <div class="sideLinksDiv VSthumbnails same-H">

            @foreach($datas as $channel)
            <li> 
                <a href="channels/{{$channel->channel_name}}">
                    {{HTML::image($channel['profile_picture'], 'alt', array('class' => 'user mg-l-10'))}}
                    <br>
                    <span>{{$channel->channel_name}}<br>
                        <small>{{count($countSubscribers)}} Subscriber(s)</small>
                        <!-- <button class="btn btn-primary btn-xs pull-right mg-r-10">Subscribe</button> -->
                        @if(isset(Auth::User()->id))
                        @if(isset($channel->id))
                        @if((Auth::User()->id) AND (Auth::User()->id != $channel->id))
                        <?php
                        $ifAlreadySubscribe = DB::table('subscribes')->where(array('user_id' => $channel->id, 'subscriber_id' => Auth::User()->id))->first();
                        ?>
                        {{Form::open(array('route'=>'post.addsubscriber', 'id' =>'subscribe-userChannel', 'class' => 'inline'))}}
                        {{Form::hidden('user_id', $channel->id)}}
                        {{Form::hidden('subscriber_id', Auth::User()->id)}}
                        @if(!$ifAlreadySubscribe)
                        {{Form::hidden('status','subscribeOn')}}
                        {{Form::submit('Subscribe', array('class'=> 'btn btn-primary btn-sm pull-right mg-r-10', 'id'=>'subscribebutton'))}}
                        @else
                        {{Form::hidden('status','subscribeOff')}}
                        {{Form::submit('Unsubscribe', array('class'=> 'btn btn-primary btn-sm pull-right mg-r-10', 'id'=>'subscribebutton'))}}
                        @endif
                        {{Form::close()}}
                        @endif
                        @endif
                        @endif
                    </span>
                </a>
            </li><!--/first recommended channel-->
            @endforeach
            <div class="text-center">
             {{ link_to_route('homes.top-channels', 'see more..', null) }}
         </div> 
    </div><!--/.sideLinksDiv VSthumbnails-->
</div>