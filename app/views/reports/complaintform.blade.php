@extends('layouts.default')

@section('content')
	<div class="container">
		<div class="row">
		<div class="col-lg-3 col-md-3 hidden-xs hidden-sm">

			<div class="mg-r-10 row">
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
		<div class="col-md-9 White mg-t-10 same-H">
			<h2>Copyright Complaint Form</h2>
			<hr/>
			<h4>Videos to be removed</h4>
			{{Form::open(array('route'=>'post.addreport', 'id' =>'video-addReply', 'class' => 'inline'))}}
				{{Form::hidden('complainant_id', Crypt::encrypt(Auth::User()->id))}}

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
				{{Form::textarea('copyrighted_description', null, array('class'=> 'form-control', 'required'))}}
				<span class="inputError">
					{{$errors->first('copyrighted_description')}}
				</span>
				
				<br/>

				<b>Additional Info:</b>
				{{Form::text('copyrighted_additional_info', null, array('class'=> 'form-control', 'placeholder' => ''))}}
				
				<br/><hr/><br/>

				<h5>*To submit a copyright infringement notification, please complete the following required fields.</h4>
				<h4>Tell us about yourself</h4>
				<div class="row">
					<div class="col-md-6">
						* Copyright Owner Name (TEFL username or full legal name):
						The copyright owner name will be published on TEFL in place of disabled content. 
						his will become part of the public record of your request, along with your description(s)
						 of the work(s) allegedly infringed. All other information, including your full legal name and email address,
						  are part of the full takedown notice, which may be provided to the uploader.
						<br/>
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

						<br/><br/>

						<b>* Contact Number:</b>
						{{Form::text('contact_number', null, array('class'=> 'form-control', 'required'))}}
						<span class="inputError">
							{{$errors->first('contact_number')}}
						</span>

						<br/><br/>

						<b>Fax:</b>
						{{Form::text('fax', null, array('class'=> 'form-control', 'placeholder' => ''))}}
					</div>
					<div class="col-md-6">
						<b>* Street Address:</b>
						{{Form::textarea('streetaddress', null, array('class'=> 'form-control', 'required'))}}
						
						<br/><br/>

						<b>* City:</b>
						{{Form::text('city', null, array('class'=> 'form-control', 'required'))}}

						<br/><br/>

						<b>* State/Province:</b>
						{{Form::text('state_province', null, array('class'=> 'form-control', 'required'))}}

						<br/><br/>

						<b>* Zip/Postal Code:</b>
						{{Form::text('zip_postal', null, array('class'=> 'form-control', 'required'))}}
					
						<br/><br/>

						<b>* Country:</b>

						<select name="country_id" class="form-control">
							@foreach($allcountries as $allcountry)
   								<option value="{{$allcountry->id}}">{{$allcountry->country}}</option>
							@endforeach
						</select>

						<br/><br/>
					</div>
				</div>

				<br/><br/>
					
				<b>*Typing your full name in this box will act as your digital signature.</b>
				{{Form::text('signature', null, array('class'=> 'form-control', 'placeholder' => ''))}}
				<span class="inputError">
					{{$errors->first('signature')}}
				</span>
				
				<br/><br/>

				{{Form::submit('Submit Complaint', array('class'=> 'btn btn-primary pull-left mg-t-10', 'id'=>'complaintbutton'))}}
			{{Form::close()}}
			<br/>
		</div><!--/.col-md-9 left section, writeUps-->
	</div><!--/.container page-->
</div>
@stop