<?php

require_once 'app/init.php';



if (isset($_GET['logout'])) {
	Auth::logout();
	redirect_to( App::url('user.php') );
}

if (Auth::guest()) { 
	echo View::make('user.login')->render();
	exit; 
}



$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

if (View::exists("user.{$page}")) {
	echo View::make('user.'.$page)->render();
} else {
	echo View::make('user.404')->render();
}

function page_restricted() {
	redirect_to('?page=restricted');
	exit;
}