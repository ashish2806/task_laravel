
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <head>  
      <title>Laravel Task</title>

      @include('includes.css')
      @yield('customcss')
    </head>

    <body id="page-top">
      @yield('content')
      @include('includes.js');
      @yield('customjs')
    </body>

</html>
