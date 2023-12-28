@extends('layout.master')
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
            <form action="{{route('user.info.store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-icon">
                    <span><i class="icon icon-user"></i></span>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="username" name="firstname"
                           placeholder="Enter your firstname">
                    @error('firstname')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="password" name="lastname"
                           placeholder="Enter your lastname">
                    @error('lastname')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="gender" value="male">
                        <label for="radioPrimary1">
                            Male
                        </label>
                    </div>
                    <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="gender" value="female">
                        <label for="radioPrimary2">
                            Female
                        </label>
                    </div>
                    @error('gender')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input item" name="date"
                               data-target="#reservationdate" placeholder="Enter your DOB">
                        <div class="input-group-append" data-target="#reservationdate"
                             data-toggle="datetimepicker">
                            <div class="input-group-text item"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('date')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="number" class="form-control item" name="number" id="name"
                           placeholder="Enter your mobile">
                    @error('number')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="email" class="form-control item" name="email" placeholder="Email">
                    @error('email')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" name="password" placeholder="Password">
                    @error('password')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" name="repassword" placeholder="Retype Password">
                    @error('repassword')
                    <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block create-account">Create Account</button>
                </div>
            </form>
            <div class="social-media">
                <a href="{{route('user.login')}}" class="text-center">I already have a account</a>
            </div>
        </div>
    </div>

@endsection
@section('custom_js')
    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('yyyy/mm/dd', {
                'placeholder': 'yyyy/mm/dd'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('yyyy/mm/dd', {
                'placeholder': 'yyyy/mm/dd'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
        });
    </script>
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endsection
