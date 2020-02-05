<div class="iav-title">
    @if(!empty($h1_caption))
    <h3 class="caption">{{$h1_caption}}</h3>
    @endif
    <h1>
        {!! $title !!}
        @if(!empty($stage_country))
            <br><span>{{$stage_country}}</span>
        @endif
    </h1>
</div>

