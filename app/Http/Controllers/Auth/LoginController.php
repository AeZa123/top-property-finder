<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function authenticated(Request $request, $user)
    {

        // dd($user);
        // ตรวจสอบบทบาทของผู้ใช้
        if ($user->role == '1') {
            // ถ้าเป็นบทบาท 'admin' ให้ redirect ไปที่ URL สำหรับ admin
            // echo 'admin';
            return redirect('/dashboard');
        } elseif ($user->role == '2') {
            // ถ้าเป็นบทบาท 'user' ให้ redirect ไปที่ URL สำหรับ user
            return redirect('/dashboard');
        } else {
            // ถ้าไม่มีบทบาทหรือบทบาทอื่น ๆ ที่คุณต้องการจัดการ
            return redirect($this->redirectTo);
        }
    }







}
