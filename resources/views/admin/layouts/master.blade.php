<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() =='en' ? 'ltr':'rtl' }}">
{{-- <html lang="{{ app()->getLocale() }}" dir="rtl"> --}}
  <head>
    @include('admin.layouts.headcss')
    @livewireStyles
    @vite('resources/css/app.css')
    @stack('css')
  </head>
  <body class="app sidebar-mini">
    @include('include.flash')
     {{-- @include('sweetalert::alert') --}}
     @include('admin.layouts.navbar')
     @include('admin.layouts.sidebar')
     <main class="app-content">
        @yield('content')
      </main>
     @include('admin.layouts.footerjs')
     @livewireScripts
     @vite('resources/js/app.js')
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     {{-- <x-livewire-alert::scripts /> --}}
     @stack('js')
  </body>
</html>
