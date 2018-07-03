<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use App\Usersrole;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    // return redirect()->route( 'clients.show' )->with( [ 'id' => $id ] );

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { if(\Auth::user()){
         \App\Http\Controllers\Auth\LoginController::call();
    }
       
        $this->middleware('guest')->except('logout');
    }
    public function call(){
        $product = Usersrole::where('user_id',\Auth::user()->id)->get();

// foreach ($user as $role) {
//     echo $role->pivot->created_at;
// }
        Session::push('cart', $product);
    }
}
