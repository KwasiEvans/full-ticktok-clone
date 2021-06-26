<div class="col-lg-4 mb-25">
  <div class="video-card">
    <video id='{{ $video->slug ? $video->slug : $video->id }}' onclick="popup('{{ $video->slug ? $video->slug : $video->id }}')" loop muted="muted" onmouseover="mouseover('{{ $video->slug ? $video->slug : $video->id }}')" onmouseout="mouseout('{{ $video->slug ? $video->slug : $video->id }}')">
      <source src='{{ asset($video->url) }}' type='video/mp4'>
    </video>
    <div class="video-card-details-info">
      <div class="video-author-profile-img">
        <a class="pjax" href="{{ route('profile.show',$video->user->slug) }}"><img src="{{ asset($video->user->image) }}" alt=""></a>
      </div>
      <div class="video-total-view">
       <i class="fas fa-play"></i> {{ App\Helpers\UserSystemInfo::conveter($video->view) }}
     </div>
   </div>
   <div class="loader{{ $video->slug }} d-none">
     <div class="video-loader"></div>
   </div>
 </div>
</div>