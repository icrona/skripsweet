<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials_landing._head')
  </head>
  
  <body id="page-top">
  
  @include('partials_landing._nav1')

  @yield('content')

  @include('partials_landing._footer')

  @include('partials_landing._javascript')

  @yield('scripts')
  </body>
</html>