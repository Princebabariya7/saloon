<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        return view('index')->with('services',Price::all());
    }

    public function logout()
    {
        Auth::logout();
        return view('index')->with('services',Price::all());
    }
}

