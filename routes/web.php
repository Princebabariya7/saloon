<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OnlineorderController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\PriceController;
use App\Http\Controllers\frontend\RegisterDate;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'frontend'], function ()
{

    Route::group(['prefix' => 'home'], function ()
    {
        Route::get('service', [HomeController::class, 'service'])->name('service');
        Route::get('price', [HomeController::class, 'price'])->name('price');
        Route::get('team', [HomeController::class, 'team'])->name('team');
        Route::get('gallery', [HomeController::class, 'gallery'])->name('gallery');
        Route::get('forgot', [HomeController::class, 'forgot'])->name('forgot');
        Route::get('login', [HomeController::class, 'login'])->name('user.login');
        Route::get('register', [HomeController::class, 'register'])->name('user.register');
        Route::get('logout', [HomeController::class, 'logout'])->name('logout');
    });


    Route::post('store', [RegisterDate::class, 'store'])->name('user.info.store');
    Route::post('logins', [RegisterDate::class, 'login'])->name('user.info.login');
    Route::post('forgot', [RegisterDate::class, 'forgot'])->name('user.info.forgot');


    Route::group(['middleware' => 'PreventBackButtonMiddleware'], function ()
    {


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

});
Route::group(['prefix' => 'backend'], function ()
{
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard.index')->middleware('LogoutMiddleware');

    Route::prefix('Admin')->group(function ()
    {
        Route::get('logout', [App\Http\Controllers\Backend\AdminController::class, 'logout'])->name('admin.logout');
        Route::get('sign_in', [App\Http\Controllers\Backend\AdminController::class, 'signIn'])->name('admin.sign_in');
        Route::get('sign_up', [App\Http\Controllers\Backend\AdminController::class, 'signUp'])->name('admin.sign_up');
        Route::get('forgot-password', [App\Http\Controllers\Backend\AdminController::class, 'forgot'])->name('admin.forgot-password');
    });


    Route::prefix('user')->group(function ()
    {
        Route::post('store', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'store'])->name('admin.user.store');
        Route::post('login', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'login'])->name('admin.user.login');
        Route::post('forgot', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'forgot'])->name('admin.user.forgot');
    });

    Route::middleware(['LogoutMiddleware'])->group(function ()
    {

        Route::get('profile', [App\Http\Controllers\Backend\UserController::class, 'profile'])->name('user.profile');
        Route::get('change-password', [App\Http\Controllers\Backend\UserController::class, 'changePassword'])->name('profile.change-password');
        Route::post('change-password', [App\Http\Controllers\Backend\UserController::class, 'changePassword'])->name('user.change_password.post');

        Route::group(['prefix' => 'appointment'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\AppointmentController::class, 'index'])->name('admin.appointment.index');
            Route::get('create', [\App\Http\Controllers\Backend\AppointmentController::class, 'create'])->name('admin.appointment.create');
            Route::post('store', [\App\Http\Controllers\Backend\AppointmentController::class, 'store'])->name('admin.appointment.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\AppointmentController::class, 'edit'])->name('admin.appointment.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\AppointmentController::class, 'update'])->name('admin.appointment.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\AppointmentController::class, 'destroy'])->name('admin.appointment.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\AppointmentController::class, 'show'])->name('admin.appointment.show');
        });

        Route::group(['prefix' => 'package'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\PackageController::class, 'index'])->name('admin.package.index');
            Route::get('create', [\App\Http\Controllers\Backend\PackageController::class, 'create'])->name('admin.package.create');
            Route::post('store', [\App\Http\Controllers\Backend\PackageController::class, 'store'])->name('admin.package.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\PackageController::class, 'edit'])->name('admin.package.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\PackageController::class, 'update'])->name('admin.package.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\PackageController::class, 'destroy'])->name('admin.package.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\PackageController::class, 'show'])->name('admin.package.show');

        });

        Route::group(['prefix' => 'category'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [\App\Http\Controllers\Backend\CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store', [\App\Http\Controllers\Backend\CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\CategoryController::class, 'update'])->name('admin.category.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\CategoryController::class, 'destroy'])->name('admin.category.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\CategoryController::class, 'show'])->name('admin.category.show');
        });

        Route::group(['prefix' => 'service'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\ServiceController::class, 'index'])->name('admin.service.index');
            Route::get('create', [\App\Http\Controllers\Backend\ServiceController::class, 'create'])->name('admin.service.create');
            Route::post('store', [\App\Http\Controllers\Backend\ServiceController::class, 'store'])->name('admin.service.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\ServiceController::class, 'edit'])->name('admin.service.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\ServiceController::class, 'update'])->name('admin.service.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\ServiceController::class, 'destroy'])->name('admin.service.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\ServiceController::class, 'show'])->name('admin.service.show');
        });


        Route::group(['prefix' => 'gallery'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\GalleryController::class, 'index'])->name('admin.gallery.index');
            Route::get('create', [\App\Http\Controllers\Backend\GalleryController::class, 'create'])->name('admin.gallery.create');
            Route::post('store', [\App\Http\Controllers\Backend\GalleryController::class, 'store'])->name('admin.gallery.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\GalleryController::class, 'edit'])->name('admin.gallery.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\GalleryController::class, 'update'])->name('admin.gallery.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\GalleryController::class, 'destroy'])->name('admin.gallery.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\GalleryController::class, 'show'])->name('admin.gallery.show');
        });

        Route::group(['prefix' => 'order'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('admin.order.index');
            Route::get('create', [\App\Http\Controllers\Backend\OrderController::class, 'create'])->name('admin.order.create');
            Route::post('store', [\App\Http\Controllers\Backend\OrderController::class, 'store'])->name('admin.order.store');
        });

        Route::group(['prefix' => 'price'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\PriceController::class, 'index'])->name('admin.price.index');
            Route::get('create', [\App\Http\Controllers\Backend\PriceController::class, 'create'])->name('admin.price.create');
            Route::post('store', [\App\Http\Controllers\Backend\PriceController::class, 'store'])->name('admin.price.store');
            Route::get('{id}/edit', [\App\Http\Controllers\Backend\PriceController::class, 'edit'])->name('admin.price.edit');
            Route::put('{id}/update', [\App\Http\Controllers\Backend\PriceController::class, 'update'])->name('admin.price.update');
            Route::get('{id}/delete', [\App\Http\Controllers\Backend\PriceController::class, 'destroy'])->name('admin.price.delete');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\PriceController::class, 'show'])->name('admin.price.show');
        });

    });
});
