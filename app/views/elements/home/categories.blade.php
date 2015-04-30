  <br/>
  <div class="panel panel-info">
  	<div class="panel-heading" role="tab" id="headingOne">
  		<p class="panel-title">
  			<a class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
  				<i class="fa fa-video-camera"></i> Categories
  			</a>
  		</p>
  	</div>
  	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  		<div class="panel-body" style="max-height:300px; overflow:auto;">
  			<span class="">
  				@if(!empty($categories))
  				@foreach($categories as $category)
  				{{$category}}
  				@endforeach
  				@endif
  			</span>
  		</div>
  	</div>
  </div>