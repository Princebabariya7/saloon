<!-- Top Bar Start -->
<div class="top-bar d-none d-md-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @if(auth()->user() == null)
                    <div class="top-bar-left">
                        <div class="text">
                            <a href="{{route('user.register')}}">
                                <h2>sign up</h2>
                            </a>
                        </div>
                        <div class="text">
                            <a href="{{route('user.login')}}">
                                <h2>sign in</h2>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="top-bar-left">
                        <div class="text">
                            <a href="{{route('logout')}}">
                                <h2>Logout</h2>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="top-bar-right">
                    <div class="social">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar End -->

<!-- Nav Bar Start -->
<div class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a href="{{route('home')}}" class="navbar-brand hair">Hairck <span>Saloon</span></a>
        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse justify-content-between collapse" id="navbarCollapse">
            <div class="navbar-nav ml-auto">
                <a href="{{route('home')}}" class="nav-item nav-link">Home</a>
                <a href="{{route('service')}}" class="nav-item nav-link">Service</a>
                <a href="{{route('price')}}" class="nav-item nav-link">Price</a>
                <a href="{{route('team')}}" class="nav-item nav-link">Barber</a>
                <a href="{{route('gallery')}}" class="nav-item nav-link">Gallery</a>
                @if(auth()->user() == null)

                @else
                    <div class="nav-item dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown">
                            <i class="fa fa-user text-light" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{route('appointment.create')}}" class="dropdown-item">Book Appointment <i
                                    class="fa fa-calendar" aria-hidden="true"></i></a>
                            <a href="{{route('online.create')}}" class="dropdown-item">Book Order</a>
                            <a href="{{route('price.create')}}" class="dropdown-item">price</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown">
                            <i class="fa fa-shopping-cart  text-light" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{route('appointment.index')}}" class="dropdown-item"> Appointments list</a>
                            <a href="{{route('online.index')}}" class="dropdown-item"> online orders list</a>
                            <a href="{{route('price.index')}}" class="dropdown-item"> price  list</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown">
                            <i class="fa fa-credit-card text-light" aria-hidden="true"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{route('payment.page')}}" class="dropdown-item">Make payment <i
                                    class="fa fa-calendar" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Nav Bar End -->
