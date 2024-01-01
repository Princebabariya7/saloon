@extends ('layout.master')
@section('title')
    Price
@endsection
@section("mainContent")
    <div class="page-header m-0">
        <div class="container">
            <div class="row justify-content-around">
                <h1 class="login_logo font-weight-normal">Price</h1>
            </div>
        </div>
    </div>
    <div class="container py-5 form">
        <div class="card card-primary my-3 p-5 card-outline">
            @if(($editMode))
                {!!  Form::model($price, ['route' => ['price.update', 'id' => $price->id], 'method'=>'put' , 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::open(['route' => 'price.info.store' , 'method' => 'post' , 'enctype' => 'multipart/form-data'])!!}
            @endif
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="service">Enter Service Name</label>
                    {!! Form::text('service', null ,['class' =>'form-control' , 'placeholder' => 'Enter Service Name']) !!}
                </div>
                <div class="form-group col-md-6">
                    <label for="Enter price">Price</label>
                    {!! Form::text('price', null ,['class' =>'form-control' , 'placeholder' => 'Enter Price']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="Select Image">Select Image</label>
                {!! Form::file('image', ['class' => 'form-control border-0']) !!}
                @if(($editMode))
                    <a href="#">
                        <img src="{{ asset('uploads/gallery/'.$price->image) }}"
                             width="100px" alt="Image">
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">ADD</button>
            {!! Form::close() !!}
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
    </script>
@endsection
