</div>
<!-- /.content-wrapper -->





<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>System Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; {{date('Y')}} <a href="https://www.facebook.com/mdimranhossaingd" target="_blank">MD IMRAN HOSSAIN</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
@if ($success = session()->get('success'))
<script>
    toastr.success('{{ $success }}')
</script>
@endif
@if ($error = session()->get('error'))
<script>
    toastr.success('{{ $error }}')
</script>
@endif
@yield('script')
</body>

</html>
