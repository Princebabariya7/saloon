@extends('frontend.layout.master')
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
            <form action="{{ route('authenticate') }}" method="post">
                @csrf
                <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3 row">
                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                </div>

            </form>
{{--            {!! Form::open(['route' => 'user.info.login' , 'method' => 'post'])!!}--}}
{{--            <div class="form-icon">--}}
{{--                <span><i class="icon icon-user"></i></span>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::text('email', null ,['class' =>'form-control item' , 'placeholder' => 'Enter Email' ,'value' => '{{old(email)}}' , 'autocomplete' => 'off']) !!}--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::password('password', ['class' => 'form-control item' ,'placeholder' =>'Enter Password']) !!}--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::button('Log In', ['type' =>'submit','class'=>'btn btn-sm btn-block create-account']) !!}--}}
{{--            </div>--}}

{{--            {!! Form::close() !!}--}}

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
        @if (\Session::has('msg'))
        toastr.success('Your password was changed!');
        {{\Session::forget('msg')}}
        @endif
        @if (\Session::has('registerMsg'))
        toastr.success('you are successfully registered');
        {{\Session::forget('registerMsg')}}
        @endif
        @if (\Session::has('wrongPass'))
        toastr.error('Please check your email and password ');
        {{\Session::forget('wrongPass')}}
        @endif
    </script>
@endsection
