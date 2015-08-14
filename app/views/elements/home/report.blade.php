@if(Auth::check())
	<div class="panel panel-info same-H ">
		<div class="panel-heading" role="tab" id="headingTwo">
			<p class="panel-title whiteC">
				<a href="">
					<i class="fa fa-user"></i> Reports
				</a>
			</p>
		</div>
		<div id="myChannel" >
			<div class="panel-body">
				<li role="presentation">{{link_to_route('get.myreports', 'My Reports')}}</li>
				<li role="presentation">{{link_to_route('get.complaint_form', 'Complaint Form')}}</li>
			</div>
		</div>
	</div>
@endif