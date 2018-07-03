<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('login', 'API\PassportController@login');

// Route::post('register', 'API\PassportController@register');

// Route::prefix("/get")->middleware(['auth:api'])->group(function(){

// Route::post('get-details', 'API\PassportController@getDetails');

// });

// Route::prefix("/check")->middleware(['auth:api'])->group(function(){


// Route::apiResource('/products','ProductController');

// });
// Route::apiResource('/products','ProductController');

Route::group([ 'prefix' => 'token' ], function () {
	Route::post('auth-attempt', 'AuthController@tokenAuthAttempt');
	Route::post('auth-once', 'AuthController@tokenAuthOnce');
	Route::post('auth-login-using-id', 'AuthController@tokenAuthLoginUsingId');
	Route::post('auth-validate', 'AuthController@tokenAuthValidate');

	Route::group([ 'middleware' => 'auth:token' ], function () {
		Route::post('auth-check', 'AuthController@tokenAuthCheck'); 
		Route::post('auth-user', 'AuthController@tokenAuthUser');
		Route::post('auth-id', 'AuthController@tokenAuthId');
		Route::post('auth-login', 'AuthController@tokenAuthLogin');
		Route::post('auth-logout', 'AuthController@tokenAuthLogout');
	});
});

