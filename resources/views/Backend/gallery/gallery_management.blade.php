@extends ('Backend.layout.index')
@section("title")
    Gallery Management
@endsection
@section("content")
    <section class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gallery</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.gallery.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.gallery.index')}}"> Gallery</a>
                            </li>
                            @if($editMode)
                                <li class="breadcrumb-item text-secondary">Edit</li>
                            @else
                                <li class="breadcrumb-item text-secondary">Create</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
            @if($editMode)
                {!! Form::model($gallery, ['route' => ['admin.gallery.update', 'id' => $gallery->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::open(['route' => 'admin.gallery.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="mr-2">
                                <a class="btn btn-default btn-sm btn-block" href="{{route('admin.gallery.index')}}">
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
            <div class="card mx-3">
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
                                <label for="inputStatus">Status</label>
                                {!! Form::select('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control custom-select-sm']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        {!! Form::file('image', ['class' => 'form-control form-control-sm border-0']) !!}
                        @if($editMode)
                            <a href="#">
                                <img src="{{ asset('uploads/gallery/'.$gallery->image) }}"
                                     width="100px" class="pt-2" alt="Image">
                            </a>
                        @endif
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
