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
                   <!-- {{ Form::open(array('route' => 'post.search-video'))}}
                    <div class="col-md-2">
                          {{ Form::select('type', array(
                          'video' => 'video',
                          'playlist' => 'playlist',
                          'channel' => 'channel'))}}
                    </div>
                    <div class="col-md-10">
                      <div class="input-group">

                           {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
                          
                           <span class="input-group-btn">
                              {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
                              
                         </span>
                    </div>
                  </div>
                  {{ Form::close()}}
             </div><!--/.row-->

              <div class="input-group">
                 {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}
                    
                <div class="input-group-btn">
                     <!--dropdown button-->    
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Video</a></li>
                        <li><a href="#">Playlist</a></li>
                        <li><a href="#">Channel</a></li>
                    </ul>
                    <!--simple button-->    
                      {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
                    
                   
                </div>      
              </div>        


    

        </div><!--/.col-md-5-->
   </div><!--/.first row-->
</div><!--/.container-->
</div><!--/.brandingHeader-->


