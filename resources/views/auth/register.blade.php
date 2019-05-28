<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-4">
        <div id="logo-container" class="text-white text-center mb-3">SIGN UP</div>
        <div class="col-md-12 col-md-offset-1 p-0">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
              <input class="form-control" type="text" name='name' placeholder="name"
              value="{{ old('name') }}" required autofocus/>
               @if ($errors->has('name'))
              <span class="text-danger" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group">
              <input class="form-control" type="text" name='email' placeholder="email"
              value="{{ old('email') }}" required autofocus/>
               @if ($errors->has('email'))
              <span class="text-danger" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name='password' placeholder="password"
              value="{{ old('password') }}" required autofocus/>

               @if ($errors->has('password'))
              <span class="text-danger" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name='password_confirmation' placeholder="Password Confirmation"
              value="{{ old('password_confirmation') }}" required autofocus/>
               @if ($errors->has('password_confirmation'))
              <span class="text-danger" role="alert">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
              @endif
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> I agree to the <a href="#" class="btn-link">Terms and Conditions</a>
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-info btn-block">Sign Up</button>
              <button class="btn btn-outline-success btn-block login">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
  $(document).ready(function() {
    $('.login').on('click', function(event) {
      console.log('ok')
      window.location = '/login'
      event.preventDefault()
    });
  });
</script>
</body>
</body>
