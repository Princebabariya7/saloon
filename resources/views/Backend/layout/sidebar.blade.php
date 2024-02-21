<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('dashboard.index')}}" class="brand-link">
        <h2 class="text-center saloon_logo">Hairec Saloon</h2>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/assets/img/testimonial-3.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->firstname }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ Route::is('dashboard.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard.index') }}"
                       class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.appointment.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.appointment.index') }}"
                       class="nav-link {{ Route::is('admin.appointment.index') ? 'active' : '' }} {{Request::segment(2) == 'appointment' ? 'active' :'' }} {{Request::segment(2) == 'orders_details' ? 'active' :'' }} {{Request::segment(2) == 'appointment_details' ? 'active' :'' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Appointments
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.category.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.category.index') }}"
                       class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }} {{Request::segment(2) == 'category' ? 'active' :'' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.service.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.service.index') }}"
                       class="nav-link {{ Route::is('admin.service.index') ? 'active' : '' }} {{Request::segment(2) == 'service' ? 'active' :'' }}">
                        <i class="nav-icon fas fa-cut"></i>
                        <p>
                            Services
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.gallery.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.gallery.index') }}"
                       class="nav-link {{ Route::is('admin.gallery.index') ? 'active' : '' }} {{Request::segment(2) == 'gallery' ? 'active' :'' }}">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.payment.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.payment.index') }}"
                       class="nav-link {{ Route::is('admin.payment.index') ? 'active' : '' }} {{Request::segment(2) == 'payment' ? 'active' :'' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            Payment
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.user.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.user.index') }}"
                       class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
