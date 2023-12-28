<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function logout()
    {
        Auth::logout();
        return view('index');
    }
}

