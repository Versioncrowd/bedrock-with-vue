{{-- Scrapes through events --}}

@foreach($related_news as $newsorevent)
  @php
    //var_dump($newsorevent);
  @endphp 
  @if(!empty($newsorevent->post_type) && $newsorevent->post_type === 'events')
    @include('partials.related-content.related-events')
  @endif
  @if(!empty($newsorevent->post_type) && $newsorevent->post_type === 'news')
    @include('partials.related-content.related-news-single')
  @endif
@endforeach