<div class="brandingHeader">
    <div class="">
        <!--widescreen-->
        <div class="container hidden-xs hidden-sm">
            <div class="row">
                <div class="col-md-4 hidden-sm hidden-xs ">
                    <a href="/"><img src="/img/nav-effect-b.png" class="text-left" title="redirect to homepage"></a>
                </div>

                <div class="col-md-8 col-sm-10 text-right col-xs-10">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
                            <div class="input-group h-div-search">
                                <span class="input-group-addon pas-0">
                               {{--      {{ Form::select('type',array('Video' => 'Video', 'Playlist' => 'Playlist', 'Channel' => 'Channel'),'Video', array('style' => 'height:20px;', 
                                    'class' => 'cBox'))}} --}}
                                </span>
                                {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5')) }}
                                <span class="input-group-addon pad-0">
                                    {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info')) }}
                                </span>
                            </div><!--/.input group-->
                            {{Form::close()}}
                        </div><!--/.col-md-10 search box-->

                        <div class="col-md-2 col-sm-2 col-xs-3">
                            <div class="row text-right">
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
