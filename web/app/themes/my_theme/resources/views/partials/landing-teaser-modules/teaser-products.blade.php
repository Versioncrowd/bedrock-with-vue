@php
  // Trims text preview on teaser module
  $title = ($object->title);
  $teasertext = ($object->teaser_text);
  $headline = mb_strimwidth("$title", 0, 67, " ...");
  $excerpt = mb_strimwidth("$teasertext", 0, 200, " ...");
  //var_dump($object);
@endphp
  
  <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
  <a href="{{$object->url}}">  
    @if(!empty($object->teaser_image_vertical))
      <div class="iav-product-teaser" style="background-image: url({{$object->teaser_image_vertical['url']}});">
        @endif
        <div class="iav-product-overlay">
          @if(!empty($object->product_type))
            <div>
              {{$object->product_type}}
            </div>
          @else
            <div>
              @if(ICL_LANGUAGE_CODE=='de')
                Produkte
              @else
                Products
              @endif  
            </div>
          @endif
          @if(!empty($object->title))
            <h3>{{$headline}}</h3>
          @endif

          @if(!empty($object->teaser_text))
            <p class="product-teaser-text">{{$excerpt}}</p>
          @endif
        </div>
    @if(!empty($object->teaser_image_vertical))
      </div>
    @endif
    </a>
  </div>