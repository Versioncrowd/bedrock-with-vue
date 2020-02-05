{{-- für Bereich Karriere nur Facebook --}}

@php
  $iav_facebook = do_shortcode('[fts_twitter twitter_name=IAV_de tweets_count=1 cover_photo=no stats_bar=no show_retweets=no show_replies=no]');
@endphp

<div class="iav-related-content">
  <div class="uk-container">
    <div uk-grid class="uk-grid">


        <div class="uk-width-3-3 iav-featured-news-teaser">
            <h4 class="featured-subtitle">IAV Vernetzt</h4>
            {{-- @php
              echo var_dump($iav_facebook);
            @endphp --}}
          </div>
          {{-- Inserts UI Kit slider with related news and events  --}}
          <div uk-slider>
              <div class="uk-position-relative">
                <div class="uk-slider-container">
                  <ul class="uk-slider-items uk-child-width-1-3@m uk-child-width-1-2@s uk-child-width-1-1 uk-grid">
                    {{-- TWITTER  --}}
                      <li>
                          @php
                          echo $iav_facebook
                          @endphp
                        </li>
                        {{-- FACEBOOK  --}}
                        <li>
                            @php
                            //echo $iav_facebook
                           echo do_shortcode('[fts_youtube vid_count=1 large_vid=no large_vid_title=no large_vid_description=no thumbs_play_in_iframe=youtube vids_in_row=1 omit_first_thumbnail=yes space_between_videos=1px force_columns=no maxres_thumbnail_images=yes thumbs_wrap_color=#ffffff wrap=none video_wrap_display=none comments_count=0 username=IAVchannel]');
                          @endphp
                          </li>
                    {{-- YOUTUBE  --}}
                          <li>
                              @php
                              echo do_shortcode('[fts_facebook type=page id=163409150366153 posts=1 title=no title_align=left description=yes show_media=top show_thumbnail=no show_date=yes show_name=yes words=45 popup=no posts_displayed=page_only]');
                            @endphp
                            </li>
                        
                    
                  </ul>
                </div>
                {{-- <a class="uk-position-center-left-out" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right-out" href="#" uk-slidenav-next uk-slider-item="next"></a> --}}
            </div>
        </div>
            {{-- <a class="iav-arrow-link" href="">Alle</a> --}}
        </div>






    
    </div>
  </div>
</div>


{{-- <li>
                        
    @php
      //echo do_shortcode('[fts_twitter twitter_name=IAV_de tweets_count=1 cover_photo=no stats_bar=no show_retweets=no show_replies=no]');
      echo do_shortcode('[fts_youtube vid_count=1 large_vid=yes large_vid_title=no large_vid_description=no thumbs_play_in_iframe=popup vids_in_row=1 omit_first_thumbnail=no space_between_videos=1px force_columns=no maxres_thumbnail_images=yes thumbs_wrap_color=#ffffff wrap=none video_wrap_display=none comments_count=0 username=IAVchannel]');
    @endphp
      
</li> --}}