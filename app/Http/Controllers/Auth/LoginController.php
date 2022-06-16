<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\misc\finyear;

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
    protected $redirectTo = RouteServiceProvider::HOME;


    public function username()
    {
        return 'username'; //or return the field which you want to use.
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {

        // $finyr = finyear::where('status', 1)->get();
        $finyr = finyear::get();
        return view('auth.login', compact('finyr'));
        // return view('auth.login');
    }


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request,  $user) {
        config(['session.lifetime' => 525600]);
        request()->session()->put('finyr', request("finyear"));


        // session()->put("finyr", $request->finyr);
        // $user->financial_year = $request->finyear;
        // $user->save();
       if($user->role == "admin"){
            // dd("Hello");
            return redirect(route("admin.index"));
       }
        if ($user->role == "user") {
            //dd("Users");
            return redirect(route("user.index"));
        }

    }

}
