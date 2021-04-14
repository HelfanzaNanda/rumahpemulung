<!DOCTYPE html>
<html lang="en">

<head>
    @include('layoutadmin.header')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('layoutadmin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('layoutadmin.navbar')
            @yield('contents')

        </div>
        <!-- End of Main Content -->
    
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
            </footer>
            <!-- End of Footer -->
        
        </div>
        <!-- End of Content Wrapper -->
    
    </div>
    <!-- End of Page Wrapper -->

    @stack('scripts')
  
  @include('layoutadmin.footer')
</body>

</html>
