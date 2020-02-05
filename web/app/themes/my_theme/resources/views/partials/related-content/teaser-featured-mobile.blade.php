<div class="uk-slider-container">
    <ul class="uk-slider-items uk-child-width-1-3@l uk-child-width-1-2@m uk-child-width-1-1@s uk-grid">
      {{-- Scrapes through features stories for Mobile --}}
      @foreach ($featured_teaser as $item)
{{-- This is a list item used to create a slider!! --}}
@php
  $color = '';
  $boxsize = '';
  $uk_placement_class = '';
  $type = '';
  if(!empty($item->style_settings)) {
      if(!empty($item->style_settings['color'])) {
          $color = $item->style_settings['color'];
      }
      if(!empty($item->style_settings['placement'])) {
          $placement_class = $item->style_settings['placement'];
          if($placement_class === 'left') {
          $uk_placement_class = "uk-position-left";
          } elseif($placement_class === 'right') {
          $uk_placement_class = "uk-position-right";
          }
      }
      if(!empty($item->style_settings['box_size'])) {
          $box_size = $item->style_settings['box_size'];
      }

  }
  // Creates the Category Term
  if(!empty($item->post_type)){
      if($item->post_type === "events" && !($item->event_type) && is_string($item->event_type)) {
          $type = ucfirst($item->event_type);
      } elseif($item->post_type === "events" && !($item->event_type) && is_array($item->event_type)) {
          foreach($item->event_type as $event_type) {
              $eevent_type =  ucfirst($event_type->name) . ' ';
              $type .= $eevent_type;
          }
      } elseif (($item->post_type === "events") && (($item->event_type))) {
          $type = 'Events';
      } else {
          $type = ucfirst($item->post_type);
      } 
  }
  if(!empty($item->date)){
      $date = $item->date;
  }
@endphp
      @if($loop->index === 1)
        @include('partials.landing-teaser-modules.teaser-jobs')
      @else
        <li class="iav-small-teaser featured">
            {{--Picks up the background color for text box--}}
            <div class="iav-small-teaser {{$color}}">
                @if($item->is_not_event_or_news === 'event_or_news' && !empty($item->teaser_image))
                  <img  @if(!empty($item->teaser_image['url'])) src="{{$item->teaser_image['url']}}" @endif  @if(!empty($item->teaser_image['alt'])) alt="{{$item->teaser_image['alt']}}" @endif>
                @elseif($item->is_not_event_or_news === 'not_event_or_news' && !empty($item->featured_teaser_image))
                  <img  @if(!empty($item->featured_teaser_image['url'])) src="{{$item->featured_teaser_image['url']}}" @endif  @if(!empty($item->featured_teaser_image['alt'])) alt="{{$item->featured_teaser_image['alt']}}" @endif>
                @endif
                <div class="iav-small-featured-teaser-textbox {{$color}}">
                  @if(!empty($item->event_url) && !empty($item->template) && $item->template === 'views/template-simple-event.blade.php')
                    <a href="{{$item->event_url}}" target="_blank">
                  @elseif(!empty($item->url)) 
                    <a href="{{$item->url}}">   
                  @endif
                  @if(!empty($item->post_type) && $item->post_type === "events")
                    @if(!empty($item->event_type) && !empty($item->event_type[0]->name))
                      <p class="iav-post-type">{{$item->event_type[0]->name}}</p>
                    @else
                      <p class="iav-post-type">Event</p>
                   @endif
                  @elseif(!empty($item->post_type) && $item->post_type === "news")
                    <p class="iav-post-type">News @if(!empty($item->date_published))&mdash; {{$item->date_published}}@endif</p>
                  @elseif(!empty($item->post_type) && $item->post_type === "karriere")
                    <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Karriere @else Career @endif</p>
                  @elseif(!empty($item->post_type) && $item->post_type === "stories")
                    <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Was uns bewegt @else What moves us @endif</p>
                  @elseif(!empty($item->post_type) && $item->post_type === "employee_stories")
                    <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Wir bei IAV @else Wir bei IAV @endif</p>
                  @elseif(!empty($item->post_type) && $item->post_type === "company")
                    <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Über IAV @else About IAV @endif</p>
                  @elseif(!empty($item->post_type) && $item->post_type === "products")
                    @if(!empty($item->product_type) && !empty($item->product_type[0]->name))
                      <p class="iav-post-type">{{$item->product_type[0]->name}}</p>
                    @else
                      <p class="iav-post-type">Product</p>
                    @endif
                  @endif
                  @if($item->is_not_event_or_news === 'event_or_news')
                    @if(!empty($item->title))
                      <h4 class="iav-story-title">{!! $item->title !!}</h4>
                    @endif
                  @else
                    @if(!empty($item->featured_teaser_title))
                      <h4 class="iav-story-title">{!! $item->featured_teaser_title !!}</h4>
                    @endif
                  @endif
                    </div>
                  @if(!empty($item->event_url) || !empty($item->url))
                  </a>
                  @endif
            </div>
        </li>
      @endif
    @endforeach
  </ul>
</div>
<ul class="uk-slider-nav iav-teaser-navigation">
    @foreach ($featured_teaser as $item)
      @if($loop->index === 1)
      <li uk-slider-item="1"><a href="#"></a></li>
      @else
        <li uk-slider-item="{{$loop->index}}"><a href="#"></a></li>
      @endif
    @endforeach
</ul>