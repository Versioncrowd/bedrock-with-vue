@php
      // var_dump($object);
@endphp
<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
    <div class="iav-small-teaser iav-jobs">
        <div class="iav-jobs-text">
            <div class="iav-jobs-subtitle">Jobs</div>
            @if(!empty($jobs_tab))
                <div class="iav-jobs-number">{{ $jobs_tab }}</div>
            @endif
            <div class="iav-jobs-title">
                @if(ICL_LANGUAGE_CODE=='de')
                    Talente gesucht bei IAV
                @else   
                    Talents wanted
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