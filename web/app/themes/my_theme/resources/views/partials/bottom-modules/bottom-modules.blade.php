@php

  function checkIfModuleExists($module){
      //var_dump($module);
      $is_visible = 0;
      foreach ($module as $item){
          if($item->bottom_module_select != "" && $item->bottom_module_select != "no_module"){
            $is_visible = 1;
            break;
          }else{
            $is_visible = 0;
          }
      }

      return $is_visible;
  }
@endphp

@if(!empty($bottom_module_3_col_repeater) || !empty($bottom_module_2_col_repeater))
@if(($bottom_module_format === '3-col'))
  @if(checkIfModuleExists($bottom_module_3_col_repeater) === 1)
    <div class="iav-container ">
      <div class="iav-bottom-modules-container">
        <div class="uk-grid uk-child-width-1-1 uk-child-width-1-3@s iav-bottom-modules">
          @foreach($bottom_module_3_col_repeater as $item)
            @if($item->bottom_module_select === 'global')
              @include('partials.bottom-modules.global-bottom-module')
            @else 
              @php
                // change to right variable name for sidebar modules
                $sidebar_module = $item->bottom_module;     
              @endphp
              @if($item->bottom_module_select === 'contact_module') 
                @include('partials.sidebar-modules.custom-contact')
              @endif
              @if($item->bottom_module_select === 'link_list_module')
                @include('partials.sidebar-modules.link-list')
              @endif
              @if($item->bottom_module_select === 'downloads_module')
                @include('partials.sidebar-modules.downloads')
              @endif
              @if($item->bottom_module_select === 'abo_module')
                @include('partials.sidebar-modules.abo')
              @endif
            @endif
          @endforeach
        </div>
      </div>  
    </div> 
  @endif
@endif

@if(($bottom_module_format === '2-col'))
  @if(checkIfModuleExists($bottom_module_2_col_repeater) === 1)
    <div class="iav-container ">
      <div class="iav-bottom-modules-container">
        <div class="uk-grid uk-child-width-3-3 uk-child-width-1-2@s iav-bottom-modules">
          @foreach($bottom_module_2_col_repeater as $item)
            @if($item->bottom_module_select === 'global')
              @include('partials.bottom-modules.global-bottom-module')
            @else 
              @php
                // change to right variable name for sidebar modules
                $sidebar_module = $item->bottom_module;     
              @endphp
              @if($item->bottom_module_select === 'contact_module')
                @include('partials.sidebar-modules.custom-contact')
              @endif
              @if($item->bottom_module_select === 'link_list_module')
                @include('partials.sidebar-modules.link-list')
              @endif
              @if($item->bottom_module_select === 'downloads_module')
                @include('partials.sidebar-modules.downloads')
              @endif
              @if($item->bottom_module_select === 'abo_module')
                @include('partials.sidebar-modules.abo')
              @endif
            @endif
          @endforeach
        </div>
      </div>  
    </div> 
  @endif 
@endif
@endif