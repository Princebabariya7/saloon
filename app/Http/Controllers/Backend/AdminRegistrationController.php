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
        $search = $request->input('search', '');
        $status = $request->input('status', '');
        $users  = User::search($search)->status($status)->sortable()->paginate(5);

        return view('Backend.user.index')
            ->with('users', $users);
    }

    public function store(SignUpRequest $request)
    {
        try
        {
            User::create([
                'firstname'   => $request->firstname,
                'lastname'    => $request->lastname,
                'email'       => $request->email,
                'password'    => Hash::make($request->password),
                'user_status' => 'admin',
                'updated_at'  => now(),
                'created_at'  => now(),
            ]);
            session()->put('msg', 'You are Registered');
            return redirect(route('admin.sign_in'));
        }
        catch (\Exception $e)
        {
            session()->put('duplicateMsg', 'This Email Address Is Already Registered');
            return redirect()->back()->with('error', $e->getMessage());
        }
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

    public function destroy($id)
    {
        try
        {
            $user = User::find($id);
            if ($user)
            {
                $user->delete();
                $user->appointment()->delete();
                $user->appointments()->delete();
            }
            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }
}
