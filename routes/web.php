<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnlineorderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RegisterDate;
use App\Models\Price;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, 'index'])->name('home');

Route::prefix('home')->group(function ()
{

    Route::get('/profile', function ()
    {
        return view('profile.index');
    });
    Route::get('/service', function ()
    {
        return view('service.index');
    })->name('service');

    Route::get('/price', function ()
    {
        return view('price.index')->with('services',Price::all());
    })->name('price');

    Route::get('/team', function ()
    {
        return view('team.index');
    })->name('team');

    Route::get('/gallery', function ()
    {
        return view('gallery.index');
    })->name('gallery');
});

Route::group(['prefix' => 'appointment', 'middleware' => 'PreventBackButtonMiddleware'], function ()
{
    Route::post('store', [AppointmentController::class, 'store'])->name('appointment.info.store');
    Route::get('index', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('{id}/update', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::get('{id}/delete', [AppointmentController::class, 'destroy'])->name('appointment.delete');
    Route::get('create', [AppointmentController::class, 'create'])->name('appointment.create');
});

Route::group(['prefix' => 'onlineorder', 'middleware' => 'PreventBackButtonMiddleware'], function ()
{
    Route::get('/', function ()
    {
        return view('book.order');
    })->name('online.booking');
    Route::post('store', [OnlineorderController::class, 'store'])->name('online.info.store');
    Route::get('index', [OnlineorderController::class, 'index'])->name('online.index');
    Route::get('{id}/edit', [OnlineorderController::class, 'edit'])->name('online.edit');
    Route::put('{id}/update', [OnlineorderController::class, 'update'])->name('online.update');
    Route::get('{id}/delete', [OnlineorderController::class, 'destroy'])->name('online.delete');
    Route::get('create', [OnlineorderController::class, 'create'])->name('online.create');
    Route::get('/orderlist', function ()
    {
        return view('order.orderlist');
    })->name('orderlist');
});

Route::group(['prefix' => 'payment', 'middleware' => 'PreventBackButtonMiddleware'], function ()
{
    Route::get('/', function ()
    {
        return view('payment.index');
    })->name('payment.page');
    Route::post('store', [PaymentController::class, 'store'])->name('payment.info.store');
    Route::get('index', [PaymentController::class, 'index'])->name('payment.index');

    Route::get('invoice', function ()
    {
        return view('order.orderInvoice');
    });
});

Route::get('/forgot', function ()
{
    return view('sign_in.forgot');
})->name('forgot');

Route::get('login', function ()
{
    return view('sign_in.login');
})->name('user.login');
Route::get('register', function ()
{
    return view('sign_in.register');
})->name('user.register');
Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
Route::post('store', [RegisterDate::class, 'store'])->name('user.info.store');
Route::post('logins', [RegisterDate::class, 'login'])->name('user.info.login');
Route::post('forgot', [RegisterDate::class, 'forgot'])->name('user.info.forgot');


Route::group(['prefix' => 'price', 'middleware' => 'PreventBackButtonMiddleware'], function ()
{
    Route::get('', function ()
    {
        return view('price.priceAdd');
    })->name('price.page');
    Route::post('store', [PriceController::class, 'store'])->name('price.info.store');
    Route::get('create', [PriceController::class, 'create'])->name('price.create');
    Route::get('index', [PriceController::class, 'index'])->name('price.index');
    Route::put('{id}/update', [PriceController::class, 'update'])->name('price.update');
    Route::get('{id}/edit', [PriceController::class, 'edit'])->name('price.edit');
    Route::get('{id}/delete', [PriceController::class, 'destroy'])->name('price.delete');

});
