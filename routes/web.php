<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\PriceController;
use App\Http\Controllers\Frontend\RegisterDate;
use App\Http\Controllers\Frontend\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend as BackendController;

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
        Route::get('terms', [HomeController::class, 'terms'])->name('terms');
        Route::get('privacy', [HomeController::class, 'privacy'])->name('privacy');
        Route::post('/set-locale', [HomeController::class, 'setLocale'])->name('online.setLocale');

    });

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::post('store', [RegisterDate::class, 'store'])->name('user.info.store');
    Route::post('logins', [RegisterDate::class, 'login'])->name('user.info.login');
    Route::post('authenticate', [RegisterDate::class, 'authenticate'])->name('authenticate');
//    Route::post('forgot', [RegisterDate::class, 'forgot'])->name('user.info.forgot');

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
    Route::get('dashboard', [BackendController\DashboardController::class, 'index'])->name('dashboard.index')->middleware('LogoutMiddleware');

    Route::prefix('Admin')->group(function ()
    {
        Route::get('logout', [BackendController\AdminController::class, 'logout'])->name('admin.logout');
        Route::get('sign_in', [BackendController\AdminController::class, 'signIn'])->name('admin.sign_in');
        Route::get('sign_up', [BackendController\AdminController::class, 'signUp'])->name('admin.sign_up');
        Route::get('forgot_password', [BackendController\AdminController::class, 'forgot'])->name('admin.forgot_password');
    });

    Route::prefix('users')->group(function ()
    {
        Route::get('/', [BackendController\AdminRegistrationController::class, 'index'])->name('admin.user.index');
        Route::post('store', [BackendController\AdminRegistrationController::class, 'store'])->name('admin.user.store');
        Route::get('{id}/show', [BackendController\AdminRegistrationController::class, 'show'])->name('admin.user.show');
        Route::get('{id}/delete', [BackendController\AdminRegistrationController::class, 'destroy'])->name('admin.user.delete');
        Route::post('login', [BackendController\AdminRegistrationController::class, 'login'])->name('admin.user.login');
        Route::post('forgot', [BackendController\AdminRegistrationController::class, 'forgot'])->name('admin.user.forgot');
        Route::get('{id}/edit', [BackendController\AdminRegistrationController::class, 'edit'])->name('admin.user.edit');
        Route::put('{id}/update', [BackendController\AdminRegistrationController::class, 'update'])->name('admin.user.update');
    });

    Route::middleware(['LogoutMiddleware'])->group(function ()
    {
        Route::get('profile', [BackendController\UserController::class, 'profile'])->name('user.profile');
        Route::get('change-password', [BackendController\UserController::class, 'changePassword'])->name('profile.change-password');
        Route::post('change-password', [BackendController\UserController::class, 'changePassword'])->name('user.change_password.post');

        Route::group(['prefix' => 'appointments'], function ()
        {
            Route::get('/', [BackendController\AppointmentController::class, 'index'])->name('admin.appointment.index');
            Route::get('create', [BackendController\AppointmentController::class, 'create'])->name('admin.appointment.create');
            Route::post('store', [BackendController\AppointmentController::class, 'store'])->name('admin.appointment.store');
            Route::get('{id}/edit', [BackendController\AppointmentController::class, 'edit'])->name('admin.appointment.edit');
            Route::put('{id}/update', [BackendController\AppointmentController::class, 'update'])->name('admin.appointment.update');
            Route::get('{id}/delete', [BackendController\AppointmentController::class, 'destroy'])->name('admin.appointment.delete');
            Route::get('{id}/show', [BackendController\AppointmentController::class, 'show'])->name('admin.appointment.show');
            Route::post('fetch/services', [BackendController\AppointmentController::class, 'fetchServices'])->name('admin.fetch.services');
            Route::post('fetch/timeslot', [BackendController\AppointmentController::class, 'timeSlot'])->name('admin.fetch.timeslot');
        });

        Route::group(['prefix' => 'categories'], function ()
        {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::get('{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');
            Route::get('{id}/show', [CategoryController::class, 'show'])->name('admin.category.show');
        });

        Route::group(['prefix' => 'services'], function ()
        {
            Route::get('/', [ServiceController::class, 'index'])->name('admin.service.index');
            Route::get('create', [ServiceController::class, 'create'])->name('admin.service.create');
            Route::post('store', [ServiceController::class, 'store'])->name('admin.service.store');
            Route::get('{id}/edit', [ServiceController::class, 'edit'])->name('admin.service.edit');
            Route::put('{id}/update', [ServiceController::class, 'update'])->name('admin.service.update');
            Route::get('{id}/delete', [ServiceController::class, 'destroy'])->name('admin.service.delete');
            Route::get('{id}/show', [ServiceController::class, 'show'])->name('admin.service.show');
        });

        Route::group(['prefix' => 'gallery'], function ()
        {
            Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index');
            Route::get('create', [GalleryController::class, 'create'])->name('admin.gallery.create');
            Route::post('store', [GalleryController::class, 'store'])->name('admin.gallery.store');
            Route::get('{id}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
            Route::put('{id}/update', [GalleryController::class, 'update'])->name('admin.gallery.update');
            Route::get('{id}/delete', [GalleryController::class, 'destroy'])->name('admin.gallery.delete');
            Route::get('{id}/show', [GalleryController::class, 'show'])->name('admin.gallery.show');
        });

        Route::group(['prefix' => 'prices'], function ()
        {
            Route::get('/', [BackendController\PriceController::class, 'index'])->name('admin.price.index');
            Route::get('create', [BackendController\PriceController::class, 'create'])->name('admin.price.create');
            Route::post('store', [BackendController\PriceController::class, 'store'])->name('admin.price.store');
            Route::get('{id}/edit', [BackendController\PriceController::class, 'edit'])->name('admin.price.edit');
            Route::put('{id}/update', [BackendController\PriceController::class, 'update'])->name('admin.price.update');
            Route::get('{id}/delete', [BackendController\PriceController::class, 'destroy'])->name('admin.price.delete');
            Route::get('{id}/show', [BackendController\PriceController::class, 'show'])->name('admin.price.show');
        });

        Route::group(['prefix' => 'payments'], function ()
        {
            Route::get('/', [BackendController\PaymentController::class, 'index'])->name('admin.payment.index');
            Route::get('{id}/create', [BackendController\PaymentController::class, 'create'])->name('admin.payment.create');
            Route::post('store', [BackendController\PaymentController::class, 'store'])->name('admin.payment.store');
            Route::get('{id}/show', [BackendController\PaymentController::class, 'show'])->name('admin.payment.show');
            Route::get('{id}/pending', [BackendController\PaymentController::class, 'pending'])->name('admin.payment.pending');
        });
    });
});
