<!DOCTYPE html>
    @include('layout.header')
    <body>
        @include('layout.navbar')
        
        @yield('content')
        @stack('scripts')
        <x-ajax/>
        @include('layout.footer')
    </body>
</html>