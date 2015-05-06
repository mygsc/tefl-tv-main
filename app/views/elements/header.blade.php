<div class="brandingHeader">
    <div class="">
        <!--widescreen-->
        <div class="container hidden-xs hidden-sm">
            <div class="row">
                <div class="col-md-6">
                     <div class="brandName">
                    <a href="/"><img src="/img/nav-effect-b.png" class="text-left tefltv-logo animated zoomInRight" title="redirect to homepage"></a>
                    <h1 class="inline orangeC"> tefltv.com</h1>
                    </div>
                </div>

                <div class="col-md-6 col-sm-10 text-right col-xs-10">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            <div class="mg-t-20">
                            {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
                        
                               {{--      {{ Form::select('type',array('Video' => 'Video', 'Playlist' => 'Playlist', 'Channel' => 'Channel'),'Video', array('style' => 'height:20px;', 
                                    'class' => 'cBox'))}} --}}
                               
                                {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5 input-search')) }}
                          
                            {{Form::close()}}
                            </div>
                        </div><!--/.col-md-10 search box-->

                        <div class="col-md-2 col-sm-2 col-xs-3">
                            <div class="text-right">
                                <ul class="ctgryNav pull-right" >
                                    <li>
                                        {{ link_to_route('get.upload', 'Upload', null, array('class' => 'btn btn-upload')) }}
                                    </li>
                                </ul>
                            </div>
                        </div><!--/.col-md-2-->
                    </div><!--/.row-->
                </div><!--/.col-md-8-->
            </div><!--/.row-->
        </div><!--/.container widescrenn-->

        <!--mobile-->
        <div class="container visible-sm visible-xs">
            <div class="row">
                <div class="col-sm-12 col-xs-12 div-ico-up">
                    <a href="/"><img src="/img/nav-effect-b.png" class="text-left" title="redirect to homepage"></a>
                    <a href="{{ route('get.upload') }}" class="pull-right sm-ico-up" title="Upload"><img src="/img/icons/upload-sm.png"></a>
                </div><!--/.row-->
            </div><!--/.container mobile-->
        </div>
    </div>
</div><!--/.brandingHeader-->
