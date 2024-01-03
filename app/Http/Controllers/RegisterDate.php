<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Register;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterDate extends Controller
{
    public function index()
    {
        $register = Register::all();
        return view('sign_in.index', compact('register'));
    }
    public function store(RegisterRequest $request)
    {
        try
        {
            User::create([
                'firstname'  => $request->firstname,
                'lastname'   => $request->lastname,
                'email'      => $request->email,
                'mobile'     => $request->number,
                'password'   => Hash::make($request->password),
                'gender'     => $request->gender == 'male' ? 'm' : 'f',
                'dob'        => Carbon::create($request->date)->format('Y-m-d'),
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            return view('sign_in.login')->withSuccess('IT WORKS!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try
        {
            $credit = $request->only('email', 'password');
            if (Auth::attempt($credit))
            {
                session()->put('msg','your are login');
                return redirect()->route('home');
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

    public function forgot(ForgotRequest $request)
    {
        try
        {
            $user           = User::whereEmail($request->email)->first();
            $user->password = Hash::make($request->input('password'));
            $user->update();
            session()->put('msg','your password has been changed');
            return view('sign_in.login');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
