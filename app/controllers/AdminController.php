<?php

class AdminController extends BaseController {
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

	public function getCreateAdminLink(){ return View::make('admins.createadminlink'); }
	public function getChangePassword(){ return View::make('admins.changepassword'); }

	public function getIndex() {
		if(isset(Auth::User()->role)){
			if(Auth::User()->role == 2) return View::make('admins.index');
		}
		return View::make('admins.login');
	}

	public function postIndex(){
		$input = Input::all();
		$validate = Validator::make($input, array('channel_name' => 'required','password' => 'required'));
		if($validate->fails()) return Redirect::route('admin.index')->withInput()->withErrors($validate);
		$attempt = Admin::getAuthLogin($input['channel_name'], $input['password']);
		if($attempt){
			$verified = Auth::User()->verified;
			$status  = Auth::User()->status;
			$role  = Auth::User()->role;
			Admin::getAuthLoginStatus($verified, $status, $role); //IF STATUS
			return Redirect::intended('gsc-admin/');
		}
		return Redirect::route('admin.index')->withInput()->withFlashBad('Invalid Credentials!');
	}	

	public function logout(){
		Auth::logout();
		Session::flush();
		return Redirect::route('admin.index');
	}

	public function getResetPassword(){
		return View::make('admins.resetpassword');
	}

	public function postResetPassword(){
		$validate = Validator::make(Input::all(), array('email' => 'required|email'));
		if($validate->fails()) {
		 	return Redirect::route('get.admin.resetpassword')->withErrors($validate)->withInput();
		}
		$adminInfo = User::where('email', Input::get('email'))->first();
		if(!isset($adminInfo)) return Redirect::route('get.admin.resetpassword')->withInput()->withFlashBad('Invalid email address. Please try again!');
		if(Admin::sendResetPasswordMail($adminInfo)) return Redirect::route('admin.index')->withFlashGood('Done! Please check your email.');
	}

	public function getPwdReset($token){
		if(!isset($token)) return Redirect::route('admin.index')->withFlashBad('Invalid URL. please try to reset your password again!');
		$adminInfo = User::where('token', $token)->first();
		if(isset($adminInfo)) return View::make('admins.pwdreset', compact('adminInfo'));
		return Redirect::route('get.admin.resetpassword')->withFlashBad('Invalid URL. please try to reset your password again!'); //else
	}

	public function postPwdReset(){
		$input = Input::all();
		$validate = Validator::make($input, Admin::$pwdResetValidator);
		if($validate->fails()) return Redirect::route('get.admin.pwdreset')->withInput()->withErrors($validate);
		User::where('id', $input['user_id'])->update(['password' => Hash::make(Input::get('password'))]);
		return Redirect::route('admin.index')->withFlashGood('Password successfully changed!');
	}

	public function postChangePassword(){
		$input = Input::all();
		$validate = Validator::make($input, Admin::$changepassword);
		if($validate->fails()) return Redirect::route('get.admin.changepassword')->withInput()->withErrors($validate);
		$user = User::where('id', Auth::User()->id)->first();
		$hashCheck = Admin::hashCheckPassword($input['current_password'], $user->password, Auth::User()->id, $input['password']);
		if($hashCheck) return Redirect::route('admin.index')->withFlashGood('Password successfully changed!');
		return Redirect::route('get.admin.changepassword')->withInput()->withFlashBad('Incorrect current password. Please try again.');
	}

	public function getRecommendedVideos(){
		$videos = Video::where('publish', 1)->get();
		return View::make('admins.recommendedvideos', compact('videos'));
	}
	public function postRecommendedVideos(){
		$input = Input::all();
		$recommendedCounts = count($input['recommended']);
		if($recommendedCounts > 6){
			return View::make('admins.recommendedvideos')->withFlashBad('Up to 6 videos only. Please try again.');
		}
		DB::table('videos')->update(array('recommended' => 0));
		foreach($input['recommended'] as $recommendedVideos){
			DB::table('videos')->where('id', $recommendedVideos)->update(array('recommended' => 1));
		}
		return Redirect::route('get.admin.recommendedvideos')->withInput()->withFlashGood('Successfully updated!');
	}

	public function postCreateAdminLink(){
		$validate = Validator::make(Input::all(), array('email' => 'required|email|unique:users,email'));
		if($validate->fails()) {
		 	return Redirect::route('get.admin.createadminlink')->withErrors($validate)->withInput();
		}
		$encrypt = Crypt::encrypt(Input::get('email') . rand(1,9999));
		$data = array('code' => $encrypt, 'email' => Input::get('email'));
		$id = DB::table('users_code')->insert(array('code' => $data['code'], 'email' => $data['email'], 'used' => 0));
		if(Admin::sendCreateAdminLink($data)) return Redirect::route('admin.index')->withFlashGood('Done! Please check your email.');
	}
	public function getAdminSignup($code){
		if(!isset($code)) return Redirect::route('admin.index')->withFlashBad('Invalid URL. please try again!');
		$userCode = DB::table('users_code')->where('code', $code)->first();
		if(!isset($userCode)) return Redirect::route('admin.index')->withFlashBad('Invalid link. Please contact the TEFLTV administrator.');
		if($userCode->used == 1) return Redirect::route('admin.index')->withFlashBad('The registration link is already used.');
		if(isset($userCode)) return View::make('admins.adminsignup', compact('userCode'));
	}
	public function postAdminSignup(){
		$input = Input::all();
		$validate = Validator::make($input, array('username' => 'required|unique:users,channel_name', 'password' => 'required|confirmed|min:6','password_confirmation' => 'required'));
		if($validate->fails()) return Redirect::route('get.admin.adminsignup')->withInput()->withErrors($validate);
		DB::table('users')->insert(array('email' => $input['email'], 'channel_name' => $input['username'], 'password' => Hash::make($input['password']), 'role' => 2));
		DB::table('users_code')->where('code', $input['code'])->update(array('used' => 1));
		return Redirect::route('admin.index')->withInput()->withFlashGood('Successfully registered!');
	}

	public function getReportedVideos(){
		$videos = Video::where('report_count', '>=', 5)->get();
		return View::make('admins.reportedvideos', compact('videos'));
	}

	public function getUsers(){
		$users = User::all();
		return View::make('admins.users', compact('users'));
	}

	public function postDeleteUser($id){
		$id = Crypt::decrypt($id);
		$user = User::find($id);
		$user->delete();

		return Redirect::route('get.admin.users')->withFlashGood('Successfully deleted the user.');
	}
	public function getReports(){
		$reports = $this->Report->getReports('active');
		return View::make('admins.reports', compact('reports'));
	}

	public function getSortReports($sort = NULL){
		if(!isset($sort)) $sort = 'all';
		$reports = $this->Report->getReports($sort);
		if(!$reports) return Redirect::route('admin.index')->withFlashBad('Invalid link. Please try again.');
		return View::make('admins.reports', compact('reports'));
	}

	public function postDeleteReport($id){
		$id = Crypt::decrypt($id);
		$report = Report::find($id);
		$report->deleted_at = date('Y-m-d H:i:s');
		$report->save();
		return Redirect::route('get.admin.reports')->withFlashGood('Successfully deleted the report.');
	}
	
	public function viewReports($id){
		if(!isset($id)) return Redirect::route('admin.index')->withFlashBad('Invalid URL. please try again!');
		$report = DB::table('reports')->where('id', $id)->first();
		if(!isset($report->id)) return Redirect::route('admin.index')->withFlashBad('Invalid link. Please try again.');
		return View::make('admins.viewreports', compact('report'));
	}
}
