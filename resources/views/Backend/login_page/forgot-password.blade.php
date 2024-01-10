<!DOCTYPE html>
<html lang="en">
@include('Backend.layout.head')

<body class="hold-transition login-page">
<div class="login-box">
    <h2 class="text-center saloon_logo">Hairec Saloon</h2>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        </div>
        <div class="card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            {!! Form::open(['route' => 'admin.user.forgot', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                {!! Form::password('conform_password', ['class' => 'form-control', 'placeholder' => 'Conform Password']) !!}

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fa fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {!! Form::button('Request new password', ['type' => 'submit', 'class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <p class="mt-3 mb-1">
                <a href="{{route('admin.sign_in')}}" class="text-center pt-2 mt-3 d-block border-top">Login</a>
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
</script>
</body>
</html>
