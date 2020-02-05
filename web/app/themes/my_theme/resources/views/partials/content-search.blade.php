<article @php post_class() @endphp >
 
  @if (get_post_type() === 'stories') 
    @include('partials/search/search-results')
  @elseif (get_post_type() === 'events')
    @include('partials/search/search-results')
  @elseif (get_post_type() === 'news')
    @include('partials/search/search-results') 
  @endif
  
</article>

