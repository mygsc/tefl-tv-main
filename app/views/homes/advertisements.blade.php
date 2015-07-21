@extends('layouts.default')

@section('css')
{{HTML::style('css/vid.player.min.css')}}
@stop
@section('some_script')
{{HTML::script('js/video-player/media.player.min.js')}}
{{HTML::script('js/video-player/fullscreen.min.js')}}
@stop

@section('content')
    <br/>
    <div class="col-md-6 col-md-offset-3">

        <div id="carousel-2" class="carousel slide greyDark" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>

          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
                <div class="vid-wrapperb p-relative">
                    <div id="vid-controls">
                        <div class="embed-responsive embed-responsive-16by9 n-mg-b">
                            <video class="video-1" preload="auto" id="media-video" poster="/img/thumbnails/v1.png">
                                <source  src='/videos/tefltv.mp4' id="mp4" type='video/mp4'/>
                                <source  src='/videos/tefltv.webm' id="webm" type='video/webm'/>
                            </video>
                        </div><!--/embed-responsive-->
                        <div class="n-mg-b">
                          @include('elements/videoPlayer')
                      </div>
                  </div>
              </div>
          </div>  
          <div class="item">
            <div class="vid-wrapperb p-relative">
                <div id="vid-controls">
                    <div class="embed-responsive embed-responsive-16by9 n-mg-b">
                        <video class="video-2" preload="auto"  id="media-video" poster="/img/thumbnails/v10.jpg">
                            <source  src='/videos/publishers-id.mp4' id="mp4" type='video/mp4'/>

                        </video>
                    </div><!--/embed-responsive-->
                    <div class="n-mg-b">
                      @include('elements/videoPlayer')
                  </div>
              </div>
          </div>

        </div>

        </div>

    <!-- Controls -->
        <a class="left carousel-control" href="#carousel-2" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-2" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>


</div>


@stop

<script type="text/javascript">
    $('#carousel-2').carousel({
        interval: 1000 * 10;
    });
    $(.item .active).carousel({
        vid.play(); 
    })
</script>