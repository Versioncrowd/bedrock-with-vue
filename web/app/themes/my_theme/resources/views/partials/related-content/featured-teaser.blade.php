<div class="uk-width-3-3">
  <div class="iav-featured-teaser-slider">
    <h4 class="featured-subtitle">
      @if(ICL_LANGUAGE_CODE=='de')
        Mehr von IAV
      @else
        More about IAV
      @endif
    </h4>
    {{-- Creates full width slide show that appears >=small breakpoint--}}
      @include('partials.related-content.teaser-featured')
    {{-- Creates mobile slider that appears <=small breakpoint--}}
      <div class="uk-hidden@s" uk-slider="autoplay: true; autoplay-interval: 2500; pause-on-hover: true">
        <div class="uk-position-relative">
        @include('partials.related-content.teaser-featured-mobile')
      </div>
    </div>
  </div>
</div>