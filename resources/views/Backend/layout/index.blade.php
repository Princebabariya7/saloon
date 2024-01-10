<html>
<html lang="en">
@include('Backend.layout.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('Backend.layout.navbar')
    @include('Backend.layout.sidebar')
    @yield('content')
</div>
@include('Backend.layout.footer')
@include('Backend.layout.script')
</body>
</html>

