@php
    //var_dump($url);
@endphp

<button class="uk-align-center fwp-load-more">
  <a @if(!empty($url)) href="{{$url}}" @endif>
    @if(ICL_LANGUAGE_CODE=='de') Mehr laden @else Load more @endif
  </a>
</button>