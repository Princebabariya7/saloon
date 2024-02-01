<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\ForgotPasswordRequest;
use App\Http\Requests\Backend\SignInRequest;
use App\Http\Requests\Backend\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search', '');
        $status     = $request->input('status', '');
        $users = User::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('firstname', 'LIKE', '%' . $search . '%');
            });

        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->paginate(5);
        return view('Backend.user.index')->with('users', $users);
    }

    public function store(SignUpRequest $request)
    {

        User::create([
            'firstname'  => $request->firstname,
            'lastname'   => $request->lastname,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'user_status'   => 'admin',
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
                session()->put('wrongPass', 'Please Check Your Email And Password ');
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

    public function show($id)
    {
        $user = User::find($id);

        return view('Backend.user.show', ['user' => $user]);
    }

}
