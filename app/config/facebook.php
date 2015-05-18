<?php
return array(

	/**
	*App ID can be found in developers.facebook.com under TEFL TV apps settings.
	*
	*NOTE: My(I Kevin C. Cabrera add me if necessary :D) account was the administrator of the apps please contact me if you want to change something
	*/

	'AppID' => '1557901494477250', 

	/**
	*
	* This portion can also be found same as where AppID is located
	*
	*
	*/

	'AppSecret' => 'fb815e7545c8ee580a210395e514362a',

	/**
	*
	* This section is where you wanted to redirect the user after authenticating
	*
	*/

	'LogInRedirectURL' => route('homes.authorizefacebook')

	);
?>