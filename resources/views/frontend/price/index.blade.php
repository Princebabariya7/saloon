@extends('Frontend.layout.master')
@section('title')
    Price
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Price</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Best Pricing</p>
                <h2>We Provide Best Price in the City</h2>
            </div>
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="price-item">
                            <div class="price-img">
                                <a href="#" data-toggle="modal" data-target="#exampleModal{{ $service->id }}">
                                    <img style="height: 100px; width: 100px;"
                                         src="{{ asset('uploads/gallery/'.$service->image) }}" alt="Image">
                                </a>
                            </div>
                            <div class="price-text">
                                <h2>
                                    {{$service->name}}
                                </h2>
                                <h3><i class="fa fa-inr" aria-hidden="true"></i>{{$service->price}}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
