<div class="brandingHeader">
    <div class="">
        <!--widescreen-->
        <div class="container hidden-xs hidden-sm">
            <div class="row">
                <div class="col-md-6">
                    <div class="brandName">
                        <a href="/"><img src="/img/nav-effect-b.png" class="text-left tefltv-logo" title="redirect to homepage"></a>
                        <h1 class="inline tefltvName"> tefltv.com</h1>
                    </div>
                </div>

                <div class="col-md-6 col-sm-10 text-right col-xs-10">
                    <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-9">
                            <div class="mg-t-15">
                            {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
                        
                               {{--      {{ Form::select('type',array('Video' => 'Video', 'Playlist' => 'Playlist', 'Channel' => 'Channel'),'Video', array('style' => 'height:20px;', 
                                    'class' => 'cBox'))}} --}}
                                <div class="input-group" style="">
                                    {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5')) }}
                                    <span class="input-group-btn">
                                    {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
                                    </span>
                                    {{Form::close()}}
                                </div>
                   
                            </div><!--/.col-md-10 search box-->
                        </div>      
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
                    <a href="/"><img src="/img/nav-effect-b.png" class="text-left logo-sm" title="redirect to homepage"></a>
                        <h2 class="inline orangeC"> tefltv.com</h2>
                    <a href="{{ route('get.upload') }}" class="pull-right sm-ico-up" title="Upload"><img src="/img/icons/upload-sm.png"></a>
                </div><!--/.row-->
            </div><!--/.container mobile-->
        </div>
    </div>
</div><!--/.brandingHeader-->
