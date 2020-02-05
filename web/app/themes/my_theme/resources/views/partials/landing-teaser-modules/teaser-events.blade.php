@php
  if(!empty($object->event_start_date) && !empty($object->event_end_date)) {
    $object->event_start_date = date("d.m.", strtotime($object->event_start_date));
  }
@endphp

<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
  @if(!empty($object->event_url) && !empty($object->event_url['url'] && !empty($object->template) && $object->template === 'views/template-simple-event.blade.php'))
    <a href="{{$object->event_url['url']}}" target="_blank">
  @elseif(!empty($object->url))
    <a href="{{$object->url}}">
  @endif    
  <div class="iav-small-teaser events">
    @if(!empty($object->teaser_image))
      <img class="iav-teaser-event-img" src="{{$object->teaser_image['url']}}" alt="{{$object->teaser_image['alt']}}">
      <div class="iav-small-teaser-text-container-events"> 
    @else 
      <div class="iav-small-teaser-text-container-events-simple"> 
    @endif
      <div>
        @if(!empty($object->event_type))
          @foreach ($object->event_type as $type)
            @if ($loop->last)
              {{$type->name}}
            @else
              {{$type->name}},&nbsp; 
            @endif
          @endforeach
        @else
          Event  
        @endif
      </div>
      @if(!empty($object->event_start_date))
        <div class="iav-teaser-event-dates">
          @if(empty($object->event_date_freeform))
            <span>{{$object->event_start_date}} @if(empty($object->event_end_date))&mdash;@endif</span>
            @if(!empty($object->event_end_date))
               <span>- {{$object->event_end_date}} &mdash;</span> 
            @endif
          @elseif(!empty($object->event_date_freeform))
            <span>{{$object->event_date_freeform}} &mdash;</span>
          @endif
        </div>
      @endif
    
      @if(!empty($object->title))
         <h3>{!!$object->title!!}</h3>
      @endif
    
      @if(!empty($object->event_location))
        <div class="iav-event-teaser-location">
          <p>{{$object->event_location}}</p>
        </div>
      @endif
      
      @if(!empty($object->teaser_text))
        <p class="iav-teaser-description">{{$object->teaser_text}}</p>
      @else
        <p class="iav-teaser-description">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      @endif
    </div>
  </div>
  @if(!empty($object->event_url) || !empty($object->url))
  </a>
  @endif
</div>