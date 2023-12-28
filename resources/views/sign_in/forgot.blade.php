@extends('layout.master')
@section('title')
Forgot
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Forgot Password</h1>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="registration-form">
            <form action="{{route('user.info.forgot')}}" method="post">
                @csrf
                <p class="login-box-msg font-weight-normal text_simple">You forgot your password? <br> Here you can
                    easily retrieve a new password.</p>
                <div class="form-group">
                    <input type="email" class="form-control item" name="email" placeholder="Enter Your Email">
                    @error('email')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" name="password" placeholder="Password">
                    @error('password')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" name="repassword" placeholder="Retype Password">
                    @error('repassword')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block create-account ">Update password</button>
                </div>
            </form>
            <div class="social-media">
                <p class="mt-3 mb-1">
                    <a href="{{route('user.login')}}">Login</a>
                </p>
                <p class="mb-0">
                    <a href="{{route('user.register')}}" class="text-center text_simple">Register a new account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
