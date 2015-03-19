		<div class="modal fade overlay" id="updateVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow:scroll;">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<h4>Update Video</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row content-padding  textbox-layout" >
		      		
		      		<img src="/img/thumbnails/v2.png">
		      	
		      		<select class="form-control" style="width:auto;margin-top:10px;margin-bottom:10px;">
		      			<option>Publish</option>
		      			<option>Unpublish</option>
		      		</select>
		      		<br/>
		      		<label>Title</label>
		      		<input type="text" class="form-control">
		      		<label>Descriptions</label>
		      		<textarea class="form-control"></textarea>
		      		<label>Tags</label>
		      		<input type="text" class="form-control">
		      	
		      	 
			    </div>
		      </div>
		      <div class="modal-footer">
		      		<div class="text-right">
			      		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			        	{{Form::submit('Upload', array('class' => 'btn btn-info'))}}
			        	{{Form::close()}}
			      	</div>
		      </div>
		    </div>
		  </div>
		</div>
