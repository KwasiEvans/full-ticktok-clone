<footer class="mt-70">
    <div class="footer-area pt-25 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-left-area">
                        <div class="page-links">
                            @php 
                            $pages = App\Page::all();
                            @endphp
                            @foreach($pages as $page)
                            <a class="pjax" href="{{ route('page.show',encrypt($page->id)) }}">{{ $page->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php 
                $option = App\Option::where('key','site_value')->first();
                $site_value = json_decode($option->value);
                @endphp
                <div class="col-lg-6">
                    <div class="copyright-section f-right">
                        <p>{{ __('© copyright') }} {{ date('Y') }} {{ __('by') }} {{ $site_value->site_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>