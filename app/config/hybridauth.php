<?php
return array(	
	"base_url"   => "http://localhost:8000/social/auth",
	"providers"  => array (
		"Google"     => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "ID", "secret" => "SECRET" ),
			),
		"Facebook"   => array (
			"enabled"    => true,
			"keys"       => array ( "id" => "ID", "secret" => "SECRET" ),
			),
		"Twitter"    => array (
			"enabled"    => true,
			"keys"       => array ( "key" => "ID", "secret" => "SECRET" )
			),
		"Instagram"  => array (
			"enabled"	 => true,
			"keys" 		 => array ( "id" => "ID", "secret" => "SECRET" )
			),
	),
);