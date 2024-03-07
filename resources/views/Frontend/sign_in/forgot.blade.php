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
    <div class="container d-flex justify-content-center">
        <div class="registration-form">
            {!! Form::open(['route' => 'user.info.forgot' , 'method' => 'post'])!!}
            <p class="login-box-msg font-weight-normal text_simple">{{ Lang::get('saloon.you_forgot_password') }} <br> {{ Lang::get('saloon.retrieve_new_password') }}</p>
            <div class="form-group">
                {!! Form::text('email',null, ['class' => 'form-control item','placeholder' => __('saloon.enter_your_email'), 'autocomplete' => 'off']) !!}
            </div>
            <div class="form-group">
                {!! Form::password('password',['class' => 'form-control item','placeholder' =>  __('saloon.enter_password')]) !!}
            </div>
            <div class="form-group">
                {!! Form::password('repassword',['class'=>'form-control item','placeholder' =>__('saloon.reenter_password')]) !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-secondary create-account">
                    {{ Lang::get('saloon.update_password') }}
                </button>
            </div>
            {!! Form::close() !!}
            <div class="social-media">
                <p class="mt-3 mb-1">
                    <a href="{{route('user.login')}}">{{ Lang::get('saloon.log_in') }}</a>
                </p>
                <p class="mb-0">
                    <a href="{{route('user.register')}}" class="text-center text_simple">{{ Lang::get('saloon.register_new_account') }}</a>
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
    </script>
@endsection
