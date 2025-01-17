<?php

return array(
	
	/*
	|--------------------------------------------------------------------------
	| Auth Username
	|--------------------------------------------------------------------------
	|
	| Indicates whether the usernames will be used.
	| For just a basic login system you may want to disable this.
	|
	*/

	'require_username' => true,
	
	/*
	|--------------------------------------------------------------------------
	| Allow Username Changing
	|--------------------------------------------------------------------------
	|
	| Indicates whether if the users can change their the usernames.
	|
	*/

	'username_change'  => true,

	/*
	|--------------------------------------------------------------------------
	| Allow Account Deletion
	|--------------------------------------------------------------------------
	|
	| Indicates whether if the users can delete their accounts.
	|
	*/
	
	'delete_account' => true,

	/*
	|--------------------------------------------------------------------------
	| Send Activation Email
	|--------------------------------------------------------------------------
	|
	| If enabled when a user creates an accout an email with the activation
	| link will be sent. If disabled the account will be activated by default.
	|
	*/

	'email_activation' => true,

	/*
	|--------------------------------------------------------------------------
	| Default Role 
	|--------------------------------------------------------------------------
	|
	| This is the ID of the default role to be used when someone signs up.
	|
	*/

	'default_role_id' => 2,

	/*
	|--------------------------------------------------------------------------
	| CAPTCHA 
	|--------------------------------------------------------------------------
	|
	| Indicates whether CAPTCHA should be used.
	| If enabled you have to set the api keys in services.php.
	|
	*/

	'captcha' => true,

	/*
	|--------------------------------------------------------------------------
	| Login Redirect URL
	|--------------------------------------------------------------------------
	|
	| The url to where the users should be redirected after login.
	| If not set the page will reload.
	|
	*/

	'login_redirect' => '',

	/*
	|--------------------------------------------------------------------------
	| OAuth Service Providers
	|--------------------------------------------------------------------------
	|
	| The available services that users can use to log in or sign up.
	| For each one enabled you have to define the api keys in services.php.
	|
	*/

	'providers' => array(
		//'facebook' => 'Facebook', 
		//'google'   => 'Google', 
		// 'twitter'  => 'Twitter', 
		// 'linkedin' => 'LinkedIn',
		// 'microsoft' => 'Microsoft',
		// 'instagram' => 'Instagram',
		// 'github' => 'GitHub',
		// 'yammer' => 'Yammer',
		// 'foursquare' => 'Foursquare',
		// 'soundcloud' => 'SoundCloud',
		// 'vkontakte' => 'VK'
	),
);