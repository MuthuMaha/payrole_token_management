<?php 
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller
{
	public function tokenAuthCheck (Request $request) {
		return [
			'success' => ['Your LoginID'=>Auth::check() ? Auth::id() : -9999],
		];

		
	} 

	public function tokenAuthUser (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::user()->name,
		];
	}

	public function tokenAuthId (Request $request) {
		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthAttempt (Request $request) {
		$msg="This is old token";
		Auth::attempt([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);
if(Auth::id()){
	$token=Token::whereUser_id(Auth::id())->pluck('access_token');

	// $expiry=Token::where('access_token',$token)->first();
	$client = User::find(Auth::id());
        $uc=$client->tokens()->where('created_at', '<', Carbon::now()->subDay())->delete();
   if($uc){
   	$msg='Token expired and New Token generated';
   }
if (!$token->count()) {
	$str=str_random(10);
	$token=Token::create([
		'user_id'=>Auth::id(),
		'expiry_time'=>'1',
        'access_token' => Hash::make($str),
	]);
	return [
			'success' => ['token'=>$token->access_token],
			'Message'=>$msg,
		];
 
}
	return [
			'success' => ['token'=>$token],
			'Message'=>$msg,
		];
}
else{
	return [
			'error' => ['message'=>'email or password incorrect'],
		];
}
		
	}

	public function tokenAuthOnce (Request $request) {
		Auth::once([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthLogin (Request $request) {
		Auth::login(User::find($request->get('id')));
	}

	public function tokenAuthLoginUsingId (Request $request) {
		Auth::loginUsingId($request->get('id'));

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthLogout (Request $request) {
		Auth::logout();

		return [
			'request' => $request->get('id'),
			'auth'    => Auth::id(),
		];
	}

	public function tokenAuthValidate (Request $request) {
		$isValidated = Auth::validate([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);

		return [
			'request' => $request->get('id'),
			'auth'    => $isValidated ? $request->get('id') : -8998,
		];
	}


	// public function apiAuthCheck (Request $request) {
	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::check() ? Auth::id() : -9999,
	// 	];
	// }

	// public function apiAuthUser (Request $request) {
	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::user()->id,
	// 	];
	// }

	// public function apiAuthId (Request $request) {
	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::id(),
	// 	];
	// }

	// public function apiAuthAttempt (Request $request) {
	// 	Auth::attempt([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);

	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::id(),
	// 	];
	// }

	// public function apiAuthOnce (Request $request) {
	// 	Auth::once([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);

	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::id(),
	// 	];
	// }

	// public function apiAuthLogin (Request $request) {
	// 	Auth::login(User::find($request->get('id')));
	// }

	// public function apiAuthLoginUsingId (Request $request) {
	// 	Auth::loginUsingId($request->get('id'));

	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::id(),
	// 	];
	// }

	// public function apiAuthLogout (Request $request) {
	// 	Auth::logout();

	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => Auth::id(),
	// 	];
	// }

	// public function apiAuthValidate (Request $request) {
	// 	$isValidated = Auth::validate([ 'payrole_id' => $request->get('payrole_id'), 'password' => $request->get('password') ]);

	// 	return [
	// 		'request' => $request->get('id'),
	// 		'auth'    => $isValidated ? $request->get('id') : -8998,
	// 	];
	// }
}
