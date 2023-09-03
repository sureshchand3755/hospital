<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layout.partials.head')
  </head>

  <body>

 @include('layout.partials.nav')

        @include('layout.partials.header')
        @include('layout.partials.footer-scripts')
 @yield('content')
    </div>
  </body>
</html>
