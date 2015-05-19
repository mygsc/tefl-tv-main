<?php
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphLocation;
FacebookSession::setDefaultApplication(Config::get('facebook.AppID'),Config::get('facebook.AppSecret'));

class LaravelRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper{
	protected function storeState($state){
		Session::put('state', $state);
	}

	protected function loadState(){
		return $this->state = Session::get('state');
	}
}

class FacebookController extends Controller {
	public function __construct(User $users){
		$this->User = $users;
	}

	public function getFacebookConnect(){
		Session::flash('facebook-action', Input::get('action'));
		$helper = new LaravelRedirectLoginHelper(Config::get('facebook.LogInRedirectURL'));
		$loginUrl = $helper->getLoginUrl(array('scope' => 'email'));
		return Redirect::to($loginUrl);
	}
	
	public function getAuthorizeFacebook(){
		$helper = new LaravelRedirectLoginHelper(Config::get('facebook.LogInRedirectURL'));
		try {
			$session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
			return Redirect::route('homes.index')->withFlashWarning('Something went wrong please try again');
		} catch(\Exception $ex) {
			return $e;
			return Redirect::route('homes.signin')->withFlashBad('Facebook Permission was denied');
		}
		if ($session) {
			$response = (new FacebookRequest($session, 'GET', '/me'))->execute();	
			$user = $response->getGraphObject(GraphUser::className());
			$loc = $response->getGraphObject(GraphLocation::className());

			if(Session::get('facebook-action') == 'signin'){
				$user = $this->User->signInWithSocialMedia($user->getId());
				if($user === false){
					return Redirect::route('homes.signin')->withFlashBad('Your social media account was not associated to any TEFL TV account');
				}
				return Redirect::route('homes.index')->withFlashGood('Welcome '. $user->channel_name);
			}
			
			$finduser = User::where('email', $user->getEmail())->get();
			if(!$finduser->isEmpty()){
				return Redirect::route('homes.signin')->withFlashBad('Your facebook email was already used to register');
			}

			if(Session::get('facebook-action') == 'signup'){
				$socialMedia = 'facebook';
				return Redirect::route('homes.signupwithsocialmedia')->with(
					array('social_media' => $socialMedia,
						'first_name' => $user->getFirstName(),
						'last_name' => $user->getLastName(),
						'email' => $user->getEmail(),
						'social_media_id' => $user->getId()
						)
					);
			}

		}
		return Redirect::route('homes.signin')->withFlashBad('Facebook authorization was denied');
	}
}