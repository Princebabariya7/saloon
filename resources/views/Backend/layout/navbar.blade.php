<nav class="main-header navbar navbar-expand navbar-white navbar-light pt-0 pb-0">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars left-toogle"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('dashboard.index')}}" class="nav-link">Home</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="#" class="nav-link text-danger" title="Logout" role="button" onclick="confirmLogout()">
                <i class="fa fa-power-off left-toogle"></i>
            </a>
        </li>
    </ul>
</nav>
<script>
    function confirmLogout()
    {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will be logged out',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed)
            {
                window.location.href = "{{ route('admin.logout') }}";
            }
        });
    }
</script>
