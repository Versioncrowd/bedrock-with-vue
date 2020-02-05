@extends('layouts.app')

@section('content')
  {{-- @include('partials.page-header') --}}
  @include('partials.stage-modules.404-header')

  {{-- @if (!have_posts())
  <div class="uk-container uk-container-center iav-header">
    <div class="alert alert-warning">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  </div>
  @endif  --}}

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
@endsection
