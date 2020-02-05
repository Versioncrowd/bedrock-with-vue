@php
    //var_dump($stage_start_date) 
@endphp
<div class="uk-width-6-6@s uk-width-5-6@m">
  @include('partials.breadcrumbs')

  @if($title !== 'Executives Meeting Registration' )
    @include('partials.social-media-share')
  @endif

  @if(!empty($title))
      @include('partials.stage-modules.title')
  @endif
  @if(!empty($introtext))
    @include('partials.stage-modules.introtext')
  @endif
  {{-- @include('partials.stage-modules.jobs-tab') --}}
</div>
