<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('Backend.user.profile');
    }

    public function changePassword(ChangePasswordRequest $request)
    {

        $user = Auth::user();

        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        session()->put('Password', 'Your Password has changed');
        return redirect()->route('dashboard.index');
    }
}
