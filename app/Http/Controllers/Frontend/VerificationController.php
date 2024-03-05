<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('home') : view('Frontend.sign_in.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()
            ->withSuccess('A fresh verification link has been sent to your email address.');
    }

}
