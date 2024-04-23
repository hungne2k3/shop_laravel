<!-- /.login-box -->

<!-- jQuery -->
<script src={{ asset('template/admin/plugins/jquery/jquery.min.js') }}></script>
<!-- Bootstrap 4 -->
<script src={{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
<!-- AdminLTE App -->
<script src={{ asset('template/admin/dist/js/adminlte.min.js') }}></script>

{{-- link file js --}}
<script src={{ asset('template/admin/js/main.js') }}></script>
@toastifyJs

<!-- AdminLTE -->
<script src="{{ asset('template/admin/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('template/admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('template/admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('template/admin/dist/js/pages/dashboard3.js') }}"></script>
@yield('footer')
