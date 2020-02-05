// // Import everything from autoload
// import "./autoload/**/*"

// Import 'fullpage.js'
import 'jquery';

// Import 'uikit';
import 'uikit';

// Import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
import templateTeaserVueData from './routes/template-teaser';
// import Icons from 'uikit/dist/js/uikit-icons';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  templateTeaserVueData,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
