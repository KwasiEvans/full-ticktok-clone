<header>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo-area">
                        <input type="hidden" id="logo_change_url" value="logo_change">
                        @php 
                        $option = App\Option::where('key','site_value')->first();
                        $option_value = json_decode($option->value);
                        @endphp
                        @if(Session::has('mode'))
                        @if(Session::get('mode')['id'] == 'night')
                         <a class="pjax" href="{{ route('welcome') }}"><img id="logo_mode" src="{{ asset($option_value->light_logo) }}" alt=""></a>
                        @else
                         <a class="pjax" href="{{ route('welcome') }}"><img id="logo_mode" src="{{ asset($option_value->dark_logo) }}" alt=""></a>
                        @endif
                        @else
                         <a class="pjax" href="{{ route('welcome') }}"><img id="logo_mode" src="{{ asset($option_value->dark_logo) }}" alt=""></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="header-search-area">
                        <div class="header-searchbox text-center">
                            <input type="text" placeholder="{{ __('Search') }}" id="search" oninput="search()" autocomplete="off">
                            <input type="hidden" id="search_url" value="{{ route('search') }}">
                            <input type="hidden" id="base_url" value="{{ url('/') }}">
                        </div>
                        <div class="search-append">

                        </div>
                    </div>
                </div>
                @php 
                $option_currency = App\Option::where('key','currency')->first();
                $option_currency_value = json_decode($option_currency->value);
                @endphp
                <input type="hidden" value="{{ env('PAYPAL_ID') }}" id="paypal_client_id">
                <input type="hidden" value="{{ $option_currency_value->code }}" id="currency_code">
                <div class="col-lg-3">
                    <div class="header-right-section f-right">
                        @if(Auth::check())
                        <div class="upload-btn">
                            @if(Session::has('mode'))
                            @if(Session::get('mode')['id'] == 'night')
                            <a class="pjax" href="{{ route('welcome') }}"><img id="home_mode" class="home" src="{{ asset('frontend/img/white_home.png') }}" alt=""></a>
                            @else
                            <a class="pjax" href="{{ route('welcome') }}"><img id="home_mode" class="home" src="{{ asset('frontend/img/home.png') }}" alt=""></a>
                            @endif
                            @else
                            <a class="pjax" href="{{ route('welcome') }}"><img id="home_mode" class="home" src="{{ asset('frontend/img/home.png') }}" alt=""></a>
                            @endif
                        </div>
                        <div class="upload-btn">
                            <div class="notification-menu">
                                @php 
                                $notifications = App\Notification::with('user')->where([
                                    ['parent_id',Auth::User()->id],
                                ])->orderBy('id','DESC')->get();
                                $notification_count = App\Notification::where([
                                    ['parent_id',Auth::User()->id],
                                    ['status','unread']
                                ])->get();
                                @endphp
                                @if(Session::has('mode'))
                                @if(Session::get('mode')['id'] == 'night')
                                <a href="#" onclick="notification_unread()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="notification_mode" src="{{ asset('frontend/img/white_notification.png') }}" alt=""></a>
                                @else
                                <a href="#" onclick="notification_unread()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="notification_mode" src="{{ asset('frontend/img/notification.png') }}" alt=""></a>
                                @endif
                                @else
                                <a href="#" onclick="notification_unread()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img id="notification_mode" src="{{ asset('frontend/img/notification.png') }}" alt=""></a>
                                @endif
                                <div class="notification-count">
                                    <span class="notification_count {{ $notification_count->count() > 0 ? '' : 'd-none' }}">{{ $notification_count->count() }}</span>
                                </div>
                                <div class="dropdown-menu dropdown-notification dropdown-menu-right">
                                    <div class="notification-check">
                                        @if($notifications->count() > 0)
                                        <div class="notification-title">
                                            <span>Notification</span>
                                        </div>
                                        <div class="notification-list">
                                            @include('layouts.frontend.section.notification',$notifications)
                                        </div>
                                        @else
                                        <div class="not-found text-center">
                                            <span>{{ __('No Result Found.') }}</span>
                                        </div>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="upload-btn">
                            @if(Session::has('mode'))
                            @if(Session::get('mode')['id'] == 'night')
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/white_upload.png') }}" alt=""></a>
                            @else
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/upload.png') }}" alt=""></a>
                            @endif
                            @else
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/upload.png') }}" alt=""></a>
                            @endif
                        </div>
                        <div class="profile-seeting">
                            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="profile" src="{{ asset(Auth::User()->image) }}" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a  href="{{ route('profile.show',Auth::User()->slug) }}" class="pjax dropdown-item">{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</a>
                                <a href="{{ route('profile.edit') }}" class="pjax dropdown-item">{{ __('Edit Profile') }}</a>
                                <a href="{{ route('settings') }}" class="pjax dropdown-item">{{ __('Settings') }}</a>
                                <div class="dropdown-border">
                                    <a href="{{ route('ads.index') }}" class="dropdown-item">{{ __('Advertising') }}</a>
                                </div>
                                <div class="dropdown-border">
                                    <a href="{{ route('trending') }}" class="pjax dropdown-item">{{ __('Trending') }}</a>
                                    <a href="{{ route('latest') }}" class="pjax dropdown-item">{{ __('Latest') }}</a>
                                    <a href="{{ route('popular') }}" class="pjax dropdown-item">{{ __('Most View') }}</a>
                                    <a href="{{ route('users') }}" class="pjax dropdown-item">{{ __('Find Users') }}</a>
                                </div>
                                @if(Auth::User()->role_id == 1)
                                <div class="dropdown-border">
                                    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">{{ __('Admin Panel') }}</a>
                                </div>
                                @endif
                                <div class="dropdown-border">
                                    <a href="{{ route('user.logout') }}" class="dropdown-item">{{ __('Logout') }}</a>
                                </div>
                                <div class="dropdown-border">
                                    <input type="hidden" id="mode_url" value="{{ route('mode') }}">
                                    @if(Session::has('mode'))
                                    @if(Session::get('mode')['id'] == 'day')
                                    <a href="#" id="mode_action" onclick="mode()" class="dropdown-item">{{ __('Night Mode') }} <div class="mode night"><i class="far fa-moon"></i></div></a>
                                    @endif
                                    @if(Session::get('mode')['id'] == 'night')
                                    <a href="#" id="mode_action" onclick="mode()" class="dropdown-item">{{ __('Day Mode') }} <div class="mode day"><i class="far fa-sun"></i></div></a>
                                    @endif
                                    @else
                                    <a href="#" id="mode_action" onclick="mode()" class="dropdown-item">{{ __('Night Mode') }} <div class="mode night"><i class="far fa-moon"></i></div></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="upload-btn">
                            @if(Session::has('mode'))
                            @if(Session::get('mode')['id'] == 'night')
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/white_upload.png') }}" alt=""></a>
                            @else
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/upload.png') }}" alt=""></a>
                            @endif
                            @else
                             <a class="pjax" href="{{ route('upload') }}"><img id="upload_mode" class="upload" src="{{ asset('frontend/img/upload.png') }}" alt=""></a>
                            @endif
                        </div>
                        <a href="{{ route('login') }}" class="btn login-btn pjax">{{ __('Login') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<input type="hidden" id="notification_url" value="{{ route('notification') }}">
<input type="hidden" id="notification_count" value="{{ route('notification_count') }}">
<input type="hidden" id="notification_unread" value="{{ route('notification_unread') }}">
