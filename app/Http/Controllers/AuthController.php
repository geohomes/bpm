<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use App\Mail\{EmailVerification, OtpLink};
use Illuminate\Support\Facades\DB;
use App\Models\{User, Verify};
use App\Helpers\Sms;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;
use Exception;
use Cookie;
use Route;


class AuthController extends Controller
{

    /**
     * Singup view Page
     * 
     * @return view
     */
    public function signup()
    {
        return view('frontend.signup.index')->with(['title' => 'Signup | Best Property Market']);
    }

    /**
     * Login View
     * 
     * @return void
     */
    public function login()
    {
        return view('frontend.login.index')->with(['title' => 'Login | Best Property Market']);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();

        foreach(request()->cookie() as $name => $value) {
            Cookie::queue(Cookie::forget($name));
        }

        $redirect = request()->query('redirect');
        return Route::has($redirect) ? redirect()->route($redirect) : redirect()->route('login');
    }


}
