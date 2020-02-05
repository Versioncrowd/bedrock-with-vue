<div class="iav-related-content">
  <div class="uk-container">
    <div uk-grid class="uk-grid">
      @if(!empty($related_stories))
        @include('partials.related-content.related-stories')
      @endif
      @if(!empty($featured_teaser))
        @include('partials.related-content.featured-teaser')
      @endif
      @if(!empty($related_news))
        @include('partials.related-content.related-news')
      @endif
    </div>  
  </div>
</div>