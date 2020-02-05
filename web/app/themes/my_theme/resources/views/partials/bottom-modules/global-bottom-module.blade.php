
  @php
    // get the sidebar item post ID
    $post_object = $item->bottom_module->bottom_module_global;
    global $post;
    $post = $post_object;
    // get the post via its ID
    setup_postdata( $post );
    // get all acf fields
    $global_sidebar_module = array();
    $global_sidebar_module['bottom_module_global'] = $item->bottom_module->bottom_module_global;
    $global_sidebar_module['sidebar_module_select'] = get_field('sidebar_module_select');
    $global_sidebar_module['sidebar_module_title'] = get_field('sidebar_module_title');
    $global_sidebar_module['contact_main_text'] = get_field('contact_main_text');
    $global_sidebar_module['contact_main_text_small'] = get_field('contact_main_text_small');
    $global_sidebar_module['contact_telephone'] = get_field('contact_telephone');
    $global_sidebar_module['contact_link'] = get_field('contact_link');
    $global_sidebar_module['link_list'] = get_field('link_list');
    $global_sidebar_module['downloads_repeater'] = get_field('downloads_repeater');
    $global_sidebar_module['abo_module_select'] = get_field('abo_module_select');
    $global_sidebar_module['abo_main_text'] = get_field('abo_main_text');
    $global_sidebar_module['abo_link'] = get_field('abo_link');
    $global_sidebar_module['label'] = get_field('label');
    wp_reset_postdata(); 
  @endphp

  @if(!empty($global_sidebar_module))
    @if(!empty($global_sidebar_module['sidebar_module_select']) && ($global_sidebar_module['sidebar_module_select'] === 'contact_module'))
      @include('partials.sidebar-modules.global-contact')
    @endif
    @if(!empty($global_sidebar_module['sidebar_module_select']) && ($global_sidebar_module['sidebar_module_select'] === 'abo_module'))
      @include('partials.sidebar-modules.global-abo')
    @endif
    @if(!empty($global_sidebar_module['sidebar_module_select']) && ($global_sidebar_module['sidebar_module_select'] === 'link_list_module'))
      @include('partials.sidebar-modules.global-link-list')
    @endif
    @if(!empty($global_sidebar_module['sidebar_module_select']) && ($global_sidebar_module['sidebar_module_select'] === 'downloads_module'))
      @include('partials.sidebar-modules.global-downloads')
    @endif
    @if(!empty($global_sidebar_module['sidebar_module_select']) && ($global_sidebar_module['sidebar_module_select'] === 'label'))
    <div>
      <div class="contact sidebar-module">
        <div class="iav-contact-small">
          <p>You are trying to add a Label here. Labels can not be added into Bottom Modules. Please select another Type of Module.</p>
        </div>
      </div>
    </div>
    @endif
  @endif