<?php

class ReportController extends BaseController {
	public function __construct(User $user, Video $video,Notification $notification, Subscribe $subscribes,Playlist $playlists, Comment $comments, Country $countries, Report $reports, Dispute $disputes) {
		$this->User = $user;
		$this->Video = $video;
		$this->Notification = $notification;
		$this->Auth = Auth::User();
		$this->Subscribe = $subscribes;
		$this->Playlist = $playlists;
		$this->Comment = $comments;
		$this->Country = $countries;
		$this->Report = $reports;
		$this->Dispute = $disputes;
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
		$validate = Validator::make($input, Report::$complaintRules);

		if(!$validate->passes()) return Redirect::route('get.complaint_form')->withFlashBad('Please check your inputs')->withInput()->withErrors($validate);

		$reported_info = User::find($complainant_id);
		$reported_video = Video::where('file_name', Input::get('copyrighted_video_url'))->first();	
		$ifVideoIsExisting = Video::where('file_name', Input::get('copyrighted_video_url'))->count();

		if($ifVideoIsExisting == 0) return Redirect::route('get.complaint_form')->withFlashBad('Invalid video url. Please try again.')->withInput();

		$uploader_info = User::find($reported_video->user_id);
		$getLastTicketNumber = Report::orderby('id', 'DESC')->first();
		$splitTicketNumber = explode('-', $getLastTicketNumber->case_number);
		$yearMonthCaseNumber = date('Y-md-');
		$case_number = $yearMonthCaseNumber . str_pad(1, 4, '0', STR_PAD_LEFT);

		if(date('Y-md') == ($splitTicketNumber[0] . '-' . $splitTicketNumber[1])){
			$case_number = $yearMonthCaseNumber . str_pad(($splitTicketNumber[2] + 1), 4, '0', STR_PAD_LEFT);
		}

		$newReport = $this->Report->createReport($input, $case_number, $complainant_id, $reported_video->user_id, $reported_video->id);

		$data1 = array('legal_name' => Input::get('legal_name'), 
			'case_number' => $case_number,  'complainant_email' =>  $reported_info->email,
			'channel_name' =>  $reported_info->channel_name, 'uploader_email' =>  $uploader_info->email
		);

		$data2 = array('legal_name' => Input::get('legal_name'), 
			'case_number' => $case_number, 
			'uploader_email' =>  $uploader_info->email, 'channel_name' =>  $uploader_info->channel_name,
			'complainant_email' =>  $reported_info->email, 'complainant_channel' =>  $reported_info->channel_name
		);

		$complainant_channel = $reported_info->channel_name;
		$uploader_channel = $uploader_info->channel_name;

		Mail::send('emails.reports.complainant_report', $data1, function($message1) use($reported_info) {
			$message1->to('r3mmel023@gmail.com')->subject('Complaint Email');
		});//test
		Mail::send('emails.reports.complainant_report', $data1, function($message1) use($reported_info) {
			$message1->to($reported_info->email)->subject('Complaint Email');
		});
		Mail::send('emails.reports.uploaders_report', $data2, function($message2) use($uploader_info) {
			$message2->to($uploader_info->email)->subject('Complaint Email');
		});

		return Redirect::route('get.complaint_form')->withFlashGood('Complaint was submitted');
	}

	public function getFileDispute($report_id = null) {
		if(empty($report_id)) return Redirect::route('users.myvideos')->withFlashBad('Invalid Link. Please try again.'); 
		$report_id = Crypt::decrypt($report_id);
		$reports = Report::where(array('id'=>$report_id, 'status'=> '1'))->get();
		
		if(empty($reports))return Redirect::route('users.myvideos')->withFlashBad('Invalid video url. Please try again.');

		$report = $this->Report->getReports($sort = null, $report_id);
		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();
		$allcountries = $this->Country->getAllCountries();
		return View::make('reports.filedispute', compact('categories','notifications', 'allcountries', 'report'));
	}

	public function getListOfReportsPerVideos($video_id = null) {
		if(empty($video_id)) return Redirect::route('users.myvideos')->withFlashBad('Invalid Link. Please try again.'); 
		$video_id = Crypt::decrypt($video_id);

		$reports = $this->Report->getReportPerVideo($video_id);

		if(count($reports) == 0) return Redirect::route('users.myvideos')->withFlashBad('Invalid video url. Please try again.');
		
		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();
		$allcountries = $this->Country->getAllCountries();
		return View::make('reports.usersListReport', compact('categories','notifications', 'allcountries', 'reports'));
	}

	public function addDispute() {
		$input = Input::all();
		$report_id = Crypt::decrypt(Input::get('report_id'));
		$user_id = Crypt::decrypt(Input::get('user_id'));

		$validate = Validator::make($input, Report::$disputeRules);
		if(!$validate->passes()){
			return Redirect::route('get.filedispute', Input::get('report_id'))->withFlashBad('Please check your inputs')->withInput()->withErrors($validate);
		}

		$uploader_info = User::find($user_id);
		$report = Report::find($report_id)->first();

		$newReport = $this->Dispute->createDispute($input, $report_id, $uploader_info->id);

		return Redirect::route('users.myvideos')->withFlashGood('Dispute was submitted');
	}
	public function getMyReports() { 
		if(!Auth::check()) return Redirect::route('homes.post.signin')->withFlashBad('Please Sign-in to view your reports');
		
		$reports = $this->Report->getMyReport(Auth::User()->id);

		$categories = $this->Video->getCategory();
		$notifications = $this->Notification->getNotificationForSideBar();
		$allcountries = $this->Country->getAllCountries();
		return View::make('reports.myreports', compact('categories','notifications', 'allcountries', 'reports'));
	}
	public function deleteReport() {
		$reportid = Crypt::decrypt(Input::get('reportid'));
		$userId = Crypt::decrypt(Input::get('userid'));
		$deleteComment = DB::table('reports')->where(array('id' => $reportid, 'complainant_id' => $userId))->delete();
		if($deleteComment) {
			return Redirect::route('get.myreports')->withFlashGood('Successfully deleted the report.');
		} 
		return Redirect::route('get.myreports')->withFlashbad("Error. Please try again.");
	}
}
