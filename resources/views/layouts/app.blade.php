<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="skin-default-dark fixed-layout">
  <div id="app">
  <notifications position="top center" style="padding: 20px;"></notifications>
  <div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label title-logo">Wellcome To Kasiertansi</p>
    </div>
  </div>
  <div id="main-wrapper">
    <navbar></navbar>
    <sidebar></sidebar>
    <div class="page-wrapper">
      <div class="container-fluid">
        <app></app>
      </div>
    </div>
  </div>
  <footer class="footer font-italic text-muted" style="font-size: 13px">
      &copy; Kasiertansi 2019 zitech team;
  </footer>

  </div>
  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>
  @routes
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(document).ready(function() {
      setTimeout(function(){
        $('.preloader').fadeOut('slow', function() {
          $(this).remove();
        });
       }, 500);
    });
  </script>
</body>
</html>
