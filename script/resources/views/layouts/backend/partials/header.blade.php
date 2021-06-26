<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    <div class="search-element">
      <input class="form-control" id="header_search" type="search" placeholder="Search" aria-label="Search" data-width="250">
      <button class="btn" type="submit"><i class="fas fa-search"></i></button>
      <div class="search-backdrop"></div>
      <div class="search-result">
        <div class="search-header">
          {{ __('Result') }}
        </div>
        <div class="search-item">
          <a href="{{ route('admin.dashboard') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/1.png') }}" alt="product">
            {{ __('Dashboard') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/settings/general') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/2.png') }}" alt="product">
            {{ __('Manage Settings') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/language/index') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/3.png') }}" alt="product">
            {{ __('Manage Languages') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/user/index') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/4.png') }}" alt="product">
            {{ __('Manage Users') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/video/index') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/5.png') }}" alt="product">
           {{ __('Manage Videos') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/sponsor') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/6.png') }}" alt="product">
           {{ __('Manage Sponsor') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/ads/index') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/7.png') }}" alt="product">
           {{ __('Manage Ads') }}
          </a>
        </div>
        <div class="search-item">
          <a href="{{ url('admin/page') }}">
            <img class="mr-3 rounded" width="30" src="{{ asset('backend/assets/img/products/8.png') }}" alt="product">
           {{ __('Manage Pages') }}
          </a>
        </div>
      </div>
    </div>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      @if(Auth::User()->image)
      <img alt="image" src="{{ asset(Auth::User()->image) }}" class="rounded-circle mr-1">
      @else
      <img alt="image" src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
      @endif
      <div class="d-sm-none d-lg-inline-block">{{ __('Hi') }}, {{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ url('edit/profile') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> {{ __('Profile') }}
        </a>
        <a href="{{ url('settings') }}" class="dropdown-item has-icon">
          <i class="fas fa-cog"></i> {{ __('Settings') }}
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('admin.logout') }}" class="dropdown-item has-icon text-danger">
          <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
        </a>
      </div>
    </li>
  </ul>
</nav>