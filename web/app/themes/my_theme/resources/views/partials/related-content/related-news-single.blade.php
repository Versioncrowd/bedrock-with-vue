<a href="{{$newsorevent->url}}">
  <li>
    <div class="iav-small-teaser news @if(!empty($iscareer)) career @endif" >
      @if(!empty($newsorevent->teaser_image))
        <div class="iav-small-teaser-img" style="background-image: url({{$newsorevent->teaser_image['url']}});"></div>
        {{-- <img class="iav-teaser-event-img" src="{{$newsorevent->teaser_image['url']}}" alt="{ {$newsorevent->teaser_image['alt']}}"> --}}
        <div class="iav-small-teaser-text-container-events">
      @else 
        <div class="iav-small-teaser-text-container-events-simple">  
      @endif
        <div>
          <span>
            News
          </span>
            @if (!empty ($newsorevent->date_published))
              <span>– {{$newsorevent->date_published}}</span>
            @endif
        </div>
        @if(!empty($newsorevent->title))
          <h3>{{$newsorevent->title}}</h3>
        @endif
        @if(!empty($newsorevent->teaser_text))
          <p class="iav-teaser-description">{{$newsorevent->teaser_text}}</p>
        @endif
      </div>
    </div>
  </li>
</a>