{{--
  Template Name: Template Teaser Vue
  Template Post Type: stories
--}}

@extends('layouts.app') 
@section('content')
@include('partials.stage-modules.jobs-tab') 
@while(have_posts()) @php the_post() @endphp
  @include('partials.stage-modules.background')
    @if(!empty($stage_type) && ($stage_type === 'image_large') && (!empty($stage_image_large)))
      <div class="uk-container uk-container-center iav-stage-container iav-header iav-header-large">
    @else
      <div class="uk-container uk-container-center iav-header">
    @endif
      <div class="uk-grid" uk-grid>
        @if((!empty($title)) || (!empty($introtext)))
          @include('partials.stage-modules.header')
        @endif
      </div>
    </div>

    @if(!empty($teaser))
    @php
        //var_dump($teaser);
    @endphp
      <div class="uk-container">
          <div uk-grid class="uk-grid iav-teaser-main" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 350">
            @foreach($teaser[0] as $object)
              @if(!empty($object->post_type) && $object->post_type === 'stories' && !empty($object->featured_tags))
                {{-- Specific cases for amount of featured stories --}}
                {{-- If only 1, inserts featured story followed by the jobs section --}}
                @if($teaser[1] === 1)
                  @include('partials.landing-teaser-modules.teaser-featured')
                  @include('partials.landing-teaser-modules.teaser-jobs')
                {{-- If 2, inserts featured story followed by the 2nd AS SMALL STORY --}}
                @elseif($teaser[1] === 2)
                  @if ($loop->index === 0)
                    @include('partials.landing-teaser-modules.teaser-featured')
                  @endif
                  @if ($loop->index === 1)
                    @include('partials.landing-teaser-modules.teaser-small-featured')
                    @include('partials.landing-teaser-modules.teaser-jobs')
                  @endif
                {{-- If 3, inserts featured story followed by the 2nd AS SMALL STORY, jobs section and then a big featured story. Any featured stories beyond that are added as small stories --}}
                @elseif($teaser[1] === 3)
                  @if ($loop->index === 0)
                    @include('partials.landing-teaser-modules.teaser-featured') 
                  @elseif ($loop->index === 1)
                    @include('partials.landing-teaser-modules.teaser-small-featured')
                    @include('partials.landing-teaser-modules.teaser-jobs')
                  @elseif($loop->index === 2)
                    @include('partials.landing-teaser-modules.teaser-featured')
                  @endif 
                {{-- If 3 or more, Any featured stories beyond that are added as small stories --}}
                @elseif(($loop->index) > 3)
                  @include('partials.landing-teaser-modules.teaser-small-featured')
                @endif
              @endif
    
              @if(!empty($object->post_type) && $object->post_type === 'events')
              @php
                  //var_dump($object);
              @endphp
                @include('partials.landing-teaser-modules.teaser-events')
              @endif
              @if(!empty($object->post_type) && $object->post_type === 'news')
                @include('partials.landing-teaser-modules.teaser-news')
              @endif
              @if(!empty($object->post_type) && $object->post_type === 'stories' && empty($object->featured_tags))
                @include('partials.landing-teaser-modules.teaser-stories')
              @endif
              @if(!empty($object->post_type) && $object->post_type === 'products')
                @include('partials.landing-teaser-modules.teaser-products')
              @endif
              {{--  @if(!empty($object->post_type) && $object->post_type === 'services' && !empty($object->tags) && ($object->tags[0]->slug === 'leistung' || $object->tags[0]->slug === 'service'))
                @include('partials.landing-teaser-modules.teaser-services')
              @endif --}}
            @endforeach
          </div>
      </div>
      @if(!empty($topic) && !empty($teaser[2]))
        <div id="app">
          @php
            $items = $teaser[2]; // IDs of the Post present before Loading
            $teaser_length = count($teaser[0]); // Number of Teasers
            $url = get_home_url(); // URL of the API
          @endphp
          <App v-bind:loads="{{ json_encode($teaser_length) }}" v-bind:topic="{{$topic}}" :excludes="{{ json_encode($items) }}" :url="{{ json_encode($url) }}">
          </App>
        </div>
      @endif
  @endif

  

  {{-- Teaser Banner --}}
  @if(!empty($landing_teaser_modules))
    @foreach ($landing_teaser_modules as $object)
      @if($object->acf_fc_layout === 'teaser_banner')
        <div class="iav-teaser-banner  @if($object->teaser_banner_color === 'white') iav-teaser-banner-white @elseif($object->teaser_banner_color === 'blue') iav-teaser-banner-blue @elseif($object->teaser_banner_color === 'light_blue') iav-teaser-banner-light-blue @elseif($object->teaser_banner_color === 'green') iav-teaser-banner-green @endif" @if($object->teaser_banner_color === 'green') style="background-color: #91c60e;" @elseif($object->teaser_banner_color === 'blue') style="background-color: #14639e;" @elseif($object->teaser_banner_color === 'light_blue') style="background-color: #5daedb;" @else style="background-color: #fff;" @endif>
          @include('partials.landing-onepager-modules.teaser-banner')
        </div>
      @endif
    @endforeach 
  @endif

  <div class="uk-container iav-social-media-bottom">
    @include('partials.social-media-share')
  </div>
  
  @include('partials.topics')
  
  {{-- Bottom Modules --}}
  @if(!empty($bottom_module_format))
    @include('partials.bottom-modules.bottom-modules')
  @endif

  {{-- Automotion Banner --}}
  @if(!empty($has_automotion_banner) && !empty($automotion_banner))
    @include('partials.global-modules.automotion-banner')
  @endif

  {{-- Related Content - Specific Set: Fetaured Teaser & Socal Media --}}
  @if(!empty($featured_teaser))
  <div class="iav-related-content">
    <div class="uk-container">
      <div uk-grid class="uk-grid">
        @if(!empty($featured_teaser))
          @include('partials.related-content.featured-teaser')
        @endif
      </div>  
    </div>
  </div>
  @endif

  {{-- Global Subscription Banner --}}
  @if(!empty($has_global_subscription) && !empty($global_subscription))
    @include('partials.global-modules.global-subscription')
  @endif
@endwhile
@endsection