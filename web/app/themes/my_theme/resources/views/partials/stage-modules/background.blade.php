@php
    //var_dump($image_large)
@endphp

@if(!empty($stage_type) && ($stage_type === 'image_small') && (!empty($stage_image_small)))
  <div class="iav-stage" @if(!empty($stage_image_small) && !empty($stage_image_small->url)) style="background-image: url({{$stage_image_small->url}});" @endif>
@elseif(!empty($stage_type) && ($stage_type === 'image_large') && (!empty($stage_image_large)))
  <div class="iav-stage iav-stage-large" @if(!empty($stage_image_large)) style="background-image: url({{$stage_image_large->url}});" @endif>
@elseif(!empty($stage_type) && ($stage_type === 'light_blue'))
  <div class="iav-stage iav-light-blue">
@elseif(!empty($stage_type) && ($stage_type === 'video_upload'))
  <div class="iav-stage iav-stage-large"  @if(!empty($stage_video_upload_poster) && !empty($stage_video_upload_poster->url)) style="background-image: url({{$stage_video_upload_poster->url}});" @endif>
        
@else
  <div class="iav-stage">
@endif  
  </div>

@if(!empty($stage_type) && ($stage_type === 'video_upload'))
  <div uk-lightbox video-autoplay="true" class="iav-video-play">
    <a href="{{$stage_video_upload->url}}" data-type="video" @if(!empty($stage_image_large)) data-image="{{$stage_image_large->url}}" @endif>
      <img src="@asset('images/play.svg')" alt="iav-play-button" />
    </a>
  </div>
@endif