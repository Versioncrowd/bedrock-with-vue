@include('partials.stage-modules.background')
<div class="uk-container uk-container-center iav-content">
  <div class="uk-grid" uk-grid>
    <div class="uk-width-6-6@s uk-width-5-6@m">
      @include('partials.breadcrumbs')
      @include('partials.social-media-share')
      <div class="iav-title">
        @if(!empty($h1_caption))
        <h3 class="caption">404</h3>
        @endif
        <h1>
            404
        </h1>
      </div>
      <div class="uk-text-lead iav-introtext">
        @if(ICL_LANGUAGE_CODE=='de')
          Selbst beim besten Engineering läuft mal etwas schief ...
        @else
          Even with best-in-class engineering, things can go wrong ...
        @endif  
      </div>
    </div>
  </div>
</div>