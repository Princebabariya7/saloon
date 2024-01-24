@extends('frontend.layout.master')

@section('title')
    Hairck Saloon
@endsection
@section('mainContent')
    <!-- Hero Start -->
    <div class="hero">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="hero-text">
                        <h1>Welcome To Hairck Saloon</h1>
                        <p> Welcome to Hairck Saloon, where beauty meets sophistication. Our Saloon is a haven of
                            elegance
                            and expertise, dedicated to delivering the ultimate in grooming and pampering
                            experiences. </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 d-none d-md-block">
                    <div class="hero-image">
                        <img src="{{asset('cd/img/hero.png')}}" alt="Hero Image">
                    </div>
                </div>
            </div>
            <span></span>
            </button>
        </div>
    </div>

    <!-- About Start -->
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
                        <p>Learn About Us</p>
                        <h2>25 Years Experience</h2>
                    </div>
                    <div class="about-text">
                        <p> Harick Saloon is an embodiment of sophistication and skill, offering a refined environment
                            where
                            clients can access top-notch hairstyling, skincare, and wellness services. Our team of
                            highly
                            trained professionals is dedicated to enhancing your natural beauty while prioritizing the
                            well-being of your hair and skin. </p>

                        <p> At Harick Saloon, we believe in the power of nature. We exclusively use natural products to
                            ensure that every treatment not only leaves you looking stunning but also promotes the
                            long-term
                            health and radiance of your hair and skin. Our commitment to natural ingredients reflects
                            our
                            dedication to your overall well-being. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Saloon Services</p>
                <h2>Best Saloon and Barber Services for You</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-1.jpg')}}" alt="Image">
                        </div>
                        <h3>Hair Cut</h3>
                        <p> A haircut is what a barber does when he trims your hair with scissors. You might decide it's
                            time for a haircut when your bangs are hanging in your eyes. Some people go to fancy Saloons
                            for
                            a haircut.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-2.jpg')}}" alt="Image">
                        </div>
                        <h3>Beard Style</h3>
                        <p> The ultimate goal of your beard style is to add contrast and dimension to your face.
                            Different
                            face shapes should highlight certain facial features—not every style looks great on every
                            guy.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-img">
                            <img src="{{asset('cd/img/service-3.jpg')}}" alt="Image">
                        </div>
                        <h3>Color & Wash</h3>
                        <p> Non-permanent hair color that lasts up to 8 shampoos gently adds color molecules to the
                            cuticle
                            layer of your hair it is also known as semi-permanent hair color.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Pricing Start -->
    <div class="price">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Best Pricing</p>

                <h2>Best Price in the City</h2>
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
                                    {{$service->service}}
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
    <!-- Pricing End -->

    <!-- Testimonial Start -->
    <div class="testimonial">
        <div class="container">
            <div class="owl-carousel testimonials-carousel">
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">

                    <p> "Hairck Saloon All Boys is my go-to spot for a fresh haircut every time. The skilled stylists
                        here truly understand the latest trends and always deliver a cut that suits my style. The
                        atmosphere is lively, and the staff is friendly, making it a great experience overall. I
                        wouldn't trust anyone else with my hair!" </p>
                    <h2>nord charls</h2>
                </div>
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">

                    <p>"I've been a loyal customer of Hairck Saloon All Boys for years, and I can confidently say it's
                        the best men's Saloon in town. The attention to detail and precision in their haircuts is
                        unmatched. The staff is professional, and the ambiance is comfortable. I always leave feeling
                        rejuvenated and looking sharp. Highly recommend!" </p>
                    <h2>adam vice</h2>
                </div>
                <div class="testimonial-item">
                    <img src="{{asset('cd/img/testimonial-1.jpg')}}" alt="Image">

                    <p>"Hairck Saloon All Boys has consistently exceeded my expectations. The stylists are not only
                        skilled but also attentive to my preferences. Whether I want a classic look or something more
                        contemporary, they always deliver. The Saloon has a cool vibe, and the personalized service makes
                        me feel like a valued client. I wouldn't consider going anywhere else for my grooming
                        needs." </p>
                    <h2>john doe</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Team Start -->
    <div class="team">
        <div class="container">
            <div class="section-header text-center">
                <p>Our Barber Team</p>

                <h2>Meet Our Hair Cut Expert Barber</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-1.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Adam Phillips</h2>
                            <p>Master Barber</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-2.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Dylan Adams</h2>
                            <p>Hair Expert</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-3.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Gloria Edwards</h2>
                            <p>Beard Expert</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="{{asset('cd/img/team-4.jpg')}}" alt="Team Image">
                        </div>
                        <div class="team-text">
                            <h2>Josh Dunn</h2>
                            <p>Color Expert</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
@endsection

@section('custom_js')
    <script>

        @if (\Session::has('msg'))
        toastr.success('You are successfully logged in');
        {{\Session::forget('msg')}}
        @endif
    </script>
@endsection
