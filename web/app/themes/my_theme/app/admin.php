<?php

namespace App;

/*** Theme Customizer ***/
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/*** Customizer JS ***/
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/***  Register More Menus ***/
add_action('init', function() {
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
});

/*** To Register Multiple Menus ***/
add_action( 'init', function () {
  register_nav_menus(
    array(
        'footer-meta-menu' => __( 'Footer Meta Menu' ) ,
        'locations-menu' => __( 'Locations Menu' ),
        'news-events-menu' => __( 'News Events Menu' ),
        /*'extra-menu' => __( 'Extra Menu' ) */
   ));
});

/*** Add ACF Options Pages ****/
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
		'page_title' 	=> 'IAV General Settings',
		'menu_title'	=> 'IAV General Settings',
		'menu_slug' 	=> 'iav-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
    ));
    
    acf_add_options_sub_page(array(
		'page_title' 	=> 'Featured Teaser Settings',
		'menu_title'	=> 'Featured Teaser Settings',
		'parent_slug'	=> 'iav-general-settings',
    ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Bottom Modules Jobs Settings',
      'menu_title'	=> 'Bottom Modules Jobs Settings',
      'parent_slug'	=> 'iav-general-settings',
      ));

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Benefits Settings',
      'menu_title'	=> 'Benefits Settings',
      'parent_slug'	=> 'iav-general-settings',
      ));

      acf_add_options_sub_page(array(
        'page_title' 	=> 'Global Subscription Banner',
        'menu_title'	=> 'Global Subscription Banner',
        'parent_slug'	=> 'iav-general-settings',
      )); 

    acf_add_options_sub_page(array(
      'page_title' 	=> 'Automotion Banner',
      'menu_title'	=> 'Automotion Banner',
      'parent_slug'	=> 'iav-general-settings',
      ));  

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Multiple Locations Settings',
		'menu_title'	=> 'Multiple Locations Settings',
		'parent_slug'	=> 'iav-general-settings',
	));
}
