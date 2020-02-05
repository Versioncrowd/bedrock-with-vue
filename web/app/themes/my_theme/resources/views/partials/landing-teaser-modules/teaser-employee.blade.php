@php
  // Trims text preview on teaser module
  $title = ($object->title);
  $teasertext = ($object->teaser_text);
  $headline = mb_strimwidth("$title", 0, 67, " ...");
  $excerpt = mb_strimwidth("$teasertext", 0, 200, " ...");
@endphp
<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
  @if(!empty($object->teaser_image_vertical))
    <a href="{{$object->url}}"><div class="iav-story-teaser" @if(!empty($object->teaser_image_vertical['url'])) style="background-image: url({{$object->teaser_image_vertical['url']}});" @endif>
  @endif
    <div class="iav-story-overlay iav-employee-overlay">
      <div>
        @if(ICL_LANGUAGE_CODE=='de')
          Kopf & Herz – Portrait
        @else
          Brain & heart - portrait
        @endif
      </div>
      @if(!empty($object->title))
        <h3>{{$headline}}</h3>
      @endif
      @if(!empty($object->teaser_text))
        <p class="story-teaser-text">{{$excerpt}}</p>
      @endif
    </div>
  @if(!empty($object->teaser_image_vertical))
    </div>
  </a>
  @endif
</div>
