@extends('layouts.default')

@section('content')
<div class='container'>
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-3 hidden-xs hidden-sm col-md-height col-top ">
				<div class="mg-r-10 row mg-t--10" data-sticky_column="">
					@include('elements/home/categories')
					<div>
						@include('elements/home/adverstisement_half_large_recatangle')
					</div>
					<div class="mg-t-10">
						@include('elements/home/carouselAds')
					</div>
					<div class="mg-t-10">
						@include('elements/home/adverstisementSmall')
					</div>
				</div>
			</div>
			<div class="col-md-8 White sameH-h mg-t-10 same-H col-md-height col-top ">
				<div class="content-padding textbox-layout">
					<h2>Copyright Complaint Form</h2>
					<hr/>
					<h3>Videos to be removed</h3>
					{{Form::open(array('route'=>'post.addreport', 'id' =>'video-addReply', 'class' => 'inline'))}}
						{{Form::hidden('complainant_id', Crypt::encrypt(Auth::User()->id))}}
	
						<b>* What is the issue?</b>
	
						<select name="issue" class="form-control">
							<option value="Inappropriate content (Nudity, violence, etc.)">Inappropriate content (Nudity, violence, etc.)</option>
							<option value="I appear in this video without permission">I appear in this video without permission</option>
							<option value="Abuse/Harassment (Someone is attacking me)">Abuse/Harassment (Someone is attacking me)</option>
							<option value="Privacy (Someone is using my image)">Privacy (Someone is using my image)</option>
							<option value="Trademark infringement (Someone is using my trademark)">Trademark infringement (Someone is using my trademark)</option>
							<option value="Copyright infringement (Someone copied my creation)">Copyright infringement (Someone copied my creation)</option>
							<option value="Other legal issue (including the circumvention of technological measures, such as providing keygens or serial numbers)">Other legal issue (including the circumvention of technological measures, such as providing keygens or serial numbers)</option>
						</select>
		
						<br/><br/>
	
						<b>* URL of allegedly infringing video to be removed:</b> <br/>
						<div class="form-group">
							<div class="input-group">
						      	<div class="input-group-addon">{{Request::root()}}/watch?v=</div>
						      	@if(isset($report_url))
						      		{{Form::text('copyrighted_video_url', $report_url, array('class'=> 'form-control', 'placeholder' => 'ex: LO1ibxHmYvL', 'required'))}}
						    	@else
						    		{{Form::text('copyrighted_video_url', null, array('class'=> 'form-control', 'placeholder' => 'ex: LO1ibxHmYvL', 'required'))}}
						    	@endif
						    	<span class="inputError">
									{{$errors->first('copyrighted_video_url')}}
								</span>
						    </div>
						</div>
		
						<br/>
		
						<b>Describe the work allegedly infringed:</b>
						{{Form::textarea('copyrighted_description', null, array('class'=> 'form-control textAreaContact', 'required'))}}
						<span class="inputError">
							{{$errors->first('copyrighted_description')}}
						</span>
						
						<br/><br/>
		
						<b>Additional Info:</b>
						{{Form::text('copyrighted_additional_info', null, array('class'=> 'form-control', 'placeholder' => ''))}}
						
						<br/><hr/
		
						<h3 class="notes">*To submit a copyright infringement notification, please complete the following required fields.</h3>
						<h4>Tell us about yourself</h4>
						<div class="row">
							<div class="col-md-12">
								* Copyright Owner Name (TEFL username or full legal name): 
								The copyright owner name will be published on TEFL in place of disabled content. 
								his will become part of the public record of your request, along with your description(s) 
								of the work(s) allegedly infringed. All other information, including your full legal name 
								and email address, are part of the full takedown notice, which may be provided to the uploader.
								<br/><br/>
								{{Form::text('owner_name', Auth::User()->channel_name, array('class'=> 'form-control', 'disabled'))}}
								
								<br/><br/>
								<b>* Your Full Legal Name (A first and a last name, not a company name):</b>
								{{Form::text('legal_name', null, array('class'=> 'form-control'))}}
								<span class="inputError">
									{{$errors->first('legal_name')}}
								</span>
								
								<br/><br/>
		
								<b>*Your Title or Job Position (What is your authority to make this complaint?):</b>
								{{Form::text('authority_position', null, array('class'=> 'form-control', 'required'))}}
								<span class="inputError">
									{{$errors->first('authority_position')}}
								</span>
		
							</div>
							<div class="col-md-6 mg-t-10">
								<b>* Contact Number:</b>
								{{Form::text('contact_number', null, array('class'=> 'form-control', 'required'))}}
								<span class="inputError">
									{{$errors->first('contact_number')}}
								</span>
							</div>
							<div class="col-md-6 mg-t-10">
								<b>Fax:</b>
								{{Form::text('fax', null, array('class'=> 'form-control', 'placeholder' => ''))}}
							</div>
							<div class="col-md-6 mg-t-10">
								<b>* Street Address:</b>
								{{Form::textarea('streetaddress', null, array('class'=> 'form-control', 'required'))}}
							</div>
							<div class="col-md-6 mg-t-10">
		
								<b>* City:</b>
								{{Form::text('city', null, array('class'=> 'form-control', 'required'))}}
							</div>
							<div class="col-md-6 mg-t-10">
								<b>* State/Province:</b>
								{{Form::text('state_province', null, array('class'=> 'form-control', 'required'))}}
							</div>
							<div class="col-md-6 mg-t-10">
		
								<b>* Zip/Postal Code:</b>
								{{Form::text('zip_postal', null, array('class'=> 'form-control'))}}
							</div>
							<div class="col-md-6 mg-t-10">
		
								<b>* Country:</b>
		
								<select name="country_id" class="form-control">
									@foreach($allcountries as $allcountry)
		   								<option value="{{$allcountry->id}}">{{$allcountry->country}}</option>
									@endforeach
								</select>
		
								<br/><br/>
							</div>
						</div>
		
						<hr/><br/>
							
						<b>*Typing your full name in this box will act as your digital signature.</b>
						{{Form::text('signature', null, array('class'=> 'form-control', 'placeholder' => ''))}}
						<span class="inputError">
							{{$errors->first('signature')}}
						</span>
						<div class="text-right">
						<br/><br/>
						{{Form::submit('Submit Complaint', array('class'=> 'btn btn-primary mg-t-10', 'id'=>'complaintbutton'))}}
						</div>
					{{Form::close()}}
					<br/>
				</div>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop