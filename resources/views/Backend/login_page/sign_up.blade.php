<!DOCTYPE html>
<html lang="en">
<title> Sign Up </title>

@include('Backend.layout.head')

<body class="hold-transition register-page">
<div class="register-box">
    <h2 class="text-center saloon_logo">Hairec Saloon</h2>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new admin</p>

            {!! Form::open(['route' => 'admin.user.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

            <div class="input-group">
                {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'autocomplete' => 'off']) !!}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
                {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'autocomplete' => 'off']) !!}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
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
            <div class="input-group mt-3">
                {!! Form::password('retype_password', ['class' => 'form-control', 'placeholder' => 'Retype password']) !!}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="register_btn mt-4">
                {!! Form::button('Register', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}
            </div>

            {!! Form::close() !!}

            <a href="{{route('admin.sign_in')}}" class="text-center pt-2 mt-3 d-block border-top">Sign in</a>
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
</script>
</body>
</html>
