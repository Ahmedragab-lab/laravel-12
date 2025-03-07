<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('front.layouts.headcss')
        @stack('css')
    </head>
    <body class="gradient-bg">
        @include('front.layouts.headermobile')
        @include('front.layouts.header')
        <main>
            @yield('content')
        </main>
        @include('front.layouts.footer')
        @include('front.layouts.footerjs')
        @stack('js')
    </body>
</html>
