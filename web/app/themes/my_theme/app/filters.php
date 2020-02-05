<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
            $classes[] = 'preload';
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100);

/**** Get ACF for Menus ****/
add_filter('wp_nav_menu_items', function ($items, $args) {
    // Get the Menu
    $all_sections = '';
    $menu = wp_get_nav_menu_object($args->menu);
    //var_dump($args);
    if ($args->menu->name == 'footer-nav' || $args->menu->name == 'footer-nav-en' ) {
        // Footer First Section
        $first_section_title = '<div class="footer_section_title">' . get_field('first_section_title', $menu) . '</div>';
        $links = get_field('first_section', $menu);
        $temp1 = '';
        if ($links) {
            $temp1 = $temp1 . '<ul>';
            foreach ($links as $row) {
                $temp1 = $temp1 . '<li class="menu-item"><a href="' . $row['link']['url'] . '">' . $row['link']['title'] . '</a></li>';
            }
            $temp1 = $temp1 . '</ul>';
        }
        $first_section = '<div class="iav-footer-section">' . $first_section_title . $temp1 . '</div>';

        // Footer Second Section
        $second_section_title = '<div class="footer_section_title">' . get_field('second_section_title', $menu) . '</div>';
        $links2 = get_field('second_section', $menu);
        $temp2 = '';
        if ($links2) {
            $temp2 = $temp2 . '<ul>';
            foreach ($links2 as $row) {
                $temp2 = $temp2 . '<li class="menu-item"><a href="' . $row['link']['url'] . '">' . $row['link']['title'] . '</a></li>';
            }
            $temp2 = $temp2 . '</ul>';
        }
        $second_section = '<div class="iav-footer-section">' . $second_section_title . $temp2 . '</div>';

        // Footer Third Section
        $third_section_title = '<div class="footer_section_title">' . get_field('third_section_title', $menu) . '</div>';
        $links3 = get_field('third_section', $menu);
        $temp3 = '';
        if ($links3) {
            $temp3 = $temp3 . '<ul>';
            foreach ($links3 as $row) {
                $temp3 = $temp3 . '<li class="menu-item"><a href="' . $row['link']['url'] . '">' . $row['link']['title'] . '</a></li>';
            }
            $temp3 = $temp3 . '</ul>';
        }
        $third_section = '<div class="iav-footer-section">' . $third_section_title . $temp3 . '</div>';

        // Footer Fourth Section
        $fourth_section_title = '<div class="footer_section_title">' . get_field('fourth_section_title', $menu) . '</div>';
        $links4 = get_field('social_media_icons', $menu);
        $temp4 = '';
        if ($links4) {
            $temp4 = $temp4 . '<ul class="iav-social-media-icons">';

            foreach ($links4 as $row) {
                $temp4 = $temp4 . '<li class="iav-menu-item"><a target="_blank" href="' . $row['link'] . '"><img src="' . $row['picture'] . '" /></a></li>';
            }
            $temp4 = $temp4 . '</ul>';
        }
        $fourth_section = '<div class="iav-footer-section">' . $fourth_section_title . $temp4 . '</div>';
        // Create the Final Element
        $all_sections = $first_section . $second_section . $third_section . $fourth_section;
        return $all_sections;
    } else if ($args->menu->name == 'footer-meta-menu' || $args->menu->name == 'footer-meta-menu-en'  ) {
        // Footer Meta
        $meta_left = '';
        $footer_meta_left = get_field('footer_meta_left', $menu);
        if ($footer_meta_left) {
            $meta_left = $meta_left . '<ul class="iav-footer-meta-left">';
            foreach ($footer_meta_left as $row) {
                $meta_left = $meta_left . '<li class="iav-menu-item"><a href="' . $row['link']['url'] . '">' . $row['link']['title'] . '</a></li>';
            }
            $meta_left = $meta_left . '</ul>';
        }
        return $meta_left;
    } 
    else {
        // return
        return $items;
    }
}, 10, 2);

/**
 * Add descriptions to menu items
 */
//Standard WP function 
//This is only for adding additional stuff to the menu
add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {
    $tags = get_field('topics', $item);
    if ($item->description) {
        if ($tags) {
            // $all_tags = '';
            // foreach ($tags as $tag) {
            //     $all_tags .= '<div class="tag">' . $tag['tag'] . '</div>';
            // }
            // // Creates the Description Container on the left Column
            // // Then create the right column the menu itself
            // $item_output = str_replace($args->link_after . '</a>', '</a><li><h2 class="menu-item-title">' . $item->title . '</h2><div class="menu-item-description">' . $item->description . '</div>' . $all_tags . '</div>' . $args->link_after, $item_output);
        } else {
            // right now still always going in here 
            $item_output = str_replace($args->link_after . '</a>', '</a><div class="left-col"><h2 class="menu-item-title">' . $item->title . '</h2><div class="menu-item-description">' . $item->description . '</div></div>' . $args->link_after, $item_output);
        }
    }
    return $item_output;
}, 10, 4);

add_filter('walker_nav_menu_end_el', function ($item_output, $item, $depth, $args) {
    $tags = get_field('tags', $item);
    if ($item->description) {
        if (!$tags) {
      //<div class="sub-menu second-level"></div>
      //var_dump($item_output);
        }
    }
    //var_dump($item_output);
    return $item_output;
}, 10, 4);

/**
 * Add custom search form searchform.blade.php
 */
add_filter('get_search_form', function () {
    return \App\template('partials.searchform');
});

add_filter( 'get_search_form', function( $form ) {
    $form = str_replace( 'name="s"', 'name="fwp_global_search"', $form );
    $form = preg_replace( '/action=".*"/', 'action="/search/"', $form );
    return $form;
} );

add_filter('get_jobs_search_form', function () {
    return \App\template('partials.landing-onepager-modules.jobsearch-new');
});

add_filter( 'get_jobs_search_form', function( $form ) {
    $form = str_replace( 'name="s"', 'name="fwp_jobs_search"', $form );
    $form = preg_replace( '/action=".*"/', 'action="/apply/"', $form );
    return $form;
} );

/**
 * Facet WP custom WP query Filter
 */

add_filter( 'facetwp_is_main_query', function( $bool, $query ) {
    return ( true === $query->get( 'facetwp' ) ) ? true : $bool;
}, 10, 2 );

/**
 * What comes back from Result Count
 */

add_filter( 'facetwp_result_count', function( $output, $params ) {
    $output = $params['total'];
    return $output;
}, 10, 2 );

