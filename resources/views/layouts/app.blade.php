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
    <link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="skin-default-dark fixed-layout">
  <div id="app">
    <div class="preloader">
      <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label title-logo">Wellcome To Kasiertansi</p>
      </div>
    </div>
    <app></app>
  </div>
  <script>
      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};
  </script>
  @routes
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/jquerycustome.js') }}"></script>
  <script>
    $(document).ready(function() {
      setTimeout(function(){
        $('.preloader').fadeOut('slow', function() {
          $(this).remove();
        });
       }, 500);
      $(".btn-show-sidebar").on('click', function(event) {
        event.preventDefault();
        $('body').addClass('show-sidebar')
      });
      $(".btn-close-sidebar").on('click', function(event) {
        event.preventDefault();
        console.log('ok')
        $('body').removeClass('show-sidebar')
      });
    });
  </script>
</body>
</html>
