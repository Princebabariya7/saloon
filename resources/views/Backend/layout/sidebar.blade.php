<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.index')}}" class="brand-link">
        <h2 class="text-center saloon_logo">Hairec Saloon</h2>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/assets/img/testimonial-3.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.profile') }}" class="d-block">{{ auth()->user()->firstname }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item {{ Route::is('dashboard.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ Route::is('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.appointment.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.appointment.index') }}" class="nav-link {{ Route::is('admin.appointment.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Appointments
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.category.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.service.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.service.index') }}" class="nav-link {{ Route::is('admin.service.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cut"></i>
                        <p>
                            Services
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.gallery.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ Route::is('admin.gallery.index') ? 'active' : '' }}">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ Route::is('admin.price.index') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.price.index') }}" class="nav-link {{ Route::is('admin.price.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Prices
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
