<div class="uk-width-3-3">
  {{-- @php
      var_dump ($related_stories)
  @endphp --}}
  <h4 class="featured-subtitle">
    @if(ICL_LANGUAGE_CODE=='de')
      Was uns bewegt
    @else
      What moves us
    @endif
  </h4>
</div>
 {{-- Inserts UI Kit slider with related stories  --}}
<div uk-slider="autoplay: true; autoplay-interval: 2500; pause-on-hover: true" class="uk-width-3-3">
  <div class="uk-position-relative">
    <div class="uk-slider-container">
      <ul class="uk-slider-items uk-child-width-1-3@l uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-1 uk-grid">
        @foreach ($related_stories as $item)
          {{-- @if(!empty($item->teaser_image_vertical)) --}}
            @include('partials.related-content.related-story')
          {{-- @endif --}}
        @endforeach  
      {{-- <a class="uk-position-center-left-out" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
      <a class="uk-position-center-right-out" href="#" uk-slidenav-next uk-slider-item="next"></a> --}}
    </div>
    <ul class="uk-slider-nav iav-teaser-navigation">
      @foreach ($related_stories as $item)
        {{-- @if(!empty($item->teaser_image_vertical)) --}}
            <li uk-slider-item="{{$loop->index}}">
              <a href="#">
              </a>
            </li>
        {{-- @endif --}}
      @endforeach
    </ul>
  </div>
</div>