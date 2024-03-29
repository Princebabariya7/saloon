<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\ForgotRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterDate extends Controller
{
    public function store(RegisterRequest $request)
    {
        try
        {
            $user = [
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
            ];
            User::create($user);
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
            session()->put('registerMsg', 'you are successfully registered');
            return redirect(route('verification.notice'));
        }
        catch (\Exception $e)
        {
            session()->put('duplicateMsg', 'This Email Address Is Already Registered');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials))
        {
            if (auth()->user()->email_verified_at != null)
            {
                if (auth()->user()->user_status == "User")
                {
                    session()->put('msgUser', 'You Are Logged in');
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
                session()->put('email_verified', 'You Are Logged in');
            }
        }
        return back()->withErrors([
            'email' => 'Please Check Your Email And Password And Try Again',
        ])->onlyInput('email');
    }

//    public function forgot(ForgotRequest $request)
//    {
//        try
//        {
//            $user           = User::whereEmail($request->email)->first();
//            $user->password = Hash::make($request->input('password'));
//            $user->update();
//            session()->put('forgot', 'your password has been changed');
//            return view('Frontend.sign_in.login');
//        }
//        catch (\Exception $e)
//        {
//            return redirect()->back()->with('error', $e->getMessage());
//        }
//    }
}
