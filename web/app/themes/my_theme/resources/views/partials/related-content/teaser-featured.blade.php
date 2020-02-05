<div class="uk-visible@s" uk-slideshow="autoplay: true; autoplay-interval: 2500; pause-on-hover: true">
    <ul class="uk-slideshow-items">
        @foreach ($featured_teaser as $item)
            {{-- If Second Slide --}}
            @if($loop->index === 1)
                @if(!empty($item))
                    @include('partials.related-content.jobs-slide')
                @endif
            @else
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
                            $uk_placement_class = "uk-position-bottom-left";
                            } elseif($placement_class === 'right') {
                            $uk_placement_class = "uk-position-bottom-right";
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

                    //var_dump($item);
                @endphp
                @if( !empty($item->teaser_image) || !empty($item->featured_teaser_image))
                    <li>
                      @if($item->is_not_event_or_news === 'event_or_news' && !empty($item->teaser_image))
                        <img @if(!empty($item->teaser_image['url'])) src="{{$item->teaser_image['url']}}" @endif @if(!empty($item->teaser_image['alt'])) alt="{{$item->teaser_image['alt']}}" @endif uk-cover>
                      @elseif($item->is_not_event_or_news === 'not_event_or_news' && !empty($item->featured_teaser_image))
                        <img @if(!empty($item->featured_teaser_image['url'])) src="{{$item->featured_teaser_image['url']}}" @endif @if(!empty($item->featured_teaser_image['alt'])) alt="{{$item->featured_teaser_image['alt']}}" @endif uk-cover>
                      @endif
                        <div class="iav-featured-teaser-textbox @if(!empty($color)){{$color}} @endif @if(!empty($uk_placement_class)){{$uk_placement_class}} @endif @if(!empty($box_size)){{$box_size}} @endif">
                            @if(!empty($item->event_url) && !empty($item->template) && $item->template === 'views/template-simple-event.blade.php')
                                <a href="{{$item->event_url}}" target="_blank">
                            @else 
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
                                <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Karriere @else Careers @endif</p>
                            @elseif(!empty($item->post_type) && $item->post_type === "stories")
                                <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Was uns bewegt @else What moves us @endif</p>
                            @elseif(!empty($item->post_type) && $item->post_type === "employee_stories")
                                <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Kopf &amp; Herz - Portrait @else Brain &amp; heart - portrait @endif</p>
                            @elseif(!empty($item->post_type) && $item->post_type === "company")
                                <p class="iav-post-type">@if(ICL_LANGUAGE_CODE=='de') Über IAV @else About IAV @endif</p>
                            @elseif(!empty($item->post_type) && $item->post_type === "products")
                              @if(!empty($item->product_type) && !empty($item->product_type[0]->name))
                                <p class="iav-post-type">{{$item->product_type[0]->name}}</p>
                              @else
                                <p class="iav-post-type">Product</p>
                              @endif
                            @endif
                            @if(!empty($item->post_type) && $item->post_type === "events")
                                @if(!empty($item->stage_date_freeform))
                                    <h4>{{$item->stage_date_freeform}}</h4>
                                @else
                                    @if(!empty($item->stage_start_date) && !empty($item->stage_end_date))
                                    @php
                                        $start_date = $item->stage_start_date;
                                        $startDateArray = explode('.',$start_date);
                                    @endphp
                                        <h4>{{$startDateArray[0]}}.{{$startDateArray[1]}}. &mdash; {{$item->stage_end_date}}</h4>
                                    @elseif(!empty($item->stage_start_date) && empty($item->stage_end_date))
                                        <h4>{{$item->stage_start_date}}</h4>
                                    @endif
                                @endif
                            @endif
                            @if($item->is_not_event_or_news === 'event_or_news')
                              @if(!empty($item->title))
                                <h3>{!! $item->title !!}</h3>
                              @endif
                            @else
                              @if(!empty($item->featured_teaser_title))
                                <h3>{!! $item->featured_teaser_title !!}</h3>
                              @endif
                            @endif
                            @if(!empty($item->post_type) && $item->post_type === "events")
                              @if(!empty($item->event_location))
                                <h3 class="iav-event-location">{{$item->event_location}}</h3>
                              @endif
                            @elseif($item->is_not_event_or_news === 'not_event_or_news' && !empty($item->featured_teaser_subtitle))
                              @if(!empty($item->featured_teaser_subtitle))
                                <h3 class="iav-event-location">{{ $item->featured_teaser_subtitle }}</h3>
                              @endif
                            @endif
                            @if(!empty($item->event_url))
                                <a href="{{$item->event_url}}" target="_blank"><h5>@if(ICL_LANGUAGE_CODE=='de') Mehr erfahren @else Learn more @endif</h5></a>
                            @elseif(!empty($item->url)) 
                                <a href="{{$item->url}}"><h5>@if(ICL_LANGUAGE_CODE=='de') Mehr erfahren @else Learn more @endif</h5></a>   
                            @endif
                            @if(!empty($item->event_url) || !empty($item->url))
                            </a>
                            @endif
                        </div>
                    </li>
                @endif
            {{-- Close Iteration --}}
            @endif 
        @endforeach
    </ul>
    <ul class="iav-teaser-navigation">
        @foreach ($featured_teaser as $item)
            @if(get_post_type() != "karriere" && $loop->index === 1)
                <li uk-slideshow-item="1"><a href="#"></a></li>
            @elseif(get_post_type() == "karriere" && $loop->index === 1)
                <li uk-slideshow-item="1"><a href="#"></a></li>
            @else
                @if(!empty($item->teaser_image) || !empty($item->featured_teaser_image))
                    <li uk-slideshow-item="{{$loop->index}}"><a href="#"></a></li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
