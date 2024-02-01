<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logout()
    {
        Auth:: logout();
        session()->put('logout','You Are Logout');
        return redirect(route('admin.sign_in'));
    }

    public function signIn()
    {
        return view('Backend.login_page.sign_in');
    }

    public function signUp()
    {
        return view('Backend.login_page.sign_up');
    }

    public function forgot()
    {
        return view('Backend.login_page.forgot-password');
    }


}
