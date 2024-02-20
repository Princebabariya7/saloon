@extends('Backend.layout.index')
@section("title")
    Price View
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header pt-0">
            <div class="container-fluid">
                <div class=" top-part d-flex flex-row-reverse">
                    <div class="new_btn mt-4">
                        <a href="{{ route('admin.price.edit', ['id' => $price->id]) }}"
                           class="btn btn-primary btn-sm mb-3">Edit</a>
                        <a href="{{ route('admin.price.index') }}"
                           class="btn btn-secondary btn-sm mb-3">Back</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Price</h3>
                    </div>
                    <div class="container">
                        <table class="table">

                            <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>{{ $price->service }}</td>
                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td>{{ $price->price }}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>{{$price->status }}</td>
                            </tr>
                            <tr>
                                <td>Created at:</td>
                                <td>{{ $price->created_at->format('F d, Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td>Image:</td>
                                <td>
                                    <a href="{{ asset('uploads/gallery/'.$price->image) }}" target="_blank">
                                        <img src="{{ asset('uploads/gallery/'.$price->image) }}" width="200px"
                                             alt="Image">
                                    </a>
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
