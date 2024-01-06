<?php

namespace App\Http\Controllers\frontend;

use App\Models\Price;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        return view('index')->with('services', Price::all());
    }

    public function register()
    {
        return view('sign_in.register');
    }

    public function login()
    {
        return view('sign_in.login');
    }

    public function forgot()
    {
        return view('sign_in.forgot');
    }

    public function gallery()
    {
        return view('gallery.index');

    }

    public function team()
    {
        return view('team.index');
    }

    public function price()
    {
        return view('price.index')->with('services', Price::all());
    }

    public function service()
    {
        return view('service.index');
    }


    public function logout()
    {
        Auth::logout();
        return view('index')->with('services', Price::all());
    }
}

