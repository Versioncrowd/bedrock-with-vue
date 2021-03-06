<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="" role="document">
      <div class="content">
        <main class="main">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @php //do_action('get_footer') @endphp
    @if(!is_front_page())
      @include('partials.footer')  
    @endif
    @php wp_footer() @endphp

    @php // Einbindung der Here Maps Scripts hier // @endphp
    @include('partials.locations.here')
  </body>
</html>
