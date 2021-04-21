<!DOCTYPE html>
<html lang="en">
@include('layouts.admin_layout.admin_head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('layouts.admin_layout.admin_header')

@include('layouts.admin_layout.admin_sidebar')

    @yield('content')

@include('layouts.admin_layout.admin_footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('layouts.admin_layout.admin_footerscript')
</body>
</html>
