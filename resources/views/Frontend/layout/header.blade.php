<div class="top-bar d-none d-md-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if(auth()->user() == null || empty(auth()->user()->email_verified_at))
                    <div class="top-bar-left">
                        <div class="text">
                            <a href="{{route('user.register')}}">
                                <h2>{{ Lang::get('saloon.sign_up') }}</h2>
                            </a>
                        </div>
                        <div class="text">
                            <a href="{{route('user.login')}}">
                                <h2>{{ Lang::get('saloon.sign_in') }}</h2>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="top-bar-left">
                        <div class="text">
                            <a href="{{route('logout')}}">
                                <h2><i class="fa fa-sign-out fa-2x"></i></h2>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="top-bar-right">
                    <div class="social align-items-center">
                        {!! Form::select('language', ['en' => __('saloon.english'), 'hi' => __('saloon.hindi'),'gu' => __('saloon.gujarati')],config('app.locale'), ['class' => 'form-control form-control-sm lang-btn', 'id' => 'languageDropdown']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a href="{{route('home')}}" class="navbar-brand hair">Hairck <span>Saloon</span></a>
        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse justify-content-between collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="{{route('home')}}" class="nav-item nav-link">{{ Lang::get('saloon.home') }}</a>
                <a href="{{route('service')}}" class="nav-item nav-link">{{ Lang::get('saloon.service') }}</a>
                <a href="{{route('price')}}" class="nav-item nav-link">{{ Lang::get('saloon.price') }}</a>
                <a href="{{route('team')}}" class="nav-item nav-link">{{ Lang::get('saloon.barber') }}</a>
                <a href="{{route('gallery')}}" class="nav-item nav-link">{{ Lang::get('saloon.gallery') }}</a>
                @if(auth()->user() == null)

                @elseif(!empty(auth()->user()->email_verified_at))
                    <a href="{{route('online.index')}}" class="nav-item nav-link">{{ Lang::get('saloon.appointments') }}</a>

                @endif
            </div>
        </div>
    </div>
</div>
