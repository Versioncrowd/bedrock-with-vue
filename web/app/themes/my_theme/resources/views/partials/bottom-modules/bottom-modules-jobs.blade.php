@php
$bottom_module_repeater = [];
  if(!empty($bottom_modules_jobs->bottom_module_3_col_repeater)) {
    $bottom_module_repeater = $bottom_modules_jobs->bottom_module_3_col_repeater;
  } elseif(!empty($bottom_modules_jobs->bottom_module_2_col_repeater)) {
    $bottom_module_repeater = $bottom_modules_jobs->bottom_module_2_col_repeater;
  }
@endphp

@if($bottom_modules_jobs->bottom_module_format === '3-col'))
  <div class="uk-grid uk-child-width-1-1 uk-child-width-1-3@s iav-bottom-modules">
@else
  <div class="uk-grid uk-child-width-3-3 uk-child-width-1-2@s iav-bottom-modules">
@endif
  @if(!empty($bottom_module_repeater))
    @foreach($bottom_module_repeater as $item)
      <div>
        <div class="sidebar-module contact">
          @if(!empty($item['sidebar_module_title']))
            <h4>{{$item['sidebar_module_title']}}</h4>
          @endif
          @if(!empty($item['contact_main_text']))
            {!!$item['contact_main_text']!!}
          @endif
          @if(!empty($item['contact_name']))
            <p class="contact-tel">{!!$item['contact_name']!!}</p>  
          @endif
          @if(!empty($item['contact_main_text_small']))
            <div class="iav-contact-small">
              {!!$item['contact_main_text_small']!!}
            </div>
          @endif
          @if(!empty($item['contact_telephone']))
            <p class="contact-tel">{!!$item['contact_telephone']!!}</p>  
          @endif
          @if(!empty($item['contact_link']))
            <a class="sidebar-link" href="{!!$item['contact_link']['url']!!}">{!!$item['contact_link']['title']!!}</a>  
          @endif
        </div>
      </div> 
    @endforeach
  @endif
</div>