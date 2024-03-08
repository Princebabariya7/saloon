@extends('Frontend.layout.master')
@section('title')
    Login
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">{{ Lang::get('saloon.log_in') }}</h1>
            </div>
        </div>
    </div>
    <div class="container login-box  d-flex justify-content-center">
        <div class="registration-form">
            {!! Form::open(['route' => 'authenticate' , 'method' => 'post'])!!}

            <div class="input-group">
                {!! Form::text('email', null ,['class' =>'form-control item' , 'placeholder' => __('saloon.enter_your_email') ,'value' => '{{old(email)}}' , 'autocomplete' => 'off']) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
                {!! Form::password('password', ['class' => 'form-control item' ,'placeholder' =>__('saloon.enter_your_password')]) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="sign_in_btn mt-4">
                {!! Form::button(__('saloon.log_in'), ['type' =>'submit','class'=>'btn btn-sm btn-block create-account']) !!}
            </div>

            {!! Form::close() !!}

            <div class="social-media">
                <p class="mb-1">
                    <a href="{{route('forgot')}}" class="text_simple">{{ Lang::get('saloon.forgot_password') }}</a>
                </p>
                <p class="mb-0">
                    <a href="{{route('user.register')}}"
                       class="text-center text_simple">{{ Lang::get('saloon.register_new_account') }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        @if (\Session::has('forgot'))
        toastr.success('{{ Lang::get('saloon.password_change') }}');
        {{\Session::forget('forgot')}}
        @endif
        @if (\Session::has('registerMsg'))
        toastr.success('{{ Lang::get('saloon.successfully_registered') }}');
        {{\Session::forget('registerMsg')}}
        @endif
        @if (\Session::has('wrongPass'))
        toastr.error('{{ Lang::get('saloon.check_email') }}');
        {{\Session::forget('wrongPass')}}
        @endif
        @if (\Session::has('logout'))
        toastr.success('{{ Lang::get('saloon.logged_out') }}');
        {{\Session::forget('logout')}}
        @endif
        @if (\Session::has('email_verified'))
        toastr.error('{{ Lang::get('saloon.email_validation') }}');
        {{\Session::forget('email_verified')}}
        @endif
    </script>
@endsection
