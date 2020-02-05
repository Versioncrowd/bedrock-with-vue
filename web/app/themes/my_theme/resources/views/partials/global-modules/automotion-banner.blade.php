@php
  $object = $automotion_banner;
@endphp

@if((!empty($object['teaser_topics_headline'])) || (!empty($object['teaser_topics_link'])) || (!empty($object['teaser_topics_background_image']))) 
<div class="iav-teaser-topics iav-automotion-banner" @if(!empty($object['teaser_topics_background_image'])) style="background-image: url({{$object['teaser_topics_background_image']['url']}});" @endif>
  <div class="uk-container">
    @if(!empty($object['teaser_topics_link']) &&  !empty($object['teaser_topics_link']['url'])) 
      <a class="uk-width-3-4@s" href="{{$object['teaser_topics_link']['url']}}">
    @endif
    <div class="iav-teaser-topics-bc">
      <div class="uk-grid" uk-grid>
        <div class="uk-width-3-3 uk-width-3-4@m">
          <div class="iav-teaser-topics-inner">
            @if(!empty($object['teaser_topics_headline'])) 
              <h2>
                @if(!empty($object['teaser_topics_headline'])) 
                  {!!$object['teaser_topics_headline']!!}
                @endif
              </h2>
            @endif
            @if(!empty($object['teaser_topics_link'])) 
              <a class="iav-teaser-topics-link" href="{{$object['teaser_topics_link']['url']}}">{{$object['teaser_topics_link']['title']}}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    @if(!empty($object['teaser_topics_link']) && !empty($object['teaser_topics_link']['url']))
      </a>
    @endif
  </div>
</div>
@endif