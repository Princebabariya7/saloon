@extends('Frontend.layout.master')
@section('title')
    Forgot
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">{{ Lang::get('saloon.forgot_password_page') }}</h1>
            </div>
        </div>
    </div>
    <main class="login-form">
        <div class="cotainer">
            <div class="container d-flex justify-content-center">
                <div class="registration-form">
                    {!! Form::open(['route' => 'forget.password.post' , 'method' => 'post'])!!}
                    <p class="login-box-msg font-weight-normal text_simple">{{ Lang::get('saloon.you_forgot_password') }}
                        <br> {{ Lang::get('saloon.retrieve_new_password') }}</p>
                    <div class="border-bottom"></div>
                    <div class="form-group pt-4">
                        {!! Form::text('email', null, ['id' => 'email_address', 'class' => 'form-control form-control-sm','placeholder' => __('saloon.enter_your_email'), 'required', 'autofocus', 'autocomplete' => 'off']) !!}
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group float-right">
                        {!! Form::button('Send Password Reset Link', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <div class="social-media p-2">
                        <p class="mt-1 mb-1">
                            <a href="{{route('user.login')}}">{{ Lang::get('saloon.log_in') }}</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{route('user.register')}}"
                               class="text-center text_simple">{{ Lang::get('saloon.register_new_account') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('custom_js')
    <script>
        @if (\Session::has('message'))
        toastr.success('{{ Session::get('message') }}');
        {{\Session::forget('message')}}
        @endif
    </script>
@endsection
