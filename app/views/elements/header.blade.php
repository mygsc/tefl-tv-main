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
        {{Form::open(array('route' => 'homes.searchresult','method' => 'GET', 'style' => 'width:400px;padding-botton:20px;'))}}
        {{ Form::text('search', null, array('id' => 'category','required', 'placeholder' => 'Search Video', 'class' => 'form-control c-input ')) }}

        
        {{ Form::select('type',array('Video' => 'Video', 'Playlist' => 'Playlist', 'Channel' => 'Channel'),'Video', array('style' => 'height:30px;'))}}
        <!--simple button-->    
        {{ Form::submit('Search', array('id' => 'button', 'class' => 'btn btn-info ')) }}
        {{Form::close()}}

      </div>      
    </div><!--/.col-md-5-->
  </div><!--/.first row-->
</div><!--/.container-->
</div><!--/.brandingHeader-->


