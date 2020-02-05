{{-- This is a list item used to create a slider!! --}}
@php
  if(!empty($newsorevent->event_start_date) && !empty($newsorevent->event_end_date)) {
    $newsorevent->event_start_date = date("d.m.", strtotime($newsorevent->event_start_date));
  }

  //var_dump($newsorevent->template);
@endphp
<a href="@if(!empty($newsorevent->event_url) && !empty($newsorevent->event_url['url']) && !empty($newsorevent->template) && $newsorevent->template === 'views/template-simple-event.blade.php') {{$newsorevent->event_url['url']}} @elseif(!empty($newsorevent->url)) {{$newsorevent->url}} @endif" @if(!empty($newsorevent->event_url)) target="_blank" @endif>
  <li>
    <div class="iav-small-teaser events @if(!empty($iscareer)) career @endif">
      @if(!empty($newsorevent->teaser_image))
        <img class="iav-teaser-event-img"  src="{{$newsorevent->teaser_image['url']}}" alt="{{$newsorevent->teaser_image['alt']}}">
        <div class="iav-small-teaser-text-container-events"> 
      @else 
        <div class="iav-small-teaser-text-container-events-simple">   
      @endif
      <div>
        @if(!empty($newsorevent->event_type))
          @foreach ($newsorevent->event_type as $type)
            @if($loop->last)
              {{$type->name}}
            @else
              {{$type->name}},
            @endif
          @endforeach
        @else
          Event  
        @endif
      </div>
      @if(!empty($newsorevent->event_start_date))
        <div class="iav-teaser-event-dates">
          @if(empty($newsorevent->event_date_freeform))
            <span>{{$newsorevent->event_start_date}}</span>
              @if(!empty($newsorevent->event_end_date))
                <span>– {{$newsorevent->event_end_date}}</span>
              @endif &mdash;
          @elseif(!empty($newsorevent->event_date_freeform) && empty($newsorevent->event_end_date))
            <span>{{$newsorevent->event_date_freeform}}</span> &mdash;
          @endif
        </div>
      @endif
      @if(!empty($newsorevent->title))
        <h3>{!! $newsorevent->title !!}</h3>
      @endif
      @if(!empty($newsorevent->event_location))
        <div class="iav-event-teaser-location">
          <p>{{$newsorevent->event_location}}</p>
        </div>
      @endif
      @if(!empty($newsorevent->teaser_text))
        <p class="iav-teaser-description">{{$newsorevent->teaser_text}}</p>
      @endif
      </div>
    </div>
  </li>
</a>