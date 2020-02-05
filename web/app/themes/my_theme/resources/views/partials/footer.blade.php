<footer class="iav-footer">
  @if (has_nav_menu('footer-menu'))
    {!! wp_nav_menu(array('theme_location' => 'footer-menu', 'container_class' => 'uk-container uk-container-expand', 'menu_class' => 'iav-footer-nav uk-grid uk-child-width-1-2 uk-child-width-1-4@m')) !!}
  @endif
  <div uk-grid class="uk-grid">
    <div class="uk-width-1-2">
      @if (has_nav_menu('footer-meta-menu'))
        {!! wp_nav_menu(array('theme_location' => 'footer-meta-menu')) !!}
      @endif
    </div>
    @php
      languages_list_header()
    @endphp
    <div class="copyright uk-width-1-2 uk-width-1-4@m">
      IAV &copy @php echo date("Y"); @endphp
    </div>
  </div>
</footer>
 