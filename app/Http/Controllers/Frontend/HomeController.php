<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gallery;
use App\Models\Price;
use App\Models\Service;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('Frontend.index')->with('services', Service::all());
    }

    public function register()
    {
        return view('Frontend.sign_in.register');
    }

    public function login()
    {
        return view('Frontend.sign_in.login');
    }

    public function forgot()
    {
        return view('Frontend.sign_in.forgetPassword');
    }

    public function gallery()
    {
        return view('Frontend.gallery.index')->with('galleries', Gallery::all());
    }

    public function terms()
    {
        return view('Frontend.terms_policy.index');
    }

    public function privacy()
    {
        return view('Frontend.terms_policy.privacy');
    }

    public function team()
    {
        return view('Frontend.team.index');
    }

    public function price()
    {
        return view('Frontend.price.index')->with('services', Service::all());
    }

    public function service()
    {
        return view('Frontend.service.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->put('logout', 'you are successfully logged out');
        return redirect()->route('home')->with('services', Price::all())->withSuccess('You have logged out successfully!');
    }
    public function setLocale(Request $request)
    {
        $locale = $request->input('locale', 'en');
        App::setLocale($locale);

        $existingSetting = SettingsModel::where('setting_key', 'language')->first();

        if ($existingSetting)
        {
            $existingSetting->update(['setting_value' => $locale]);
        }
        else
        {
            SettingsModel::create([
                'setting_key'   => 'language',
                'setting_value' => $locale,
            ]);
        }
        return response()->json(['success' => true]);
    }
}
