<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request){
    if( ! Request::secure()){
        return Redirect::secure(Request::path());
    }
    /* kahit ano siguro dito
	if(!Request::secure() && array_get($_SERVER, 'SERVER_PORT') != 443){
        return Redirect::secure(Request::path());
    }
    */
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function(){
	if (Auth::guest()){
		if (Request::ajax()){
			return Response::make('Unauthorized', 401);
		}
		else{
			return Redirect::guest('signin');
		}
	}
});

Route::filter('auth.basic', function(){
	return Auth::basic();
});

Route::filter('auth.admin', function(){
    if (!Auth::check()){
    	if(isset(Auth::User()->role)){
    		if(Auth::User()->role != 2){
	    		return View::make('admins.login');
	    	}
	    	return View::make('admins.login');
    	}
    	return View::make('admins.login');
    }
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| Custom Filter
|--------------------------------------------------------------------------
|
| Custom filter made by the team
| 
| 
|
*/

Route::filter('partners', function()
{
	if(!Auth::check()){
		return Redirect::route('homes.signin')->withFlashWarning('Please sign in to proceed');
	}
	
});

Route::filter('partnerships.verification', function()
	{
	if(!Session::has('partnership_token')){
		return Redirect::route('partnerships.verification');
	}
	
});
