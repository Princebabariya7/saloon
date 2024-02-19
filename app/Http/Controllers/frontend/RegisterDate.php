<?php

namespace App\Http\Controllers\frontend;

use App\Http\Requests\frontend\ForgotRequest;
use App\Http\Requests\frontend\LoginRequest;
use App\Http\Requests\frontend\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterDate extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'home'
        ]);
        $this->middleware('auth')->only('logout', 'home');
        $this->middleware('verified')->only('home');
    }
    public function store(RegisterRequest $request)
    {
        try
        {
            $user= User::create([
                'firstname'   => $request->firstname,
                'lastname'    => $request->lastname,
                'email'       => $request->email,
                'mobile'      => $request->number,
                'password'    => Hash::make($request->password),
                'gender'      => $request->gender == 'male' ? 'm' : 'f',
                'dob'         => Carbon::create($request->date)->format('Y-m-d'),
                'address'     => $request->address,
                'city'        => $request->city,
                'zipcode'     => $request->zipcode,
                'state'       => $request->state,
                'user_status' => 'user',
                'updated_at'  => now(),
                'created_at'  => now(),
            ]);
            event(new Registered($user));

            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            $request->session()->regenerate();
            session()->put('registerMsg', 'you are successfully registered');
            return redirect(route('verification.notice'));
        }
        catch (\Exception $e)
        {
            session()->put('duplicateMsg', 'This Email Address Is Already Registered');

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
                if (auth()->user()->user_status == "User")
                {
                    session()->put('msg', 'You Are Logged in');
                    return redirect()->route('home');
                }
                elseif (auth()->user()->user_status == "Admin")
                {
                    session()->put('msg', 'You Are Logged in');
                    return redirect()->route('dashboard.index');
                }
            }
            else
            {
                session()->put('wrongPass', 'please check your email and password ');
                return redirect()->back();
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }
    public function forgot(ForgotRequest $request)
    {
        try
        {
            $user           = User::whereEmail($request->email)->first();
            $user->password = Hash::make($request->input('password'));
            $user->update();
            session()->put('msg', 'your password has been changed');
            return view('frontend.sign_in.login');
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
