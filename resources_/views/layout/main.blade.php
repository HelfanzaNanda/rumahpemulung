<!DOCTYPE html>
    @include('layout.header')
    <body>
        @include('layout.navbar')
        @yield('content')
        @include('layout.footer')
    </body>
</html>