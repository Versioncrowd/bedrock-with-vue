<?php // @ app/controllers/Single.php

namespace App\Controllers\Partials;

use WP_Query;

trait AutomotionBanner
{
  public function AutomotionBanner()
    {
      $automotion_banner = array();
      $automotion_banner = get_field('automotion_banner', 'option');
      //var_dump($automotion_banner);
      return $automotion_banner;
    } 
} 