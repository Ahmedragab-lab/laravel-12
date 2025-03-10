{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        {{ $slot }}
    </body>
</html>

<!DOCTYPE html> --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() =='en' ? 'ltr':'rtl' }}">
{{-- <html lang="{{ app()->getLocale() }}" dir="rtl"> --}}
  <head>
    @include('admin.layouts.headcss')
    {{-- @livewireStyles --}}
    @stack('css')
  </head>
  <body class="app sidebar-mini">
     @include('admin.layouts.navbar')
     @include('admin.layouts.sidebar')
      <main class="app-content">
         {{ $slot }}
      </main>
     @include('admin.layouts.footerjs')
     {{-- @livewireScripts --}}
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <x-livewire-alert::scripts />
     @stack('js')
  </body>
</html>
