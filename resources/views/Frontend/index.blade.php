@extends('Frontend.layout.master')
@section('title')
    Hairck Saloon
@endsection
@section('mainContent')
    <div class="hero">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="hero-text">
                        <h1>{{ Lang::get('saloon.welcome_message') }}</h1>
                        <p> {{ Lang::get('saloon.saloon_description') }}</p>
                        @if(auth()->user() == null || empty(auth()->user()->email_verified_at))
                        @else
                            <a class="btn" href="{{route('online.create')}}">{{ Lang::get('saloon.book_appointment') }}
                                <i class="fa fa-arrow-right ms-5 arrowForbook"></i></a>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 d-none d-md-block">
                    <div class="hero-image">
                        <img src="{{asset('cd/img/hero.png')}}" alt="Hero Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <img src="{{asset('cd/img/about.jpg')}}" alt="Image">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="section-header text-left">
                        <p> {{ Lang::get('saloon.learn_about_us') }}</p>
                        <h2> {{ Lang::get('saloon.experience_years') }}</h2>
                    </div>
                    <div class="about-text">
                        <p> {{ Lang::get('saloon.saloon_embodiment') }}</p>

                        <p> {{ Lang::get('saloon.power_of_nature') }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <p>{{ Lang::get('saloon.saloon_services') }}</p>
                <h2>{{ Lang::get('saloon.best_services') }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-1.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.hair_cut') }}</h3>
                        <p> {{ Lang::get('saloon.haircut_description') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-2.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.beard_style') }}</h3>
                        <p> {{ Lang::get('saloon.beard_style_goal') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-3.jpg')}}" alt="Image">
                        </div>
                        <h3>{{ Lang::get('saloon.color_and_wash') }}</h3>
                        <p> {{ Lang::get('saloon.hair_color_description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>{{ Lang::get('saloon.our_best_pricing') }}</p>
                <h2>{{ Lang::get('saloon.best_price_city') }}</h2>
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
                                <h3>
                                    <i class="fa fa-inr" aria-hidden="true"></i>
                                    {{$service->price}}
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="testimonial">
        <div class="container">
            <div class="owl-carousel testimonials-carousel">
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">

                    <p> {{ Lang::get('saloon.hairck_saloon_spot') }} </p>
                    <h2>{{ Lang::get('saloon.nord_charls') }}</h2>
                </div>
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">
                    <p>{{ Lang::get('saloon.loyal_customer') }} </p>
                    <h2>{{ Lang::get('saloon.adam_vice') }}</h2>
                </div>
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">
                    <p>{{ Lang::get('saloon.exceeded_expectations') }} </p>
                    <h2>{{ Lang::get('saloon.john_doe') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="team">
        <div class="container">
            <div class="section-header text-center">
                <p>{{ Lang::get('saloon.our_barber_team') }}</p>
                <h2>{{ Lang::get('saloon.meet_our_expert') }}</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-1.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.adam_phillips') }}</h2>
                            <p>{{ Lang::get('saloon.master_barber') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-2.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.dylan_adams') }}</h2>
                            <p>{{ Lang::get('saloon.hair_expert') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-3.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.gloria_edwards') }}</h2>
                            <p>{{ Lang::get('saloon.beard_expert') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-4.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>{{ Lang::get('saloon.josh_dunn') }}</h2>
                            <p>{{ Lang::get('saloon.color_expert') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script>
        @if (\Session::has('msgUser'))
        toastr.success('{{ Lang::get('saloon.login_message') }}');
        {{\Session::forget('msgUser')}}
        @endif
    </script>
@endsection
