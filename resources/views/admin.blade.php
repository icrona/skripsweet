<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>
  
  <body id="page-top">
  
  @include('partials._nav')
  

  @yield('content')

  @include('partials_landing._footer')

  @include('partials._javascript')

  @yield('scripts')
  </body>
</html>