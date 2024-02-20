@extends('frontend.layout.master')
@section('title')
    Service
@endsection
@section('mainContent')
    <!-- Service Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Service</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <h2>Best Saloon and Barber Services for You</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-1.jpg')}}" alt="Image">
                        </div>
                        <h3>Hair Cut</h3>
                        <p>
                            A haircut is what a barber does when he trims your hair with scissors. You might decide it's
                            time for a haircut when your bangs are hanging in your eyes. Some people go to fancy Saloons
                            for a haircut. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-2.jpg')}}" alt="Image">
                        </div>
                        <h3>Beard Style</h3>
                        <p>
                            The ultimate goal of your beard style is to add contrast and dimension to your face.
                            Different face shapes should highlight certain facial features—not every style looks great
                            on every guy. </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-3.jpg')}}" alt="Image">
                        </div>
                        <h3>Color & Wash</h3>
                        <p>
                            Non-permanent hair color that lasts up to 8 shampoos gently adds color molecules to the
                            cuticle layer of your hair it is also known as semi-permanent hair color.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
