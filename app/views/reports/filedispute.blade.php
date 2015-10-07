@extends('layouts.default')

@section('title')
    File Dispute | TEFL Tv
@stop

@section('content')
<div class='container'>
	<div class="row mg-t-10" data-sticky_parent="" style="position: relative;">
		<div class="row-same-height">
			<div class="col-md-12 White sameH-h mg-t-10 same-H col-md-height col-top ">
				<div class="content-padding textbox-layout">
					<h2>File Dispute Form</h2>
					<hr/>
					<div class="row">
						<div class="col-md-4">
							<a href="{{route('homes.watch-video', array('v=' .$report->video_url))}}" class="thumbnail-h">
								<div class="thumbnail-2">	
									<img class="hvr-grow-rotate" src="{{$report->thumbnail . '?' . rand(0,99)}}" width="100%">
									<div class="play-hover"><img src="/img/icons/play-btn.png" /> </div>
								</div>
							</a>
						</div>
						<div class="col-md-8">
							<b>Videos to be removed:</b> <a href="{{route('homes.watch-video', array('v='.$report->video_url))}}">{{$report->video_title}}</a>
							<br/>
							<b>Case Number:</b> {{$report->case_number}}
							<br/>
							<b>Complainants Channel:</b> <a href="{{route('view.users.channel', $report->complainants_channel)}}" target="_blank">{{$report->complainants_channel}} </a>
							<br/>
							<b>Issue:</b> {{$report->issue}}
							<br/>
							<b>Report's description:</b> {{$report->copyrighted_description}}
							<br/>
							<b>Additional Information:</b> {{$report->copyrighted_additional_info}}
							<br/>
							<b>Date:</b> {{date("M d, Y", strtotime($report->created_at))}}
						</div>
					</div>
					
					<br/>
					
					<hr/>
					{{Form::open(array('route'=>'post.adddispute', 'id' =>'video-addReply', 'class' => 'inline'))}}
						{{Form::hidden('user_id', Crypt::encrypt(Auth::User()->id))}}
						{{Form::hidden('report_id', Crypt::encrypt($report->id))}}
		
						<b>Describe your video:</b>
						{{Form::textarea('dispute_description', null, array('class'=> 'form-control textAreaContact', 'required'))}}
						<span class="inputError">
							{{$errors->first('dispute_description')}}
						</span>
						
						<br/>
		
						<b>Additional Info:</b>
						{{Form::text('dispute_additional_info', null, array('class'=> 'form-control', 'placeholder' => ''))}}
						
						<b>*Add support URL links for your video:</b> <br/>
						{{Form::text('support_link', null, array('class'=> 'form-control', 'placeholder' => '', 'required'))}}
				    	<span class="inputError">
							{{$errors->first('support_link')}}
						</span>
						
						<br/><hr/>
		
						<h3 class="notes">*To submit a copyright infringement notification, please complete the following required fields.</h3>
						<h4>Tell us about yourself</h4>
						<div class="row">
							<div class="col-md-12">
								* Copyright Owner Name (TEFL username or full legal name):
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
								<br/><br/>
								{{Form::text('owner_name', Auth::User()->channel_name, array('class'=> 'form-control', 'disabled'))}}
								
								<br/><br/>
								<b>* Your Full Legal Name (A first and a last name, not a company name):</b>
								{{Form::text('legal_name', null, array('class'=> 'form-control'))}}
								<span class="inputError">
									{{$errors->first('legal_name')}}
								</span>
								
								<br/><br/>
		
								<b>*Your Title or Job Position (What is your authority to make this dispute?):</b>
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
						{{Form::submit('Submit Dispute', array('class'=> 'btn btn-primary mg-t-10', 'id'=>'complaintbutton'))}}
						<br/><br/>
						</div>
					{{Form::close()}}
				</div>
			</div><!--/.col-md-9 left section, writeUps-->
		</div>
	</div><!--/.container page-->
</div>
@stop