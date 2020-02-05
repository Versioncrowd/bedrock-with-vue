<?php // @ app/controllers/Single.php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class TemplateTeaserVue extends Controller
{
    public function Title()
    {
        return get_the_title();
    }

    // Get the Introtext field
    protected $acf = true;

    // For Sticky Jobs Tab
    use Partials\StageModules\JobsTab;

    // Global Subscription Banner
    use Partials\GlobalSubscription;

    // Global Automotion Banner
    use Partials\AutomotionBanner;

    // Specific Related Content for Landing Teaser
    use Partials\RelatedContent\FeaturedTeaser;
    //use Partials\RelatedContent\SocialMedia;

  public function Topic() {
    $topic = get_field('topic');
    return $topic;
  } 

  function FeaturedStoriesQuery()
  {
      // Get the selected Topic Tax
      $topic = get_field('topic');
      // Define the Query for Stories with Featured Tag and Topic Tag
      $the_query = new WP_Query(array(
          'post_type' => 'stories',
          'post__not_in' => array(get_the_ID()), // Exclude current post
          'posts_per_page' => 3,
          'tax_query' => array(
              'relation' => 'AND',
              array(
                  'taxonomy' => 'topics',
                  'field' => 'term_id',
                  'terms' => $topic,
              ),
              array(
                  'taxonomy' => 'featured-story',
                  'field' => 'term_id',
                  'terms' => array(8, 21),
              ),
          ),
      ));
      // Return the array of Posts
      return $the_query;
  }

   // 1. Search Stories with Topic that are Not Featured Stories
   function StoriesQuery()
   {
       $topic = get_field('topic');
       $the_query = new WP_Query(array(
           'post_type' => 'stories',
           'posts_per_page' => 8,
           'post__not_in' => array(get_the_ID()), // Exclude current post
           'tax_query' => array(
               'relation' => 'AND',
               array(
                   'taxonomy' => 'topics',
                   'field'    => 'term_id',
                   'terms' => $topic,
               ),
               array(
                   'taxonomy' => 'featured-story',
                   'field'    => 'slug',
                   'terms' => array('featured-story', 'featured-story-en'),
                   'operator' => 'NOT IN',
               ),
           ),
       ));
       return $the_query;
   }

   function NewsWithTopicQuery() {
      $topic = get_field('topic');
      // First Query - Taxonomy
      $the_query = new WP_Query(array(
          'post_type' => 'news',
          'tax_query' => array(
              array(
                  'taxonomy' => 'topics',
                  'field' => 'term_id',
                  'terms' => $topic,
                  'operator' => 'IN',
              ),
          ),
          'orderby' => 'date',
          'order' => 'DESC',
      ));
      return $the_query;
    }

    function NewThirtyDaysQuery(){
      // Second Query - Date
      $the_query = new WP_Query(array(
        'post_type' => 'news',
        'date_query' => array(
          array(
            'after'  => '600 days ago',
          ),
        ),
        'orderby' => 'date',
        'order' => 'DESC',
      ));
      return $the_query;
    }

    function ProductsQuery(){
      //return $posttype;
      $topic = get_field('topic');
      $the_query = new WP_Query(array(
          'post_type' => array('products'),
          'posts_per_page' => 2,
          'tax_query' => array(
              array(
                  'taxonomy' => 'topics',
                  'field' => 'term_id',
                  'terms' => $topic,
              ),
          ),
          'orderby' => 'date',
          'order' => 'DESC',
      ));
      return $the_query;
    }

      // Get Events that have Topic Tags and also are NOT Tagged as Career Events
    function EventsQuery() {
        $topic = get_field('topic');
        $today = date('Y-m-d');
        $meta_query = array(
          array(
            'key' => 'stage_start_date',
            'value' => $today,
            'type' => 'date',
            'compare' => '>=',
          )
        );
        $the_query = new WP_Query(array(
            'post_type' => 'events',
            'posts_per_page' => 2,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'topics',
                    'field' => 'term_id',
                    'terms' => $topic,
                    'operator' => 'IN',
                ),
                array(
                    'taxonomy' => 'karriereevent',
                    'field' => 'slug',
                    'terms' => array('karriere-event', 'career-event'),
                    'operator' => 'NOT IN',
                ),  
            ),
            'meta_key' => 'stage_start_date',
            'meta_query' => $meta_query,
            'order' => 'ASC',
            'orderby' => 'meta_value_num',
        ));

        return $the_query;
      }
      
      // Get Events that have Topic Tags and also are Tagged as Career Events
      function CareerEventsQuery(){
          $topic = get_field('topic');
          $today = date('Y-m-d');
          $meta_query = array(
            array(
              'key' => 'stage_start_date',
              'value' => $today,
              'type' => 'date',
              'compare' => '>=',
            )
          );
  
          $the_query = new WP_Query(array(
              'post_type' => 'events',
              'posts_per_page' => 2,
              'tax_query' => array(
                  'relation' => 'AND',
                  array(
                      'taxonomy' => 'topics',
                      'field' => 'term_id',
                      'terms' => $topic,
                      'operator' => 'IN',
                  ),
                  array(
                      'taxonomy' => 'karriereevent',
                      'field' => 'slug',
                      'terms' => array('karriere-event', 'career-event'),
                      'operator' => 'IN',
                  ),
              ),
              'meta_key' => 'stage_start_date',
              'meta_query' => $meta_query,
              'order' => 'ASC',
              'orderby' => 'meta_value_num',
          ));
          return $the_query;
      }
 
      public function Teaser() {
        $teaser_array = array();
        $featured_stories_query = $this->FeaturedStoriesQuery();
        $events_query = $this->EventsQuery();
        $career_events_query = $this->CareerEventsQuery();
        $stories_query = $this->StoriesQuery();
        $news_topic_query = $this->NewsWithTopicQuery();
        $news_thirty_query = $this->NewThirtyDaysQuery();
        $products_query = $this->ProductsQuery();

        function runQuery($parameters) {
          $the_query = $parameters;
          $posts_array = array();
          while ($the_query->have_posts()): $the_query->the_post();
              //$post_object = $the_query->post; // Now $the_query->post is WP_Post Object.
              $post_object = new \stdClass;
              $post_object->id = $the_query->post->ID;
              $post_object->title = get_the_title();
              $post_object->post_type = get_post_type();
              $post_object->date_published = get_the_date('j F Y');
              $post_object->url = get_post_permalink();
              $post_object->event_url = get_field('url');
              $post_object->template = get_page_template_slug();
              $post_object->event_start_date = get_field('stage_start_date');
              $post_object->event_end_date = get_field('stage_end_date');
              $post_object->event_date_freeform = get_field('stage_date_freeform');
              $post_object->event_location = get_field('stage_location');
              $post_object->teaser_text = get_field('teaser_text');
              $post_object->teaser_image_vertical = get_field('teaser_image_vertical');
              $post_object->teaser_image = get_field('teaser_image');
              $post_object->teaser_video = get_field('teaser_video');
              $post_object->karriereevent = wp_get_post_terms(get_the_ID(), 'karriereevent');
              $post_object->event_type = wp_get_post_terms(get_the_ID(), 'event_type');
              $post_object->tags = wp_get_post_terms(get_the_ID(), 'karriereevent');
              $post_object->featured_tags = wp_get_post_terms(get_the_ID(), 'featured-story');
              $post_object->product_type = '';
              if(!empty($post_object->tags) && !empty($post_object->tags[0]->name)) {
                  $post_object->product_type = $post_object->tags[0]->name;
              }
              array_push($posts_array, $post_object); // Push each Object onto an Array.
          endwhile;
          wp_reset_postdata(); // Dont Forget to Reset the Post Data Important !!!
          return $posts_array;
        }

        function runQueryNews($parameters) {
          $the_query = $parameters;
          $posts_array = array();
          while ($the_query->have_posts()): $the_query->the_post();
            $post_object_id = $the_query->post->ID;
            array_push($posts_array, $post_object_id);
          endwhile;
          wp_reset_postdata();
          return $posts_array;
        }

        $teaser = array();
        $featured_stories = runQuery($featured_stories_query);
        $featured_count = count($featured_stories);
        $teaser = array_merge($teaser, $featured_stories);
        $career_events = runQuery($career_events_query);
        $events = runQuery($events_query);
        if(count((array)$career_events) >= 1) {
          $events = array_slice($events, 0, 1);
        };
        if(count((array)$events) >= 1) {
          $career_events = array_slice($career_events, 0, 1);
        };
        //var_dump($career_events, $events, count((array)$career_events), count((array)$events));
        $teaser = array_merge($teaser, $career_events);
        $teaser = array_merge($teaser, $events);
        $news_topic = runQueryNews($news_topic_query); // for News we must do it differently
        $news_thirty = runQueryNews($news_thirty_query);
        $news_combined_array = array();
        // If Post ID is found in both array push it into final array
        if(!empty($news_thirty)) {
          foreach($news_thirty as $item) {
              if(!empty($news_topic) && in_array($item, $news_topic)) {
                  array_push($news_combined_array, $item);
              }
          };
        };
        $final_news_array = array();
        if(!empty($news_combined_array)) {
            // Push The fields for each post onto the array:
            foreach($news_combined_array as $item) {
                $post_id = $item;
                $post_object = new \stdClass;
                $post_object->id = $post_id;
                $post_object->title = get_the_title($post_id);
                $post_object->post_type = get_post_type($post_id);
                $post_object->url = get_post_permalink($post_id);
                $post_object->date_published = get_the_date('d.m.Y', $post_id);
                $post_object->teaser_text = get_field('teaser_text', $post_id);
                $post_object->teaser_image_vertical = get_field('teaser_image_vertical', $post_id);
                $post_object->teaser_image = get_field('teaser_image', $post_id);
                $post_object->teaser_video = get_field('teaser_video', $post_id); 
                array_push($final_news_array, $post_object); 
            }
        }
        $final_news_sliced = array_slice($final_news_array, 0, 2);
        $teaser = array_merge($teaser, $final_news_sliced);
        $products = runQuery($products_query);
        $teaser = array_merge($teaser, $products);
        $stories = runQuery($stories_query);
        $teaser_length = count($teaser);
        if( $featured_count === 1 ) {
            $teaser_length += 1;
        } else if( $featured_count === 2 ) {
            $teaser_length += 1;
        } else if ($featured_count === 3) {
            $teaser_length += 2;
        } 
        $remainder = 11 - $teaser_length;
        if($remainder < 11) {
            $stories = array_slice($stories, 0, $remainder);
            $teaser = array_merge($teaser, $stories);
        }
        
        
        $array_of_ids = '';
        $i = 0;
        foreach($teaser as $object) {
          $id = $object->id;
          $array_of_ids .= $id . ',';
          $i++;
        }

        //var_dump($array_of_ids);
        return [$teaser, $featured_count, $array_of_ids];
    } // end Teaser

    // New Information for the Jobs Teaser
    /*
    public function TopicName() {
        $topic = get_field('topic');
        $term = get_term( $topic, 'topics' );
        $term_name = '';
        if(!empty($term) && !empty($term->name)) {
            $term_name = $term->name;
        }
        return $term_name; 
    } */
    /*
    public function JobsPerTopic() {
        $topic = get_field('topic');
        $the_query = new WP_Query(array(
            'post_type' => 'jobs',
            'posts_per_page' => -1,
            'tax_query' => array(
              array(
                  'taxonomy' => 'topics',   // taxonomy name
                  'field' => 'term_id',           // term_id, slug or name
                  'terms' => $topic,                  // term id, term slug or term name
              )
            )
          )
        );

        $count = 0;
        while ($the_query->have_posts()): $the_query->the_post();
            $count += 1;
        endwhile;
        wp_reset_postdata();
        return $count;
        //var_dump($counted);
    } */
}

