@php 
$option = App\Option::where('key','site_value')->first();
$site_value = json_decode($option->value);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | {{ $site_value->site_name }}</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset($site_value->favicon) }}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/font.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/fontawesome.min.css') }}">
  @stack('css')
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
  
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('layouts.backend.partials.header')
      
      @include('layouts.backend.partials.sidebar')

      <!-- Main Content -->
      @yield('content')

      @include('layouts.backend.partials.footer')
    </div>
  </div>


  @include('sweetalert::alert')

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/jquery.nicescroll.min.js') }}"></script>
  @stack('js')
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
</body>
</html>
