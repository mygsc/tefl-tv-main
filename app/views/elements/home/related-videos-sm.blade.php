<div class="modal fade" id="relatedVideos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Related Videos</h4>
    </div>
    <div class="modal-body">
        <ul class="ui-tabs-nav same-H"> <!--video navigation or video list-->
            <h4 align='center' id='next-video-autoplay'>Up next autoplay</h4>
            @foreach($newRelation as $relation)
            <li class="ui-tabs-nav-item showhim" id="">
                <a href="/watch?v={{$relation['file_name']}}" id="videourl{{$videourl++}}">   
                   <div class="row p-relative">
                    <div class="show_wrapp">
                        <div class=" col-middle">
                            @if(file_exists(public_path("/videos/".$relation['uid']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                            <div class="showme" style="background:url(/videos/{{$relation['uid']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg);background-size:100% auto;height:100%!important;" >     
                                @else
                                <div class="showme" style="background:url(/img/thumbnails/video.png);background-size:100% auto;">
                                    @endif

                                    <div class="show-info" style="width: 100%;height: 100%;background:rgba(31, 51, 89, 0.8);">
                                        <div class="showInfo-wrapp ">
                                            <div class="showInfo-div">
                                                <span class="info-title">{{ ($relation['title']) }}</span><br/>
                                                by: {{$relation['channel_name']}}<br/>
                                                {{date('M d, Y',strtotime($relation['created_at']))}} | {{number_format($relation['views'])}} view/s
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-same-height" title="">
                                <div class="col-md-5 col-xs-4 col-md-height col-middle">
                                    @if(file_exists(public_path("/videos/".$relation['uid']."/".$relation['file_name']."/".$relation['file_name'].".jpg")))
                                    <img src="/videos/{{$relation['uid']}}/{{$relation['file_name']}}/{{$relation['file_name']}}.jpg" alt="" width="100%" />
                                    @else
                                    <img src="/img/thumbnails/video.png" alt="" width="100%" />
                                    @endif
                                </div>
                                <div class="col-md-7 col-sm-8 col-xs-4 col-md-height col-middle">
                                    <div class="hide_h">
                                        <div class="visible-lg"><span class="v-list text-justify">{{ Str::limit($relation['title'],68) }}</span></div>
                                        <div class="visible-md"><span class="v-list text-justify">{{ Str::limit($relation['title'],45) }}</span></div>
                                        <div class="visible-sm"><span class="v-list text-justify">{{ Str::limit($relation['title'],30) }}</span></div>
                                    </div>
                                    <span>by: {{$relation['channel_name']}}</span><br/>
                                    <!--<span>{{date('M d, Y',strtotime($relation['created_at']))}}</span><br/>-->
                                    <span>{{number_format($relation['views'])}} view/s</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul><!--video list-->
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
</div>