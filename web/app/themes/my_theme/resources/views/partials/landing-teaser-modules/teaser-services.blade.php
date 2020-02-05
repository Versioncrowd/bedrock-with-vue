@php
  // Trims text preview on teaser module
  $title = ($object->title);
  $teasertext = ($object->teaser_text);
  $headline = mb_strimwidth("$title", 0, 67, " ...");
  $excerpt = mb_strimwidth("$teasertext", 0, 200, " ...");
@endphp
<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
  <a href="">
      @if(!empty($object->teaser_image_vertical))
        <div class="iav-service-teaser" style="background-image: url({{$object->teaser_image_vertical['url']}});">
      @endif
  <div class="iav-service-overlay">
    @if(!empty($object->post_type))
    <div>
      @php
        $post_type = ucwords($object->post_type);
      @endphp
      {{$post_type}}
    </div>
    @endif
      @if(!empty($object->title))
        <h3>{{$headline}}</h3>
      @endif
      @if(!empty($object->teaser_text))
        <p class="service-teaser-text">{{$excerpt}}</p>
      @endif
      </div>
    </div>
  </a>
</div>
      