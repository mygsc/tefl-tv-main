<div class="brandingHeader">
    <div class="container">
     <div class="row">
          <div class="col-md-3">
               <div class="row">
                    <a href="/"><img src="/img/nav-effect-b.png" class="text-left" title="redirect to homepage"></a>
               </div><!--/.row or col-30-->
          </div><!--/.col-md-3-->

          <div class="col-md-offset-4 col-md-5">
               <div class="row">
                    <br/>
                    <div class="input-group">
                         {{ Form::open(array('route' => 'post.search-video'))}}
                         {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
                         {{ Form::select('type', array(
                          'video' => 'video',
                          'playlist' => 'playlist',
                          'channel' => 'channel'))}}
                         <span class="input-group-btn">
                            {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
                            {{ Form::close()}}
                       </span>
                  </div>
             </div><!--/.row-->
        </div><!--/.col-md-5-->
   </div><!--/.first row-->
</div><!--/.container-->
</div><!--/.brandingHeader-->

