@extends('Frontend.layout.master')
@section('title')
    Service
@endsection
@section('mainContent')
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{ Lang::get('saloon.service_main_page') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <h2>{{ Lang::get('saloon.best_services_main_page') }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-1.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.hair_cut_main_page') }}</h3>
                        <p>
                            {{ Lang::get('saloon.haircut_description_main_page') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-2.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.beard_style_main_page') }}</h3>
                        <p>
                            {{ Lang::get('saloon.beard_style_goal_main_page') }} </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-3.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.color_and_wash_main_page') }}</h3>
                        <p>
                            {{ Lang::get('saloon.hair_color_description_main_page') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
