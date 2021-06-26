<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('admin.dashboard') }}">{{ Str::limit(config('app.name'),2) }}</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>{{ __('Dashboard') }}</span></a></li>
      <li class="menu-header">{{ __('Settings & Language') }}</li>
      <li class="nav-item dropdown {{ Request::is('admin/settings*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>{{ __('Settings') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/settings/general') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}">{{ __('General Settings') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/settings/sitesettings') ? 'active' : '' }}" href="{{ route('admin.settings.sitesettings') }}">{{ __('Site Settings') }}</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ Request::is('admin/language*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-globe"></i> <span>{{ __('Language') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/language/create') ? 'active' : '' }}" href="{{ route('admin.language.create') }}">{{ __('Add New Language') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/language/index') ? 'active' : '' }}" href="{{ route('admin.language.index') }}">{{ __('Manage Languages') }}</a></li>
        </ul>
      </li>
      <li class="menu-header">{{ __('management') }}</li>
      <li class="nav-item dropdown {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>{{ __('Users') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/user/index') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">{{ __('Manage Users') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/user/report') ? 'active' : '' }}" href="{{ route('admin.user.report') }}">{{ __('Manage Reports') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/user/verification') ? 'active' : '' }}" href="{{ route('admin.user.verification.request') }}">{{ __('Verification Request') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/user/monetization/request') ? 'active' : '' }}" href="{{ route('admin.monetization.index') }}">{{ __('Monetization Request') }}</a></li>
          
          <li><a class="nav-link {{ Request::is('user/pending/request*') ? 'active' : '' }}" href="{{ route('admin.user.pending') }}">{{ __('Approved Request') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/user/withdraw/request') ? 'active' : '' }}" href="{{ route('admin.withdraw.index') }}">{{ __('Withdraw Request') }}</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ Request::is('admin/video*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-play-circle"></i> <span>{{ __('Videos') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/video/index') ? 'active' : '' }}" href="{{ route('admin.video.index') }}">{{ __('Manage Videos') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/video/report') ? 'active' : '' }}" href="{{ route('admin.video.report') }}">{{ __('Manage Reports') }}</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ Request::is('admin/sponsor*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-project-diagram"></i> <span>{{ __('Sponsor') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/sponsor/create') ? 'active' : '' }}" href="{{ route('admin.sponsor.create') }}">{{ __('Add New Sponsor') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/sponsor') ? 'active' : '' }}" href="{{ route('admin.sponsor.index') }}">{{ __('Manage Sponsor') }}</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown {{ Request::is('admin/ads*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-ad"></i> <span>{{ __('Manage Ads') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/ads/index') ? 'active' : '' }}" href="{{ route('admin.ads.index') }}">{{ __('Manage Ads') }}</a></li>
        </ul>
      </li>
      <li class="menu-header">{{ __('Pages') }}</li>
      <li class="nav-item dropdown {{ Request::is('admin/page*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>{{ __('Page') }}</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link {{ Request::is('admin/page/create') ? 'active' : '' }}" href="{{ route('admin.page.create') }}">{{ __('Add New Page') }}</a></li>
          <li><a class="nav-link {{ Request::is('admin/page') ? 'active' : '' }}" href="{{ route('admin.page.index') }}">{{ __('Manage Page') }}</a></li>
        </ul>
      </li>
       <li><a class="nav-link" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt"></i> <span>{{ __('Logout') }}</span></a></li>
    </ul>
  </aside>
</div>