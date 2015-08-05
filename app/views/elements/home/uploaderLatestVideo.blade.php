  <div class="White mg-t-10 same-H">
        
            <div class="h-title dark"><!--From highest number of folloers-->

               Latest Uploads     
           </div>

       <br>
       <div class="mg-l-10 mg-r-10">
       <div class="row">
        @if(empty($ownerVideos))
        <h3><p>No latest upload yet.</p></h3>
        @else
        @foreach($ownerVideos as $ownerVideo)
        <div class="col-md-4">
            <div class="p-relative">
                <span class="v-time inline">{{$ownerVideo->total_time}}</span>
                <a href="/watch?v={{$ownerVideo->file_name}}" class="">
                    <div class="thumbnail-2">
                        @if(file_exists(public_path("/videos/".$ownerVideo->user_id."-".$owner->channel_name."/".$ownerVideo->file_name."/".$ownerVideo->file_name.".jpg")))
                            <img class="hvr-grow-rotate" src="/videos/{{$ownerVideo->user_id}}-{{$owner->channel_name}}/{{$ownerVideo->file_name}}/{{$ownerVideo->file_name}}.jpg" alt="" width="100%" />
                            @else
                            <img class="hvr-grow-rotate" src="/img/thumbnails/video.png" alt=""  width="100%"/>
                        @endif
                            <div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
                    </div>
                    <div class="video-info">
                        <div class="v-Info">
                            <b>{{$ownerVideo->title}}</b>
                        </div>
                        <!--<small><p class="text-justify">{{ Str::limit($ownerVideo->description, 60) }}</p></small><br/>-->
                        <div class="count">
                            <i class="fa fa-eye"></i> {{$ownerVideo->views}}  | <i class="fa fa-thumbs-up"></i> {{$likeownerVideos[$likeownerVideosCounter++]}} | <i class="fa fa-calendar"></i> {{date('M d, Y',strtotime($ownerVideo->created_at))}}
                        </div>
                    </div>
                </a>
            </div>
       </div>
       @endforeach
       @endif
   </div>
   <br/>
</div>
</div>



