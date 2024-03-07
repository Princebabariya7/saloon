<div class="footer ">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-contact">
                    <h2>{{ Lang::get('saloon.saloon_address') }}</h2>
                    <address>
                        <i class="fas fa-map-marker-alt pr-1"></i>
                        {{ Lang::get('saloon.address_details') }}
                        </address>
                    <p><i class="fa fa-envelope"></i>haricksaloon@gmail.com</p>
                    <div class="footer-social">
                        <a href="{{route('home')}}"><i class="fab fa-twitter"></i></a>
                        <a href="{{route('home')}}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{route('home')}}"><i class="fab fa-youtube"></i></a>
                        <a href="{{route('home')}}"><i class="fab fa-instagram"></i></a>
                        <a href="{{route('home')}}"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-link">
                    <h2>{{ Lang::get('saloon.quick_links') }}</h2>
                    <a href="{{route('terms')}}">{{ Lang::get('saloon.terms_of_use') }}</a>
                    <a href="{{route('privacy')}}">{{ Lang::get('saloon.privacy_policy') }}</a>
                    <a href="{{route('home')}}">{{ Lang::get('saloon.help') }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-newsletter">
                    <div class="text">
                        <p>{{ Lang::get('saloon.opening_hours') }}</p>
                        <h2>{{ Lang::get('saloon.opening_hours_details') }}</h2>
                        <p>{{ Lang::get('saloon.call_for_appointment') }}</p>
                        <h2>{{ Lang::get('saloon.contact_number') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{route('home')}}" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
