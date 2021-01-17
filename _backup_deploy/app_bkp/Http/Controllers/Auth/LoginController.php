<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logOut', 'logOutAdmin']]);
    }

    /**
     * @return mixed
     */
    public function logOut()
    {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * @return mixed
     */
    public function login(){
        return View::make('auth.login');
    }


    /**
     * @return mixed
     */
    public function logOutAdmin()
    {
        Auth::logout();
        return Redirect::to(Config::get('app.admin_directory'));
    }

    /**
     * @return mixed
     */
    public function loginAdmin(){
        return View::make('auth.loginAdmin');
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return mixed
     */
    public function authCheck(Request $request, Guard $auth)
    {
        if ($auth->attempt(['user_name' => $request->input('user'), 'password' => $request->input('password')])) {
            $authUser = Auth::user();
            $roles    = $this->getRequiredRoleForRoute($request->route());
            if ($request->user()->hasRole($roles) || !$roles) {
                if ($authUser->role_id == 4) {
                    $response['data']['status'] = true;
                    return response(json_encode($response));
                }
                return redirect(Config::get('app.admin_directory') . '/dashboard')->with('message_success',
                    trans('custom.log_in_correct'));
            } else {
                return redirect('home')->withErrors('');
            }
        }
        if (strpos($request->url(), 'FmCBYkve51') !== false) {
            return redirect()->back()->withErrors(trans('custom.wrong_user_pass'));
        }else{
            $response['data']['status'] = false;
            $response['data']['message']['errors'] = trans('custom.wrong_user_pass');
            return response(json_encode($response));
        }
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return mixed
     */
    public function authCheckFront(Request $request, Guard $auth)
    {
        if ($auth->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $authUser = Auth::user();
            $roles    = $this->getRequiredRoleForRoute($request->route());
            if ($request->user()->hasRole($roles) || !$roles) {
                if ($authUser->role_id == 4) {
                    $response['data']['status'] = true;
                    return response(json_encode($response));
                }
                return redirect(Config::get('app.admin_directory') . '/dashboard')->with('message_success',
                    trans('custom.log_in_correct'));
            } else {
                return redirect('home')->withErrors('');
            }
        }
        if (strpos($request->url(), 'FmCBYkve51') !== false) {
            return redirect()->back()->withErrors(trans('custom.wrong_user_pass'));
        }else{
            $response['data']['status'] = false;
            $response['data']['message']['errors'] = trans('custom.wrong_user_pass');
            return response(json_encode($response));
        }
    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();

        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
