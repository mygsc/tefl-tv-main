<?php

class ReportController extends BaseController {
	public function __construct(User $user, Video $video,Notification $notification, Subscribe $subscribes,Playlist $playlists, Comment $comments, Country $countries, Report $reports) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
		$this->Subscribe = $subscribes;
		$this->Playlist = $playlists;
		$this->Comment = $comments;
		$this->Country = $countries;
		$this->Report = $reports;
	}

	public function getComplaintForm() {
		if(!Auth::check()){
			Session::put('url.intended', URL::full());
			return Redirect::route('homes.signin')->with('flash_bad', 'You need to signin first.');
		}
		if (Request::isMethod('post')) $report_url = Input::get('report_url');
		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();
		$allcountries = $this->Country->getAllCountries();
		return View::make('reports.complaintform', compact('categories','notifications', 'allcountries', 'report_url'));
	}

	public function addComplaint() {
		$input = Input::all();
		$complainant_id = Crypt::decrypt(Input::get('complainant_id'));
		$country_id = Input::get('country_id');
		$issue = Input::get('issue');
		$copyrighted_video_url = Input::get('copyrighted_video_url');
		$copyrighted_description = Input::get('copyrighted_description');
		$copyrighted_additional_info = Input::get('copyrighted_additional_info');
		$legal_name = Input::get('legal_name');
		$authority_position = Input::get('authority_position');
		$contact_number = Input::get('contact_number');
		$fax = Input::get('fax');
		$streetaddress = Input::get('streetaddress');
		$city = Input::get('city');
		$state_province = Input::get('state_province');
		$zip_postal = Input::get('zip_postal');
		$signature = Input::get('signature');

		$validate = Validator::make($input, Report::$complaintRules);

		if(!$validate->passes()){
			return Redirect::route('get.complaint_form')->withFlashBad('Please check your inputs')->withInput()->withErrors($validate);
		}

		$reported_info = User::find($complainant_id);
		$reported_video = Video::where('file_name',$copyrighted_video_url)->first();
		
		$ifVideoIsExisting = Video::where('file_name',$copyrighted_video_url)->count();
		if($ifVideoIsExisting == 0){
			return Redirect::route('get.complaint_form')->withFlashBad('Invalid video url. Please try again.')->withInput();
		}

		$uploader_info = User::find($reported_video->user_id);

		$getLastTicketNumber = Report::orderby('id', 'DESC')->first();
		$splitTicketNumber = explode('-', $getLastTicketNumber->case_number);
		$yearMonthCaseNumber = date('Y-md-');
		$case_number = $yearMonthCaseNumber . str_pad(1, 4, '0', STR_PAD_LEFT);

		if(date('Y-md') == ($splitTicketNumber[0] . '-' . $splitTicketNumber[1])){
			$case_number = $yearMonthCaseNumber . str_pad(($splitTicketNumber[2] + 1), 4, '0', STR_PAD_LEFT);
		}

		Report::create(array('case_number'=> $case_number, 'complainant_id'=>$complainant_id, 
			'user_id'=>$reported_video->user_id, 'country_id'=> $country_id, 'issue' => $issue,
		 	'video_id'=>$reported_video->id,'copyrighted_description' => $copyrighted_description,
		 	'copyrighted_additional_info' => $copyrighted_additional_info, 'legal_name'=> $legal_name,
			'authority_position'=>$authority_position, 'contact_number'=> $contact_number,
			'fax'=>$fax, 'streetaddress'=> $streetaddress,
			'city'=>$city, 'state_province'=> $state_province,'zip_postal'=>$zip_postal, 'signature'=> $signature
		));

		$data1 = array('legal_name' => $legal_name, 
			'case_number' => $case_number, 
			'complainant_email' =>  $reported_info->email,
			'channel_name' =>  $reported_info->channel_name,
			'uploader_email' =>  $uploader_info->email
		);
		$data2 = array('legal_name' => $legal_name, 
			'case_number' => $case_number, 
			'uploader_email' =>  $uploader_info->email,
			'channel_name' =>  $uploader_info->channel_name,
			'complainant_email' =>  $reported_info->email,
			'complainant_channel' =>  $reported_info->channel_name
		);

		$complainant_channel = $reported_info->channel_name;
		$uploader_channel = $uploader_info->channel_name;
		
		$reportedemail = $reported_info->email;
		$uploaderemail = $uploader_info->email;
		
		Mail::send('emails.reports.complainant_report', $data1, function($message1) use($reported_info) {
			// $message1->from('report@tefltv.com', 'Report | TEFL TV');
			$message1->to('r3mmel023@gmail.com')->subject('Complaint Email');
		});//test

		Mail::send('emails.reports.complainant_report', $data1, function($message1) use($reported_info) {
			// $message1->from('report@tefltv.com', 'Report | TEFL TV');
			// $message1->to('r3mmel023@gmail.com')->subject('Complaint Email');
			$message1->to($reported_info->email)->subject('Complaint Email');
		});
		Mail::send('emails.reports.uploaders_report', $data2, function($message2) use($uploader_info) {
			// $message2->from('report@tefltv.com', 'Report | TEFL TV');
			// $message2->to($data2['uploader_email'])->subject('Complaint Email');
			$message2->to($uploader_info->email)->subject('Complaint Email');
		});

		return Redirect::route('get.complaint_form')->withFlashGood('Complaint was submitted');
	}

	public function getFileDispute() {
		return View::make('reports.filedispute');
	}
}
