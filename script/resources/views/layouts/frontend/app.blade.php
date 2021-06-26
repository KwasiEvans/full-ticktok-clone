@php 
$option = App\Option::where('key','site_value')->first();
$site_value = json_decode($option->value);
@endphp
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | {{ $site_value->site_name }}</title>
    <meta name="description" content="{{ $site_value->site_description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($site_value->favicon) }}">
  
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nprogress.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/default.css') }}">
    @if(Session::has('mode'))
    @if(Session::get('mode')['id'] == 'night')
    <link id="mode" rel="stylesheet" href="{{ asset('frontend/css/dark.css') }}">
    @else
    <link id="mode" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @endif
    @else
    <link id="mode" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- loading area start -->
    <div class="loading d-none">
      <div class="loader-effect"></div>
    </div>
    <!-- loading area end -->

    
    <!-- header area start -->
    @include('layouts.frontend.partials.header')
    <!-- header area end -->

    <!-- main area start -->
    <div id="pjax-container">
        @yield('content')
    </div>
    <!-- main area end -->

    <!-- footer area start -->
    @include('layouts.frontend.partials.footer')
    <!-- footer area end -->

    <!-- JS here -->
    <script src="{{ asset('frontend/js/vendor/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/infinite-scroll.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.pjax.js') }}"></script>
    <script src="{{ asset('frontend/js/nprogress.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/custom-pjax.js') }}"></script>
    <script src="{{ asset('frontend/js/loadmore/loadmore.js') }}"></script>
    <script src="{{ asset('frontend/js/loadmore/videoloadmore.js') }}"></script>
    <script src="{{ asset('frontend/js/settings/settings.js') }}"></script>
    <script src="{{ asset('frontend/js/settings/customsettings.js') }}"></script>
    <script src="{{ asset('frontend/js/modal/modal.js') }}"></script>
    <script src="{{ asset('frontend/js/loadmore/userloadmore.js') }}"></script>
    @if(Auth::check())
    <script src="{{ asset('frontend/js/notification/notification.js') }}"></script>
    @endif
    @stack('js')
   
</body>

</html>