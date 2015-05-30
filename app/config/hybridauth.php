<?php
return array(	
	"base_url"   => URL::route('hybridauth', array('action' => 'auth')),
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			 "keys"    => array ( "id" => "195870632416-ikscr2lt2c8rcponse0sld4btviiaro4.apps.googleusercontent.com", "secret" => "ftGqSdVQkN10hSaL-nlsBN77" ),
	          // "scope"           => "https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "1557901494477250", "secret" => "fb815e7545c8ee580a210395e514362a" ),
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "A4mIkLn3gdfnQ6Nk0xwmGfuuk", "secret" => "3GjpW1n3XWVCT8Wbg1K1x6eiXZoa2xCmlC6fsitPMZaVeefnJo" )
			),
		"Instagram"  => array (
			"enabled"	 => true,
			"keys" 		 => array ( "id" => "xxxxxxxxxx", "secret" => "xxxxxxxxxxx" )
			),
	),
	"debug_mode" => false,
	// "debug_file" => "debug.log",
);