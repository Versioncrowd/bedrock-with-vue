<?php // @ app/controllers/Single.php

namespace App\Controllers\Partials\StageModules;

use WP_Query;

trait JobsTab
{
  public function JobsTab()
  {
  $result = 0;
  $jobs_tab = 0;
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'jobs',
      'suppress_filters' => false
    );   
    $jobs_tab = new WP_Query($args);
    $result = $jobs_tab ->found_posts;

  return $result;

  }
}

