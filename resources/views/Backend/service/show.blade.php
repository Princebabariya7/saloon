@extends('Backend.layout.index')
@section("title")
    Service Detail
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-sm-6">
                        <h1 class="m-0">Service</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item text-secondary"><a href="{{route('admin.service.index')}}">
                                    Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('admin.service.index')}}"> Services</a>
                            </li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.service.edit', ['id' => $service->id]) }}"
                           class="btn btn-primary btn-sm mb-3">Edit</a>
                        <a href="{{ route('admin.service.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Service Detail</h3>
                    </div>
                    <div class="container">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Category:</td>
                                <td>{{ $service->categories->type }}</td>
                            </tr>
                            <tr>
                                <td>Service:</td>
                                <td>{{$service->name}}</td>
                            </tr>
                            <tr>
                                <td>Detail:</td>
                                <td>{{$service->detail}}</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>{{$service->price}}</td>
                            </tr>
                            <tr>
                                <td>Duration:</td>
                                <td>{{$service->duration}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$service->status }}</td>
                            </tr>
                            <tr>
                                <td>Image:</td>
                                <td>
                                    <a href="{{ asset('uploads/gallery/'.$service->image) }}" target="_blank">
                                        <img src="{{ asset('uploads/gallery/'.$service->image) }}" width="200px"
                                             alt="Image">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Created at:</td>
                                <td>{{ $service->created_at->format('F d, Y H:i:s') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
