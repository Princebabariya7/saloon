@extends('Backend.layout.index')
@section("title")
    Gallery Detail
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-sm-6">
                        <h1 class="m-0">Gallery</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.gallery.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.gallery.index')}}"> Gallery</a>
                            </li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.gallery.edit', ['id' => $gallery->id]) }}"
                           class="btn btn-primary btn-sm mb-3">Edit</a>
                        <a href="{{ route('admin.gallery.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Gallery Detail</h3>
                    </div>
                    <div class="container">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>{{ $gallery->name }}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$gallery->status }}</td>
                            </tr>
                            <tr>
                                <td>Created at:</td>
                                <td>{{ $gallery->created_at->format('F d, Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td>Image:</td>
                                <td>
                                    <a href="{{ asset('uploads/gallery/'.$gallery->image) }}" target="_blank">
                                        <img src="{{ asset('uploads/gallery/'.$gallery->image) }}" width="200px"
                                             alt="Image"></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
