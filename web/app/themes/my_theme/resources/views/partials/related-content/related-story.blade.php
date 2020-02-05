{{-- This is a list item used to create a slider!! --}}
@php
  // Trims text preview on teaser module
  if(!empty($item->title)) {
    $title = ($item->title);
    $headline = mb_strimwidth("$title", 0, 67, " ...");
  }

  if(!empty($item->teaser_text)) {
    $teasertext = ($item->teaser_text);
    $excerpt = mb_strimwidth("$teasertext", 0, 200, " ...");
  }
  
  if(!empty($item->post_type)) {
    if($item->post_type === "employee_stories") {
      if(ICL_LANGUAGE_CODE=='de') {
        $post_type = "Kopf & Herz – Portrait";
      } else {
        $post_type = "Brain & heart – portrait";
      }
    } else {
      $post_type = ucfirst($item->post_type);
    }
    
  }
@endphp

<a @if(!empty($item->url)) href="{{$item->url}}" @endif>
  <li>
    <div class="iav-story-teaser" @if(!empty($item->teaser_image_vertical)) style="background-image: url({{$item->teaser_image_vertical['url']}});" @endif>
      {{-- Image does not scale properly to container, needs to be fixed... --}}
      <div class="iav-story-overlay">
        <div>
          @if(!empty($item->post_type))
            {{$post_type}}
          @endif
        </div>
        @if(!empty($item->title))
          <h3>{{$headline}}</h3>
        @endif
        @if(!empty($item->teaser_text))
          <p class="story-teaser-text">{{$excerpt}}</p>
        @endif
      </div>
    </div>
  </li>
</a>