@extends ('Backend.layout.index')
@section("title")
    Service Form
@endsection
@section("content")
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Service</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.service.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.user.index')}}"> User</a>
                            </li>
                                <li class="breadcrumb-item text-secondary">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
            {!!  Form::model($user, ['route' => ['admin.user.update', 'id' => $user], 'method'=>'put']) !!}
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a class="btn btn-default btn-sm btn-block" href="{{route('admin.user.index')}}">
                                    Back
                                </a>
                            </li>
                            <li>
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Save</button>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100">
            <div class="card  mx-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">First Name</label>
                                {!! Form::text('firstname', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                {!! Form::text('lastname', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputDescription">Email</label>
                                {!! Form::text('email', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                {!! Form::text('mobile', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                {!! Form::text('address', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">City</label>
                                {!! Form::text('city', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                {!! Form::text('state', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Zipcode</label>
                                {!! Form::text('zipcode', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Status</label>
                                {!! Form::text('user_status', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
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
