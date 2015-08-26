<!-- CSS -->
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/myStyle.css') }}
{{ HTML::style('css/animate.css') }}
{{ HTML::style('font-awesome/css/font-awesome.min.css') }}
@yield('css')


<div class="row">
	<div class="">
		<img src="/img/errorBg.png" style="width:100%;" class="shadow mg-b-20">

		<div class="">
			<h1 class="text-center animated slideInDown">Sorry something went wrong.<br/>
			<small class="text-center mg-b-20 ">Would you like to report this? Please contact our administrator.</small></h1>
			<div class="text-center ">
				<button type="button" class="btn btn-danger animated slideInLeft" data-toggle="modal" data-target="#reportModal">
 					<i class="fa fa-flag"></i> Report
				</button> <a href="/"><button class="btn btn-primary animated slideInRight"><i class="fa fa-home"></i> Home</button></a>
			</div>
		</div>
	
	</div>
</div>

<!-- Modal -->
	<div class="modal fade overlay" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  	<div class="modal-dialog black ">
	    	<div class="modal-content center-block">
	      		<div class="modal-header LightestBlue">
	      			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	       			<h2><i class="fa fa-flag"></i> Report Form</h2>
	     		 </div>
	     	 	<div class="modal-body" width="80%">
		            <div class="">
		            	<span class="textbox-layout">
		            	{{Form::open(array('route' => 'post.homes.supportreport', 'id'=>'reportsubmit'))}}
							{{ Form::text('name', '', array('placeholder' => 'Name' , 'class' => 'form-control', 'required')); }}
							@if($errors->has('name'))
							<span class="inputError">
								{{$errors->first('name')}}
							</span>
							@endif
							{{ Form::text('email', '', array('placeholder' => 'Email' , 'class' => 'form-control', 'required')); }}
							@if($errors->has('email'))
							<span class="inputError">
								{{$errors->first('email')}}
							</span>
							@endif
							{{ Form::textarea('message', '', array('placeholder' => 'Message', 'class' => 'textAreaContact' , 'class' => 'form-control t-mess', 'required')); }}
							@if($errors->has('message'))
							<span class="inputError">
								{{$errors->first('message')}}
							</span>
							@endif
						</span>
		            </div>            
	      		</div>
		      	<div class="modal-footer LighterBlue">
			        {{Form::submit("Submit", array('class' => 'btn btn-primary'))}}
			        {{Form::close()}}
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      	</div>
	   		</div>
	 	</div>
	</div>
<!-- scripts -->
{{HTML::script('js/jquery.min.js')}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function(){
	    $('form#reportsubmit').on('submit', function(e){
	    	// e.preventDefault();
	    	var url = $(this).prop('action');
	        $.ajax({
				type: 'POST',
				url: url,
				context: this,
				cache: false, 
	        	data: $(this).serialize(),//{
	        	success: function(data){
	        		if(data['status'] == 'error'){
	        			// $('#errorlabel').text(data['label']);
	        			// $("#errorlabel").focus();
	        		}
	        		if(data['status'] == 'success'){
	        			// alert(data['status']);
	        			// $('textarea.txtreply').val('');
	        			// $(this).prepend(data['reply']);
		        	}
	        	}
	    	});
	    });
	});
</script>