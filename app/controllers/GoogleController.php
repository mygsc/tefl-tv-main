<?php
use Google\Service\Oauth2;

class GoogleController extends Controller {

	public function __construct(User $users){
		$this->User = $users;
	}

	public function getGoogleConnect(){
		$state = md5(rand());
		$client = new Google_Client();
		$client->setClientId(Config::get('google.client_id'));
		$client->setClientSecret(Config::get('google.client_secret'));
		$client->setRedirectUri(Config::get('google.redirect_uri'));
		$client->addScope('https://www.googleapis.com/auth/userinfo.email');
		$client->setState($state);

		if(Session::has('google_access_token')){
			$google_access_token  = Session::get('google_access_token');
			$decode_google_access_token = (json_decode($google_access_token));
			$access_token = $decode_google_access_token->access_token;
			$user_information = 'https://www.googleapis.com/oauth2/v1/userinfo?access_token='.$access_token;

			if(Session::get('action') == 'signin'){
				$user = $this->signin($user_information);
			} elseif(Session::get('action') == 'signup'){
				$user = $this->signup($user_information);
				$finduser = User::where('email', $user->email)->get();
				if(!$finduser->isEmpty()){
					return Redirect::route('homes.signin')->withFlashBad('Your google email was already used to register');
				}
			} else{
				$user = false;
			}
			if($user === false){
				return Redirect::route('homes.signin')->withFlashBad('Your social media account was not associated to any TEFL TV account');	
			}

			$this->signout($access_token);

			if(Session::get('action') == 'signin'){	
				return Redirect::route('homes.index')->withFlashGood('Welcome '. $user->channel_name);
			}
			return Redirect::route('homes.signupwithsocialmedia')->with(
			array('social_media' => $user->social_media,
				'first_name' => $user->given_name,
				'last_name' => $user->family_name,
				'email' => $user->email,
				'social_media_id' => $user->id
				)
			);
		}

		if(Input::has('code')){
			$client->authenticate(Input::get('code'));
			Session::flash('google_access_token', $client->getAccessToken());
			return Redirect::route('homes.googleconnect');
		}

		if(! Session::has('state')){
			$googleSigninURL = $client->createAuthUrl();
			Session::put('action', Input::get('action'));
			Session::flash('state', $state);
			return Redirect::to($googleSigninURL);
		}

		if(! $client->getAccessToken() && ! Session::has('token')){
			Session::flush();
			return Redirect::route('homes.signin')->withFlashBad('Google authorization was denied');
		}

	}

	public function googlelogout(){
		$client = $this->generateGoogleClient();
		$client->getLogout();
		return Redirect::route('homes.signin')->withFlashGood('You we\'re logout');
	}

	public function signin($user_information){
		$user_information = file_get_contents($user_information);
		$user_information = json_decode($user_information);
		$google_id = $user_information->id;
		$user = $this->User->signInWithSocialMedia($google_id);
		return $user;
	}

	public function signup($user_information){
		$user_information = file_get_contents($user_information);
		$user = json_decode($user_information);
		$user->social_media = 'google';
		return $user;
	}

	public function signout($access_token){
		file_get_contents('https://accounts.google.com/o/oauth2/revoke?token='. $access_token);
		return true;
	}
}
