<!DOCTYPE html>
<html lang="en">
<title> Sign In </title>
@include('Backend.layout.head')
<body class="hold-transition login-page">
<div class="login-box">
    <h2 class="text-center saloon_logo">Hairec Saloon</h2>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1"><b>Sign</b> in</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            {!! Form::open(['route' => 'admin.user.login', 'method' => 'post']) !!}
            <div class="input-group">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'autocomplete' => 'off']) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="sign_in_btn mt-4">
                {!! Form::button('Sign In', ['type' => 'submit', 'class' => 'btn btn-sm btn-primary btn-block']) !!}
            </div>
            {!! Form::close() !!}

            <p class="mb-1"><a href="{{route('forgot')}}" class="text-center d-block pt-2">I forgot my
                    password</a></p>
            <p class="mb-0">
                <a href="{{route('user.register')}}" class="text-center d-block pt-2">Register a new admin</a>
            </p>
        </div>
    </div>
</div>
@include('Backend.layout.script')
<script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif
    @if (\Session::has('msg'))
    toastr.success('You Are Successfully Registered!');
    {{\Session::forget('msg')}}
    @endif
    @if (\Session::has('Password'))
    toastr.success('Your Password Has Successfully Changed!');
    {{\Session::forget('Password')}}
    @endif
    @if (\Session::has('logout'))
    toastr.success('You Are Successfully Logged Out!');
    {{\Session::forget('logout')}}
    @endif
    @if (\Session::has('wrongPass'))
    toastr.error('Please Check Your Email And Password ');
    {{\Session::forget('wrongPass')}}
    @endif
</script>
</body>
</html>
