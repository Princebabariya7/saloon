@extends ('Backend.layout.index')
@section("title")
    Package Form
@endsection
@section("content")
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Package</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.package.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.package.index')}}"> Package</a>
                            </li>
                            <li class="breadcrumb-item text-secondary">Edit</li>

                        </ol>
                    </div>
                </div>
            </div>
            @if($editMode)
                {!!  Form::model($package, ['route' => ['admin.package.update', 'id' => $package->id], 'method'=>'put']) !!}
            @else
                {{ Form::open(['route' => ['admin.package.store'], 'method'=>'post']) }}
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a class="btn btn-default btn-sm btn-block" href="{{route('admin.package.index')}}">
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
                                <label>Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                {!! Form::text('price', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Detail</label>
                        {!! Form::textarea('detail', null, ['class' => 'form-control form-control-sm', 'rows' => 4, 'id' => 'inputDescription' , 'autocomplete' => 'off']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Duration</label>
                                {!! Form::text('duration', null, ['class' => 'form-control form-control-sm' , 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                {!! Form::select('status', $status, null, ['class' => 'form-control form-control-sm']) !!}
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
