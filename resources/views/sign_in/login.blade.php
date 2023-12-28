@extends('layout.master')
@section('title')
    login
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Login</h1>
            </div>
        </div>
    </div>

    <div class="container login-box  d-flex justify-content-center">
        <div class="registration-form">
            <form action="{{route('user.info.login')}}" method="post">
                @csrf
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" name="email" placeholder="Email" value="{{old('email')}}">
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
                    <button type="submit" class="btn btn-block create-account">Log In</button>
                </div>
            </form>
            <div class="social-media">
                <p class="mb-1">
                    <a href="{{route('forgot')}}" class="text_simple">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{route('user.register')}}" class="text-center text_simple">Register a new account</a>
                </p>
            </div>
        </div>
    </div>
@endsection
