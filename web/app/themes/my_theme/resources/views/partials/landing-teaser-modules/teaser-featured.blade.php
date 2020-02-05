@php
  // Trims text preview on teaser module
  $title = ($object->title);
  $teasertext = ($object->teaser_text);
  $headline = mb_strimwidth("$title", 0, 67, " ...");
  $excerpt = mb_strimwidth("$teasertext", 0, 200, " ...");
@endphp

<div class="uk-width-2-3@m uk-width-1-2@s uk-width-1-1"> 
  <a href="{{$object->url}}">
    <div class="iav-big-teaser features" @if(!empty($object->teaser_image))style="background-image: url({{$object->teaser_image['url']}});" @endif>
      @php
      $placement = " ";
        if(!empty($object->teaser_text_placement)) {
          $placement = $object->teaser_text_placement;
        }
      @endphp
      <div class="iav-big-teaser-text-container {{$placement}}">
        @if(!empty($object->featured_tags))
          <div>
            @php
              $taxonomy = ucwords($object->featured_tags[0]->name);
            @endphp
          {{$taxonomy}}
        </div>
        @endif
        @if(!empty($object->title))
          <h3>{{$headline}}</h3>
        @endif
        @if(!empty($object->teaser_text))
          <p class="iav-teaser-description">{{$excerpt}}</p>
        @endif
      </div>
    </div>
  </a>
</div>