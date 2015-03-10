<div class="brandingHeader">
  <div class="row">
    <a href="/"><img src="/img/logos/teflTv.png" class="text-left" title="redirect to homepage" style="position:absolute;height:auto;width:75px;left:30px"></a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => ''))}}
        <div class="input-group" style="background:#eee; padding:3px 3px; margin-bottom:5px;">
          <span class="input-group-addon" style="padding:0!important;">
            {{ Form::select('type',array('Video' => 'Video', 'Playlist' => 'Playlist', 'Channel' => 'Channel'),'Video', array('style' => 'height:20px;', 
          'class' => 'cBox'))}}
          </span>
          {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control col-md-5')) }}
          <span class="input-group-addon" style="padding:0!important;">
            {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info')) }}
          </span>
        </div>
        {{Form::close()}}
    </div>
    <div class="col-md-6">
      <div class="row text-right">
        <ul class="ctgryNav pull-right" >
          <li>
            @if(Auth::check())
            <li><b>{{link_to_route('users.channel', 'My Channel', Auth::User()->channel_name, array('class' => 'btn'))}}</b></li>
            <li>{{link_to_route('users.signout', 'Sign-out', null, array('class' => 'btn'))}}</li>

            @else
            {{ link_to_route('homes.signin', 'Sign-in', null, array('class' => 'btn btn-info whiteC accntbtn')) }}
            @endif

          </li>
          <li>
           {{ link_to_route('get.upload', 'Upload', null, array('class' => 'btn btn-primary orangeC')) }}

         </li>
       </ul>
     </div>
   </div><!--/.col-md-4-->
   
 </div><!--/.col-md-5-->
</div><!--/.first row-->
</div><!--/.container-->
</div><!--/.brandingHeader-->


