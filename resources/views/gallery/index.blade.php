@extends('layout.master')
@section('title')
    gallery
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Gallery</h2>
                </div>
                <div class="col-12">
                    <a href="">Home</a>
                    <a href="">Gallery</a>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio">
        <div class="container">
            <div class="section-header text-center">
                <p>Barber Image Gallery</p>
                <h2>Some Images From Our Barber Gallery</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".first">Hair Cut</li>
                        <li data-filter=".second">Beard Style</li>
                        <li data-filter=".third">Color & Wash</li>
                    </ul>
                </div>
            </div>
            <div class="row portfolio-container">
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-1.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-1.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-2.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-2.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-3.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-3.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-4.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-4.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-5.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-5.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third">
                    <div class="portfolio-wrap">
                        <a href="{{asset('cd/img/portfolio-6.jpg')}}" data-lightbox="portfolio">
                            <img src="{{asset('cd/img/portfolio-6.jpg')}}" alt="Portfolio Image">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
