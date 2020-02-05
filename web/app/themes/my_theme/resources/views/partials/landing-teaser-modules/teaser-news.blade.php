<div class="uk-width-1-1 uk-width-1-2@s uk-width-1-3@m uk-width-1-3@l">
  <a href="{{$object->url}}">
    <div class="iav-small-teaser news">
      @if(!empty($object->teaser_image))
        <img class="iav-teaser-event-img" src="{{$object->teaser_image['url']}}" alt="{{$object->teaser_image['alt']}}">
        <div class="iav-small-teaser-text-container-events"> 
      @else 
        <div class="iav-small-teaser-text-container-events-simple">       
      @endif
          @if(!empty($object->date_published))
          <div>
            <span>
              @if(!empty($object->post_type))
              @php
                  $post_type = ucwords($object->post_type);
              @endphp
                {{$post_type}}
              @else
                News
              @endif
            </span>
              @if (!empty($object->date_published))
                <span>– {{$object->date_published}}</span>
              @endif
          </div>
          @endif
          
          @if(!empty($object->title))
            <h3>{!!$object->title!!}</h3>
          @endif
        
          @if(!empty($object->teaser_text))
            <p class="iav-teaser-description">{{$object->teaser_text}}</p>
          @endif
      </div>
    </div>
  </a>
</div>
