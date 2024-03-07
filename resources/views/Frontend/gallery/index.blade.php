@extends('Frontend.layout.master')
@section('title')
    Gallery
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ Lang::get('saloon.gallery') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio">
        <div class="container">
            <div class="section-header text-center">
                <p>{{ Lang::get('saloon.barber_image_gallery') }}</p>
                <h2>{{ Lang::get('saloon.some_images_from_our_barber_gallery') }}</h2>
            </div>
            <div class="row portfolio-container">

                @foreach($galleries as $gallery)
                    <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first">
                        <div class="portfolio-wrap">
                            <a href="{{ asset('uploads/gallery/'.$gallery->image) }}" data-lightbox="portfolio"
                               data-target="#exampleModal{{ $gallery->id }}">
                                <img src="{{ asset('uploads/gallery/'.$gallery->image) }}" alt="Image">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
