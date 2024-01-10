<?php

namespace App\Http\Controllers\frontend;

use App\Models\Price;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index')->with('services', Price::all());
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
        return view('frontend.gallery.index');

    }

    public function team()
    {
        return view('frontend.team.index');
    }

    public function price()
    {
        return view('frontend.price.index')->with('services', Price::all());
    }

    public function service()
    {
        return view('frontend.service.index');
    }


    public function logout()
    {
        Auth::logout();
        return view('frontend.index')->with('services', Price::all());
    }
}

