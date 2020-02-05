@if (!empty($topics))
    <div class="iav-container iav-topics">
        <ul class="topics">
            @foreach( $topics as $topic )
                @if(!empty($topic) && !empty($topic->title))
                    <li>@if(!empty($topic->url))<a href="{{$topic->url}}">@endif {!!$topic->title !!}@if(!empty($topic->url))</a>@endif</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif