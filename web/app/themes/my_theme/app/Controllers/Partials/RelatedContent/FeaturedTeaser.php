<?php // @ app/controllers/Single.php

namespace App\Controllers\Partials\RelatedContent;

use WP_Query;

trait FeaturedTeaser
{
  public function FeaturedTeaser()
  {
    $featured_teaser_array = array();
    $select_global_featured_teasers = get_field('select_global_featured_teasers', 'option');
    $jobs_slide = get_field('jobs_slide', 'option');
    if (!empty($select_global_featured_teasers)) {
        foreach ($select_global_featured_teasers['featured_teaser'] as $item) {
            //var_dump($item);
            if(!empty($item['featured_teaser']->ID)) {
                $ftid = $item['featured_teaser']->ID;
            } else {
                $ftid = '';
            }
            $post_object = new \stdClass;
            $post_object->style_settings = $item['style_settings'];
            $post_object->is_not_event_or_news = $item['is_not_event_or_news'];
            $post_object->featured_teaser_title = $item['featured_teaser_title'];
            $post_object->featured_teaser_image = $item['featured_teaser_image'];
            $post_object->featured_teaser_subtitle = $item['featured_teaser_subtitle'];
            // Query Database
            $query = new WP_Query(
                array(
                    'p' => $ftid,
                    'post_type' => 'any',
                ));
            while ($query->have_posts()): $query->the_post();
                $post_object->ID = $query->post->ID;
                $post_object->title = $query->post->post_title;
                $post_object->teaser_text = get_field('teaser_text');
                $post_object->teaser_image = get_field('teaser_image');
                $post_object->teaser_video = get_field('teaser_video');
                $post_object->post_type = get_post_type();
                $post_object->template = get_page_template_slug();
                $post_object->url = get_post_permalink();
                if ($post_object->post_type === 'events') {
                    $post_object->event_type = wp_get_post_terms(get_the_ID(), 'event_type');
                    $post_object->stage_date_freeform = get_field('stage_date_freeform');
                    $post_object->stage_start_date = get_field('stage_start_date');
                    $post_object->stage_end_date = get_field('stage_end_date');
                    $post_object->event_location = get_field('stage_location');
                    if(!empty(get_field('url')) && !empty(get_field('url')['url'])) {
                        $post_object->event_url = get_field('url')['url'];
                    } 
                }
                if ($post_object->post_type === 'news') {
                    $post_object->date_published = get_the_date('d.m.Y');
                }
                if ($post_object->post_type === 'products') {
                    $post_object->product_type = wp_get_post_terms(get_the_ID(), 'product-type');
                }
                array_push($featured_teaser_array, $post_object); // Push each Object onto an Array.
            endwhile;
        }
        // Reset post data
        wp_reset_postdata();
    }

    $featured_teaser_array = array_slice($featured_teaser_array, 0, 3);
    if(!empty($jobs_slide)) {
        //var_dump($jobs_slide);
        $slidearr = [];
        array_push($slidearr, $jobs_slide);
        array_splice($featured_teaser_array, 1, 0, $slidearr);
    }
    //var_dump($featured_teaser_array);
    return $featured_teaser_array;
  } 
}