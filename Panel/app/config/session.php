<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Session Driver
	|--------------------------------------------------------------------------
	|
	| Supported: "native", "file", "database"
	|
	*/
	
	'driver' => 'native',

	/*
	|--------------------------------------------------------------------------
	| Session Lifetime
	|--------------------------------------------------------------------------
	|
	| Here you may specify the number of minutes that you wish the session
	| to be allowed to remain idle before it expires.
	|
	*/

	'lifetime' => 120,

	/*
	|--------------------------------------------------------------------------
	| Session File Location
	|--------------------------------------------------------------------------
	*/

	'files' => storage_path().'/sessions2',
	
	/*
	|--------------------------------------------------------------------------
	| Session Database Table
	|--------------------------------------------------------------------------
	*/

	'table' => 'sessions',

	/*
	|--------------------------------------------------------------------------
	| Session Cookie Name
	|--------------------------------------------------------------------------
	*/

	'cookie' => 'easylogin_Mapps',
	
	/*
	|--------------------------------------------------------------------------
	| Default Cookie Path
	|--------------------------------------------------------------------------
	*/

	'path' => '/',

	/*
	|--------------------------------------------------------------------------
	| Default Cookie Domain
	|--------------------------------------------------------------------------
	*/

	'domain' => 'http://localhost/eccbio/',
);
