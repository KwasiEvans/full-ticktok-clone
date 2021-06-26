<div class="col-lg-3">
    <div class="main-sidebar">
        <div class="suggest-account-area mb-25">
            <h4>{{ __('Suggested Accounts') }}</h4>
            
            @php 
            if (Auth::check()) {
                $trending_users = App\User::where([
                    ['role_id',2],
                    ['id','!=',Auth::User()->id]
                ])
                ->withCount('followers')
                ->withCount('videos')
                ->withCount('favourite_videos')
                ->orderBy('followers_count','desc')
                ->orderBy('videos_count','desc')
                ->orderBy('favourite_videos_count','desc')
                ->take('5')
                ->get();
                $suggested_users = App\User::where([
                    ['role_id',2],
                    ['id','!=',Auth::User()->id]
                ])->inRandomOrder()
                ->limit(5)
                ->get();
            }else{
                $trending_users = App\User::where('role_id',2)
                ->withCount('followers')
                ->withCount('videos')
                ->withCount('favourite_videos')
                ->orderBy('followers_count','desc')
                ->orderBy('videos_count','desc')
                ->orderBy('favourite_videos_count','desc')
                ->take('5')
                ->get();
                $suggested_users = App\User::where('role_id',2)
                ->inRandomOrder()->limit(5)
                ->get();
            }
            
            @endphp
            @foreach($suggested_users as $user)
            <div class="account-info">
                <div class="profile-info-sidebar">
                    <a href="{{ route('profile.show',$user->slug) }}" class="pjax d-flex">
                        <img src="{{ asset($user->image) }}" alt="">
                        <div class="profile-info d-block">
                            <h5>{{ Str::limit($user->first_name,6) }} {{ Str::limit($user->last_name,5) }}</h5>
                            <p>{{ Str::limit($user->username,14) }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @php 
        $sponsor = App\Sponsor::inRandomOrder()
        ->first();
        @endphp
        @if($sponsor)
        <div class="suggest-account-area mb-25">
            <a href="{{ $sponsor->url }}" target="_blank">
                <h4>{{ __('Sponsored') }}</h4>
                <div class="sponsor-img">
                    <img class="img-fluid" src="{{ asset($sponsor->image) }}">
                </div>
                <div class="sponsor-title">
                    <h5>{{  $sponsor->title }}</h5>
                    <p>{{ parse_url($sponsor->url)['host'] }}</p>
                </div>
            </a>
        </div>
        @endif
        <div class="suggest-account-area mb-25">
            <h4>{{ __('Trending Accounts') }}</h4>
            @foreach($trending_users as $user)
            <div class="account-info">
                <div class="profile-info-sidebar">
                    <a href="{{ route('profile.show',$user->slug) }}" class="pjax d-flex">
                        <img src="{{ asset($user->image) }}" alt="">
                        <div class="profile-info d-block">
                            <h5>{{ Str::limit($user->first_name,6) }} {{ Str::limit($user->last_name,5) }}</h5>
                            <p>{{ Str::limit($user->username,14) }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @php 
        $pages = App\Page::all();
        @endphp
        <div class="page-links">
            @foreach($pages as $page)
            <a class="pjax" href="{{ route('page.show',encrypt($page->id)) }}">{{ $page->title }}</a>
            @endforeach
        </div>
        @php 
        $option = App\Option::where('key','site_value')->first();
        $site_value = json_decode($option->value);
        @endphp
        <div class="lang-social-actions d-flex">
            <div class="social-actions">
                <ul>
                    <li><a target="_blank" href="{{ $site_value->facebook_url }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a target="_blank" href="{{ $site_value->twitter_url }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a target="_blank" href="{{ $site_value->google_url }}"><i class="fab fa-google-plus-g"></i></a></li>
                </ul>
            </div>
            @php 
            $language_file = file_get_contents(resource_path('json/lang.json'));
            $langs = json_decode($language_file);
            foreach ($langs as $key => $value) {
                if($value->code == App::getLocale())
                {
                    $default_lang = $value;
                }
            }
            @endphp
            <div class="select-language ml-auto">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $default_lang->name }}</a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-language">
                        @foreach(App\Language::where('status','active')->get() as $lang)
                        <a class="pjax dropdown-item" href="{{ route('lang.set',$lang->code) }}">{{ $lang->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-section">
            <p>{{ __('© copyright') }} {{ date('Y') }} {{ __('by') }} {{ $site_value->site_name }}</p>
        </div>
    </div>
</div>