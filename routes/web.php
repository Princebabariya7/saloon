<?php

use App\Http\Controllers\frontend\AppointmentController;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\OnlineorderController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\PriceController;
use App\Http\Controllers\frontend\RegisterDate;
use Illuminate\Support\Facades\Route;


Route::get('', [DashboardController::class, 'index'])->name('home');

Route::group(['prefix' => 'home'], function ()
{
    Route::get('service', [DashboardController::class, 'service'])->name('service');
    Route::get('price', [DashboardController::class, 'price'])->name('price');
    Route::get('team', [DashboardController::class, 'team'])->name('team');
    Route::get('gallery', [DashboardController::class, 'gallery'])->name('gallery');
    Route::get('forgot', [DashboardController::class, 'forgot'])->name('forgot');
    Route::get('login', [DashboardController::class, 'login'])->name('user.login');
    Route::get('register', [DashboardController::class, 'register'])->name('user.register');
    Route::get('logout', [DashboardController::class, 'logout'])->name('logout');
});


Route::post('store', [RegisterDate::class, 'store'])->name('user.info.store');
Route::post('logins', [RegisterDate::class, 'login'])->name('user.info.login');
Route::post('forgot', [RegisterDate::class, 'forgot'])->name('user.info.forgot');


Route::group(['middleware' => 'PreventBackButtonMiddleware'], function ()
{
    Route::group(['prefix' => 'appointment'], function ()
    {
        Route::post('store', [AppointmentController::class, 'store'])->name('appointment.info.store');
        Route::get('index', [AppointmentController::class, 'index'])->name('appointment.index');
        Route::get('{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
        Route::put('{id}/update', [AppointmentController::class, 'update'])->name('appointment.update');
        Route::get('{id}/delete', [AppointmentController::class, 'destroy'])->name('appointment.delete');
        Route::get('create', [AppointmentController::class, 'create'])->name('appointment.create');

    });

    Route::group(['prefix' => 'onlineorder'], function ()
    {
        Route::post('view', [OnlineorderController::class, 'view'])->name('online.booking');
        Route::post('orderlist', [OnlineorderController::class, 'orderlist'])->name('orderlist');
        Route::post('store', [OnlineorderController::class, 'store'])->name('online.info.store');
        Route::get('index', [OnlineorderController::class, 'index'])->name('online.index');
        Route::get('{id}/edit', [OnlineorderController::class, 'edit'])->name('online.edit');
        Route::put('{id}/update', [OnlineorderController::class, 'update'])->name('online.update');
        Route::get('{id}/delete', [OnlineorderController::class, 'destroy'])->name('online.delete');
        Route::get('create', [OnlineorderController::class, 'create'])->name('online.create');
    });

    Route::group(['prefix' => 'payment'], function ()
    {
        Route::get('', [PaymentController::class, 'view'])->name('payment.page');
        Route::post('store', [PaymentController::class, 'store'])->name('payment.info.store');
        Route::get('index', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('invoice', [PaymentController::class, 'invoice'])->name('payment.invoice');
    });

    Route::group(['prefix' => 'price'], function ()
    {
        Route::post('', [PriceController::class, 'view'])->name('price.page');
        Route::post('store', [PriceController::class, 'store'])->name('price.info.store');
        Route::get('create', [PriceController::class, 'create'])->name('price.create');
        Route::get('index', [PriceController::class, 'index'])->name('price.index');
        Route::put('{id}/update', [PriceController::class, 'update'])->name('price.update');
        Route::get('{id}/edit', [PriceController::class, 'edit'])->name('price.edit');
        Route::get('{id}/delete', [PriceController::class, 'destroy'])->name('price.delete');
    });

});
