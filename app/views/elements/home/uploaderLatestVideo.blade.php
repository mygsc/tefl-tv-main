  <div class="row grey mg-t-10 same-H">
        
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
            <div class="vThumbnails">
                <a href="/watch!v={{$ownerVideo->file_name}}" class="">
                    @if(file_exists(public_path("/videos/".$ownerVideo->user_id."-".$owner->channel_name."/".$ownerVideo->file_name."/".$ownerVideo->file_name.".jpg")))
                    <img src="/videos/{{$ownerVideo->user_id}}-{{$owner->channel_name}}/{{$ownerVideo->file_name}}/{{$ownerVideo->file_name}}.jpg" alt=""/>
                    @else
                    <img src="/img/thumbnails/video.png" alt="" />
                    @endif
                   <b>{{$ownerVideo->title}}</b>
                    <small><p class="text-justify">{{ Str::limit($ownerVideo->description, 60) }}</p></small><br/>
                    <div class="count">
                       <i class="fa fa-eye"></i> {{$ownerVideo->views}}  | <i class="fa fa-thumbs-up"></i> {{$likeownerVideos[$likeownerVideosCounter++]}} | <i class="fa fa-calendar"></i> {{$ownerVideo->created_at->toFormattedDateString()}}
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



