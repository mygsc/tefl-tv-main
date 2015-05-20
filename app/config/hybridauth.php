<?php
return array(	
	"base_url"   => URL::route('hybridauth', array('action' => 'auth')),
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			 "keys"    => array ( "id" => "434751596783-gnklt9ebvmo1dv8ekpkk4boq63af5thr.apps.googleusercontent.com", "secret" => "yIg9k_mUPVN5iXoSmAfjzHk4" ),
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