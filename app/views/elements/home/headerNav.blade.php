<div class="categoryNav">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-left"> 
                <div class="row">
                    <ul class="ctgryNav" style="margin-left:-40px;">
                        <li>
                            {{ link_to_route('homes.popular', 'Popular', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.latest', 'Latest', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.random', 'Random', null) }}
                        </li>
                        <li>
                            {{ link_to_route('homes.top-channels', 'Channels', null) }}
                        </li>

                        
                    </ul>
                </div>
            </div><!--/.col-md-8-->
            <div class="col-md-4">
                <div class="row text-right">
                    <ul class="ctgryNav" >
                        <li>
                            @if(Auth::check())
                                <li><b>{{link_to_route('users.channel', 'My Channel', Auth::User()->channel_name)}}</b></li>
                                <li>{{link_to_route('users.signout', 'Sign-out', null)}}</li>

                            @else
                                {{ link_to_route('homes.signin', 'Sign-in', null, array('class' => 'btn btn-info whiteC accntbtn')) }}
                            @endif
                           
                       </li>
                       <li>
                       {{-- link_to_route('get.upload', 'Upload', null, array('class' => 'btn btn-primary orangeC')) --}}
                        <div class="btn btn-primary orangeC" style="position: relative; ">
                            <form action="{{route('post.upload')}}" method="POST" enctype="multipart/form-data" id ='submit'>
                                <input style="cursor:pointer; position: absolute;z-index: 2;opacity: 0;width: 100%;height: 100%;" type="file" name="video" id="upload"/>
                                Upload
                            </form>
                        </div>
                        
                       </li>
                    </ul>
                </div>
            </div><!--/.col-md-4-->
        </div><!--/.row-->
   </div><!--/.container-->
</div><!--/.categoryNav-->
