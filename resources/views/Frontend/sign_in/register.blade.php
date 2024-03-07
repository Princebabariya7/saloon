@extends('Frontend.layout.master')
@section('title')
    Register
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">{{ Lang::get('saloon.create_account') }}</h1>
            </div>
        </div>
    </div>
    <div class="container login-box d-flex justify-content-center">
        <div class="registration-form">
            {!! Form::open(['route' => 'user.info.store' , 'method' => 'post'])!!}
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('firstname' ,null,['class'=>'form-control item','placeholder'=>__('saloon.enter_first_name') , 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('lastname' ,null,['class'=>'form-control item','placeholder'=>__('saloon.enter_last_name'), 'autocomplete' =>'off']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="col-md-12 mx-auto text-center">
                    <div class="form-check form-check-inline">
                        {{Form::radio('gender','male',1,['class'=>'form-check-input' , 'id'=>'inlineRadio1'])}}
                        <label class="form-check-label ml-2" for="inlineRadio1">{{ Lang::get('saloon.male') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {{Form::radio('gender','female',0,['class'=>'form-check-input' , 'id'=>'inlineRadio2'])}}
                        <label class="form-check-label ml-2" for="inlineRadio2">{{ Lang::get('saloon.female') }}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('number',null,['class' => 'form-control item' , 'placeholder'=>__('saloon.enter_mobile') , 'id' => 'name' ,'autocomplete' =>'off' , 'maxlength'=>'10']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('email', null ,['class' =>'form-control item' , 'placeholder' => __('saloon.enter_your_email') ,'autocomplete'=>'off']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control item' ,'placeholder' =>__('saloon.enter_password')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::password('repassword',['class' =>'form-control item' , 'placeholder'=>__('saloon.reenter_password')]) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="inputDescription">{{ Lang::get('saloon.address') }}</label>
                    {!! Form::textarea('address',null,['class'=>'form-control','rows'=>'1', 'style'=>'width: 100%;']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ Lang::get('saloon.city') }}</label>
                        {!! Form::select('city', ['' => 'Select one', 'Ahmedabad' => 'Ahmedabad','Rajkot' => 'Rajkot'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ Lang::get('saloon.state') }}</label>
                        {!! Form::select('state', ['' => 'Select one', 'Gujrat' => 'Gujrat','Pune' => 'Pune'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="zipcode">{{ Lang::get('saloon.zipcode') }}</label>
                        {!! Form::text('zipcode',  null, ['class' => 'form-control','style'=>'width: 100%;','autocomplete'=>'off', 'maxlength'=>'6    ']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::button(__('saloon.create_account'),['type' => 'submit', 'class' => 'btn btn-sm btn-block create-account']) !!}
            </div>
            {!! Form::close() !!}
            <div class="social-media">
                <a href="{{route('user.login')}}" class="text-center">{{ Lang::get('saloon.already_have_account') }}</a>
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
        @if (\Session::has('duplicateMsg'))
        toastr.error('{{ Lang::get('saloon.email_already_registered') }}');
        {{\Session::forget('duplicateMsg')}}
        @endif
    </script>
@endsection
