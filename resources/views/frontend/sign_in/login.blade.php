@extends('Frontend.layout.master')
@section('title')
    Login
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
            {!! Form::open(['route' => 'authenticate' , 'method' => 'post'])!!}
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                {!! Form::text('email', null ,['class' =>'form-control item' , 'placeholder' => 'Enter Your Email' ,'value' => '{{old(email)}}' , 'autocomplete' => 'off']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class' => 'form-control item' ,'placeholder' =>'Enter Your Password']) !!}
            </div>
            <div class="form-group">
                {!! Form::button('Log In', ['type' =>'submit','class'=>'btn btn-sm btn-block create-account']) !!}
            </div>

            {!! Form::close() !!}

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
@section('custom_js')
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        @if (\Session::has('forgot'))
        toastr.success('Your Password Was Changed!');
        {{\Session::forget('forgot')}}
        @endif
        @if (\Session::has('registerMsg'))
        toastr.success('You Are Successfully Registered Please Verify Your Email');
        {{\Session::forget('registerMsg')}}
        @endif
        @if (\Session::has('wrongPass'))
        toastr.error('Please Check Your Email And Password ');
        {{\Session::forget('wrongPass')}}
        @endif
        @if (\Session::has('logout'))
        toastr.success('You Are Successfully Logged Out');
        {{\Session::forget('logout')}}
        @endif
        @if (\Session::has('email_verified'))
        toastr.error('Your Email Is Not verified');
        {{\Session::forget('email_verified')}}
        @endif
    </script>
@endsection
