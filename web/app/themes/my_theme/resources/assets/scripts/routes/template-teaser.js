import Vue from 'vue'
import App from '../vue/App.vue';
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

export default {
  init() {
    // JavaScript to be fired on the home page
    Vue.config.productionTip = false
    // loads the Icon plugin
    UIkit.use(Icons);

    Vue.config.productionTip = false
    // loads the Icon plugin
    UIkit.use(Icons);

    Vue.filter('truncate', function (value, limit) {
      if (!value) return '';
      if (value.length >= 67) return value.substring(0, limit) + ' ...'
      else return value;
    })

    new Vue({
      el: "#app",
      components: {
        App,
      },
    });

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
    //console.log('Teaser Test Vue Data')
  },
};