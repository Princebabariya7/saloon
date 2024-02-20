<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('frontend.layout.allcss')
</head>
<body>
<div class="page-header m-0">
    <div class="container">
        <div class="row justify-content-around">
            <h1 class="login_logo font-weight-normal">Verify Your Email</h1>
        </div>
    </div>
</div>
<div class="row justify-content-center mt-5 w-100">
    <div class="col-md-8">
        <div class="card mb-5">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                Before proceeding, please check your email for a verification link. If you did not receive the email,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
@section('custom_js')
    <script>
        @if (\Session::has('registerMsg'))
        toastr.success('You Are Successfully Registered Please Verify Your Email');
        {{\Session::forget('registerMsg')}}
    @endif
        </script>
@endsection
