<header id="header" class="drop-boundary-header">
  {{-- Header Band  --}}
  <div class="banner">
    <div class="small-band band-1"></div>
    <div class="small-band band-2"></div>
    <div class="small-band band-3"></div>
    <div class="small-band band-4"></div>
    <div class="band-5">
      <div class="links">
        <div class="iav-header-language-list uk-visible@m uk-flex uk-flex-right">
            @php
              languages_list_header()
            @endphp
        </div>
      </div>
    </div>
  </div>

  <div class="iav-navbar-container">
    <div class="uk-container iav-nav-flex">
      <nav uk-navbar id="iav-navbar" class="nav-overlay uk-navbar-transparent uk-navbar">
        {{-- Navbar Mobile --}}
        <div id="iav-mobile-close" class="btn slide-menu-control uk-hidden@m" data-target="slidemenu" data-action="toggle">
          <span></span>
          <span></span>
          <span></span>
        </div> 
        {{-- Search Magnifying Glass Mobile --}}
        <div class="iav-search-icon uk-hidden@m">
          <a class="uk-navbar-toggle iav-navbar-toggle-mobile" uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
        </div>
        <div class="iav-search-icon uk-visible@m">
          <a class="uk-navbar-toggle" uk-toggle="target: .nav-overlay; animation: uk-animation-fade;" href="#"></a>
        </div> 
        <div class="uk-navbar-left uk-width-expand uk-visible@m iav-primary-menu">
          {{-- Search Magnifying Glass Desktop --}}
        
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'uk-navbar-nav uk-tab iav-navbar-nav hidden']) !!}
        </div>
        
        {{-- Navbar Mobile --}}
        <div id="slidemenu" class="slide-menu uk-hidden@m" style="display: block;">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mobile-menu']) !!}
      
        </div> {{-- End Navbar Mobile --}}
        <div class="iav-mobile-language-button uk-hidden@m">
          @php
            languages_list_header()
          @endphp
        </div>
        
        <div class="uk-hidden@m"> {{-- Logo Container - Mobile Menu Right Part--}}
            <a class="uk-width-auto iav-logo" href="<?php echo get_home_url(); ?>">
              <img alt="iav-logo-mobile" src="@asset('images/iav_logo_mob.svg')">
            </a>
        </div>
      </nav>
      {{-- Search Overlay --}}
      <div class="nav-overlay uk-navbar-left uk-flex-1 iav-search-navbar" hidden>
          <a class="uk-navbar-toggle iav-search-close" uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#"></a>
            @include('partials.searchform')
      </div> 
      {{-- Logo Container - Mobile Menu Right Part--}}
      <a class="uk-width-auto iav-logo uk-visible@m" href="<?php echo get_home_url(); ?>">
        {{-- <img class="uk-visible@l" alt="iav-logo" src="@asset('images/iav_logo.svg')"> --}}
        <div class="uk-visible@l iav-logo-desktop"></div>
        <div class="iav-logo-mobile uk-hidden@l"></div>
        {{-- <img alt="iav-logo-mobile" class="iav-logo-desk-mobile uk-hidden@l" src="@asset('images/iav_logo_mob.svg')"> --}}
      </a>
      {{-- End Logo Container --}}
    </div> 
  </div>
 
	{{-- <div class="iav-navbar-mobile">
      <button type="button" class="btn slide-menu-control uk-hidden@m" data-target="slidemenu" data-action="toggle">Toggle Menu</button>
      <nav id="slidemenu" class="slide-menu" style="display: block;">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mobile-menu']) !!}
      </nav>
  </div> End Navbar Mobile --}}

</header>
  