<script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sparklines/sparkline.js') }}"></script>
{{--<script src="{{ asset('backend/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>--}}
{{--<script src="{{ asset('backend/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>--}}
<script src="{{ asset('backend/assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/assets/dist/js/adminlte.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('backend/assets/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/assets/plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{ asset('backend/assets/dist/js/pages/dashboard.js') }}"></script>
@yield('custom_js')
