<div class="uk-width-3-3 iav-featured-news-teaser">
    <h4 class="featured-subtitle">@if(ICL_LANGUAGE_CODE=='de') IAV Aktuell @else IAV up-to-date @endif</h4>
  {{-- Inserts UI Kit slider with related news and events  --}}
  <div uk-slider="autoplay: true; autoplay-interval: 2500; pause-on-hover: true">
      <div class="uk-position-relative">
        <div class="uk-slider-container">
          <ul class="uk-slider-items uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-1 uk-grid">
            @include('partials.related-content.related-newsevents')
          </ul>
        </div>
        <ul class="uk-slider-nav iav-teaser-navigation">
          @foreach ($related_news as $item)
            @if(!empty($item->teaser_image))
                <li uk-slider-item="{{$loop->index}}"><a href="#"></a></li>
            @endif
          @endforeach
        </ul>
    </div>
</div>
  <div class="iav-related-news-link">
    <a class="iav-arrow-link" @if(ICL_LANGUAGE_CODE=='de') href="/events-suche/" @else href="/en/events-suche/" @endif >
      @if(ICL_LANGUAGE_CODE=='de') Alle News & Termine @else All news & events @endif
    </a>
  </div>
</div>