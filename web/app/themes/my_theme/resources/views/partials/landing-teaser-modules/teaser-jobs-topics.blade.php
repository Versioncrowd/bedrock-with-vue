@php
  // Variables required for the Term Name
  // var_dump($jobs_per_topic);
@endphp
<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
    <div class="iav-small-teaser iav-jobs">
        <div class="iav-jobs-text">
            <div class="iav-jobs-subtitle">Jobs</div>
            @if(!empty($jobs_tab))
                <div class="iav-jobs-number">
                    @if(!empty($jobs_per_topic))
                        {{$jobs_per_topic}}
                    @endif
                </div>
            @endif
            <div class="iav-jobs-title">
                @if(ICL_LANGUAGE_CODE=='de')
                    Talente gesucht im Bereich {!!$topic_name !!}
                @else   
                    Talents wanted for {!!$topic_name !!}
                @endif
            </div> 
            @if(ICL_LANGUAGE_CODE=='de')
                <a href="{!! home_url() !!}/jobangebote/">
                    Jetzt Job finden
                </a>
            @else  
                <a href="{!! home_url() !!}/jobs/">
                    Find your job now
                </a>
            @endif
        </div>
    </div>
</div>