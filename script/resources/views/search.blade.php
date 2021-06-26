<div class="search-content-area">
    @if($data->count() > 0)
    <div class="search-value">
        <nav>
            <ul>
                @foreach($data as $user)
                <li>
                    <a class="pjax" href="{{ route('profile.show',$user->slug) }}" onclick="user_search('{{ $user->username }}')">
                        <div class="single-search-content d-flex">
                            <div class="single-search-user-image">
                                <img src="{{ asset($user->image) }}">
                            </div> 
                            <div class="search-user-another-info d-block">
                                <h5>{{ $user->username }}</h5>
                                <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                            </div>  
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
    @else
    <div class="search-not-found text-center">
        <span>{{ __('No Result Found') }}</span>
    </div>
    @endif
</div>