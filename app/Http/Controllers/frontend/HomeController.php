<?php

namespace App\Http\Controllers\frontend;

use App\Models\Gallery;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index')->with('services', Service::all());
    }

    public function register()
    {
        return view('frontend.sign_in.register');
    }

    public function login()
    {
        return view('frontend.sign_in.login');
    }

    public function forgot()
    {
        return view('frontend.sign_in.forgot');
    }

    public function gallery()
    {
        return view('frontend.gallery.index')->with('galleries', Gallery::all());

    }

    public function team()
    {
        return view('frontend.team.index');
    }

    public function price()
    {
        return view('frontend.price.index')->with('services', Service::all());
    }

    public function service()
    {
        return view('frontend.service.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->put('logout', 'you are successfully logged out');
        return redirect()->route('home')->with('services', Price::all())->withSuccess('You have logged out successfully!');
    }
}

