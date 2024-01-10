<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\ForgotPasswordRequest;
use App\Http\Requests\Backend\SignInRequest;
use App\Http\Requests\Backend\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminRegistrationController extends Controller
{
    public function store(SignUpRequest $request)
    {

        User::create([
            'firstname'  => $request->firstname,
            'lastname'   => $request->lastname,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        session()->put('msg', 'You are Registered');
        return redirect(route('admin.sign_in'));
    }

    public function login(SignInRequest $request)
    {
        $login = $request->only('email', 'password');
        try
        {
            if (Auth::attempt($login))
            {
                session()->put('msg', 'You Are Logged in');
                return redirect()->route('dashboard.index');
            }
            else
            {
                return redirect()->back();
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function forgot(ForgotPasswordRequest $request)
    {

        $user           = User::whereEmail($request->email)->first();
        $user->password = Hash::make($request->input('password'));
        $user->update();

        session()->put('Password', 'Your Password has Changed');
        return redirect(route('admin.sign_in'));

    }

}
