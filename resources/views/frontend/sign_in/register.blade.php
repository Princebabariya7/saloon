@extends('frontend.layout.master')
@section('title')
    Register
@endsection
@section('mainContent')
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Create Account</h1>
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
                        {!! Form::text('firstname' ,null,['class'=>'form-control item','placeholder'=>'First Name' , 'autocomplete' => 'off']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('lastname' ,null,['class'=>'form-control item','placeholder'=>'Last Name', 'autocomplete' =>'off']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group clearfix">
                <div class="col-md-12 mx-auto text-center">
                    <div class="form-check form-check-inline">
                        {{Form::radio('gender','male',1,['class'=>'form-check-input' , 'id'=>'inlineRadio1'])}}
                        <label class="form-check-label ml-2" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        {{Form::radio('gender','female',0,['class'=>'form-check-input' , 'id'=>'inlineRadio2'])}}
                        <label class="form-check-label ml-2" for="inlineRadio2">Female</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('number',null,['class' => 'form-control item' , 'placeholder'=>'Mobile' , 'id' => 'name' ,'autocomplete' =>'off' , 'maxlength'=>'10']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::text('email', null ,['class' =>'form-control item' , 'placeholder' => 'Email' ,'autocomplete'=>'off']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::password('password', ['class' => 'form-control item' ,'placeholder' =>'Password']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::password('repassword',['class' =>'form-control item' , 'placeholder'=>'Retype Password']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="inputDescription">Address</label>
                    {!! Form::textarea('address',null,['class'=>'form-control','rows'=>'1', 'style'=>'width: 100%;']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>City</label>
                        {!! Form::select('city', ['' => 'Select one', 'Ahmedabad' => 'Ahmedabad','Rajkot' => 'Rajkot'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>State</label>
                        {!! Form::select('state', ['' => 'Select one', 'Gujrat' => 'Gujrat','Pune' => 'Pune'], null, ['class' => 'form-control select2bs4','style'=>'width: 100%;']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="zipcode">Zipcode</label>
                        {!! Form::text('zipcode',  null, ['class' => 'form-control','style'=>'width: 100%;','autocomplete'=>'off', 'maxlength'=>'6    ']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::button('Create Account',['type' => 'submit', 'class' => 'btn btn-sm btn-block create-account']) !!}
            </div>
            {!! Form::close() !!}
            <div class="social-media">
                <a href="{{route('user.login')}}" class="text-center">I already have a account</a>
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
        toastr.error('This Email Address Is Already Registered');
        {{\Session::forget('duplicateMsg')}}
        @endif
    </script>
@endsection
