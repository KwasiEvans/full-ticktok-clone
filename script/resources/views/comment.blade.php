@foreach($video->comments()->where('parent_id',null)->latest()->get() as $comment)
<div class="single-comment">
    <a class="pjax" href="{{ route('profile.show',$comment->user->slug) }}" onclick="profileshow()">
        <img src="{{ asset($comment->user->image) }}" alt="">
    </a>
    <span> 
        <a class="pjax" href="{{ route('profile.show',$comment->user->slug) }}" onclick="profileshow()">{{ $comment->user->username }}</a>{{ $comment->message }} 
        <div class="comment-info">
            <span>{{ $comment->created_at->isoFormat('Do') }} <span id="comment_like_count{{ $comment->id }}" class="likes"> {{ $comment->favourite_to_user->count() }}likes</span><a href="javascript:void(0)" onclick="reply('{{ $comment->id }}','{{ $comment->user->username }}','{{ $comment->user->id }}')">{{ __('Reply') }}</a></span>
        </div>
    </span>
    <input type="hidden" id="comment_like_url" value="{{ route('comment_like') }}">
    <div class="favourite-icon">
        @if(Auth::check())
        <a href="javascript:void(0)" onclick="comment_like('{{ $comment->id }}')"><i id="comment_like{{ $comment->id }}" class="{{ !Auth::User()->favourite_comments->where('pivot.comment_id',$comment->id)->count() == 0 ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
        @else
            <a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><i id="like" class="far fa-heart"></i></a>
        @endif
    </div>
</div>
@foreach($comment->replies as $value)
<div class="single-comment ml-50">
    <a class="pjax" href="{{ route('profile.show',$value->user->slug) }}" onclick="profileshow()">
        <img src="{{ asset($value->user->image) }}" alt="">
    </a>
    <span> 
        <a class="pjax" href="{{ route('profile.show',$value->user->slug) }}" onclick="profileshow()">{{ $value->user->username }}</a><br><a class="username" href="{{ $value->mention_id != null ? route('profile.show',$value->mention_user->slug) : '' }}" onclick="profileshow()">{{ $value->mention_id != null ? $value->mention_user->username : '' }}</a>{{ $value->message }} 
        <div class="comment-info">
            <span>{{ $value->created_at->isoFormat('Do') }} <span id="comment_like_count{{ $value->id }}" class="likes"> {{ $value->favourite_to_user->count() }}likes</span><a href="javascript:void(0)" onclick="reply('{{ $value->main_comment->id }}','{{ $value->user->username }}','{{ $value->user->id }}')">Reply</a></span>
        </div>
    </span>
    <div class="favourite-icon">
         @if(Auth::check())
        <a href="javascript:void(0)" onclick="comment_like('{{ $value->id }}')"><i id="comment_like{{ $value->id }}" class="{{ !Auth::User()->favourite_comments->where('pivot.comment_id',$value->id)->count() == 0 ? 'fas fa-heart' : 'far fa-heart' }}"></i></a>
        @else
            <a href="{{ route('login') }}" class="pjax" onclick="profileshow()"><i id="like" class="far fa-heart"></i></a>
        @endif
    </div>
</div>
@endforeach
@endforeach