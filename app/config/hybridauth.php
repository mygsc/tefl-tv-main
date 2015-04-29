<?php
return array(	
	"base_url"   => URL::route('hybridauth', array('action' => 'auth')),
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "860041923825-g26te56kqb475cjn6nsos2n8e54it3sc.apps.googleusercontent.com", "secret" => "rFFz4b55dClMryWsiHjPN1MW" ),
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "834644693287300", "secret" => "6e8c4d4676a238164d860c2a36fda5da" ),
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
);