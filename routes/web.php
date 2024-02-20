<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\AppointmentController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\PriceController;
use App\Http\Controllers\frontend\RegisterDate;
use App\Http\Controllers\frontend\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('EmailVerificationMiddleware');
Route::group(['prefix' => 'verification'], function ()
{
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

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
    Route::post('authenticate', [RegisterDate::class, 'authenticate'])->name('authenticate');
    Route::post('forgot', [RegisterDate::class, 'forgot'])->name('user.info.forgot');

    Route::group(['middleware' => 'PreventBackButtonMiddleware'], function ()
    {
        Route::group(['prefix' => 'appointment'], function ()
        {
            Route::post('view', [AppointmentController::class, 'view'])->name('online.booking');
            Route::post('orderlist', [AppointmentController::class, 'orderlist'])->name('orderlist');
            Route::post('store', [AppointmentController::class, 'store'])->name('online.info.store');
            Route::get('index', [AppointmentController::class, 'index'])->name('online.index');
            Route::get('{id}/edit', [AppointmentController::class, 'edit'])->name('online.edit');
            Route::put('{id}/update', [AppointmentController::class, 'update'])->name('online.update');
            Route::get('{id}/delete', [AppointmentController::class, 'destroy'])->name('online.delete');
            Route::get('create', [AppointmentController::class, 'create'])->name('online.create');
            Route::post('fetch/services', [AppointmentController::class, 'fetchServices'])->name('online.fetch.services');
            Route::post('fetch/timeslot', [AppointmentController::class, 'timeSlot'])->name('online.fetch.timeslot');
        });

        Route::group(['prefix' => 'payment'], function ()
        {
            Route::get('{id}/create', [PaymentController:: class, 'create'])->name('payment.page');
            Route::get('{id}/pending', [PaymentController:: class, 'pending'])->name('payment.pending');
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
    Route::get('appointment_details', [App\Http\Controllers\Backend\DashboardController::class, 'appointmentDetails'])->name('admin.appointment.details');
    Route::get('orders_details', [App\Http\Controllers\Backend\DashboardController::class, 'orderDetails'])->name('admin.order.details');
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
        Route::get('/', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'index'])->name('admin.user.index');
        Route::post('store', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'store'])->name('admin.user.store');
        Route::get('{id}/show', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'show'])->name('admin.user.show');
        Route::get('{id}/delete', [App\Http\Controllers\Backend\AdminRegistrationController::class, 'destroy'])->name('admin.user.delete');
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
            Route::post('fetch/services', [\App\Http\Controllers\Backend\AppointmentController::class, 'fetchServices'])->name('admin.fetch.services');
            Route::post('fetch/timeslot', [\App\Http\Controllers\Backend\AppointmentController::class, 'timeSlot'])->name('admin.fetch.timeslot');
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

        Route::group(['prefix' => 'payment'], function ()
        {
            Route::get('/', [\App\Http\Controllers\Backend\PaymentController::class, 'index'])->name('admin.payment.index');
            Route::get('{id}/create', [\App\Http\Controllers\Backend\PaymentController::class, 'create'])->name('admin.payment.create');
            Route::post('store', [\App\Http\Controllers\Backend\PaymentController::class, 'store'])->name('admin.payment.store');
            Route::get('{id}/show', [\App\Http\Controllers\Backend\PaymentController::class, 'show'])->name('admin.payment.show');
            Route::get('{id}/pending', [\App\Http\Controllers\Backend\PaymentController::class, 'pending'])->name('admin.payment.pending');
        });
    });
});
