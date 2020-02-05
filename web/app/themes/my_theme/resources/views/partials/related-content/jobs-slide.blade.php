<li class="iav-jobs-slide">
  <div>
    @if(!empty($item['small_tagline_top']))
    <p class="iav-jobs-slide-cat">{{$item['small_tagline_top']}}</p>
    @endif
    @if(!empty($item['main_text']))
      <p class="iav-jobs-slide-text">
        {{-- @if(!empty($jobs_tab))
          <span class="iav-jobs-slide-number">{{ $jobs_tab }}</span><br/>
        @endif --}}
        {{$item['main_text']}}
      </p>
    @endif
    @if(!empty($item['link']))
      <a class="iav-jobs-slide-link" href="{{$item['link']['url']}}">{{$item['link']['title']}}</a>
    @endif
  </div>
  <div></div>
  <div></div>
  <div></div>
  <div></div>
</li>