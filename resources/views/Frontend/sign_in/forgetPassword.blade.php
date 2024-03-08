{{--@extends('Frontend.layout.master')--}}
{{--@section('title')--}}
{{--    Forgot--}}
{{--@endsection--}}
{{--@section('mainContent')--}}
{{--    <div class="page-header m-0">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-around">--}}
{{--                <h1 class="login_logo font-weight-normal">{{ Lang::get('saloon.forgot_password_page') }}</h1>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="container d-flex justify-content-center">--}}
{{--        <div class="registration-form">--}}
{{--            {!! Form::open(['route' => 'user.info.forgot' , 'method' => 'post'])!!}--}}
{{--            <p class="login-box-msg font-weight-normal text_simple">{{ Lang::get('saloon.you_forgot_password') }} <br> {{ Lang::get('saloon.retrieve_new_password') }}</p>--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::text('email',null, ['class' => 'form-control item','placeholder' => __('saloon.enter_your_email'), 'autocomplete' => 'off']) !!}--}}
{{--            </div>--}}
{{--            --}}{{--<div class="form-group">--}}
{{--                {!! Form::password('password',['class' => 'form-control item','placeholder' =>  __('saloon.enter_password')]) !!}--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                {!! Form::password('repassword',['class'=>'form-control item','placeholder' =>__('saloon.reenter_password')]) !!}--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <button type="submit" class="btn btn-sm btn-secondary create-account">--}}
{{--                    {{ Lang::get('saloon.update_password') }}--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            {!! Form::close() !!}--}}
{{--            <div class="social-media">--}}
{{--                <p class="mt-3 mb-1">--}}
{{--                    <a href="{{route('user.login')}}">{{ Lang::get('saloon.log_in') }}</a>--}}
{{--                </p>--}}
{{--                <p class="mb-0">--}}
{{--                    <a href="{{route('user.register')}}" class="text-center text_simple">{{ Lang::get('saloon.register_new_account') }}</a>--}}
{{--                </p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
{{--@section('custom_js')--}}
{{--    <script>--}}
{{--        @if ($errors->any())--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--        toastr.error('{{ $error }}');--}}
{{--        @endforeach--}}
{{--        @endif--}}
{{--    </script>--}}
{{--@endsection--}}
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <form action="{{ route('forget.password.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
