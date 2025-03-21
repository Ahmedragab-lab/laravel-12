<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() =='en' ? 'ltr':'rtl' }}">
    <head>
        @include('front.layouts.headcss')
        @livewireStyles
        @stack('css')
    </head>
    <body class="gradient-bg">
        @include('front.layouts.headermobile')
        @include('front.layouts.header')
        <main class="pt-90">
            @yield('content')
        </main>
        @include('front.layouts.footer')
        @include('front.layouts.footerjs')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- <x-livewire-alert::scripts /> --}}
        @stack('js')
    </body>
</html>
