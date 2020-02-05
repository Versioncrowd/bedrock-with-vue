@if(!empty($introtext) || !empty($date))
    <div class="uk-text-lead iav-introtext">
        @if(!empty($date))
        <p class="iav-intro-date">
            {{$date}} 
            @if(!empty($introtext))
                &nbsp;&mdash;&nbsp;
            @endif
        </p>
        @endif
        @if(!empty($introtext))
            {!!$introtext!!}
        @endif
    </div>
@endif

