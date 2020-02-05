<template>
    <div class="uk-container">
      <div uk-grid class="uk-grid" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 350">
        <Teaser v-for="teaser of teasersShown" v-bind:key="teaser.id" v-bind:baseUrl="url" v-bind:title="teaser.title" v-bind:teaserText="teaser.acf.teaser_text" v-bind:postUrl="teaser.link" v-bind:posttype="teaser.type" v-bind:datePublished="teaser.date" v-bind:productType="teaser.product_type" v-bind:image="teaser.type === 'products' || teaser.type === 'stories' ? teaser.acf.teaser_image_vertical : teaser.acf.teaser_image" />
      </div>
      <div uk-grid class="uk-grid uk-flex-center">
        <button class="iav-more-teaser" v-bind:class="hideLoading ? 'uk-hidden' : 'uk-visible'" v-on:click="loadMore">
          {{ loading ? 'Loading...' : 'Load More' }}
        </button>
      </div>
    </div>
</template>

<script>
import Teaser from './Teaser.vue'
import axios from 'axios'

export default {
  name: 'App',
  props: {
    topic: Number,
    excludes: String,
    url: String,
    loads: Number,
  },
  data() {
    return {
      teasersShown: [],
      teasersFetched: [],
      loading: false,
      hideLoading: true,
      chunk: 9,
      //eventTypesArr: [],
    }
  },
  components: {
    Teaser,
    //Test,
  },
  
  methods: {
     loadMore: function (event) {
      event.preventDefault();
      //console.log('Clicked: LoadMoreFunction');
      this.loading = true;
      if(this.teasersShown.length < this.teasersFetched.length) { 
        let end = this.teasersShown.length + this.chunk;
        // take 9 of the fetched teasers and "show" them, add them to the ones showing
        let nextSlice = this.teasersFetched.slice(this.teasersShown.length, end);
        this.teasersShown = [...this.teasersShown, ...nextSlice];
        if(this.teasersFetched.length - this.teasersShown.length < this.chunk) {
          this.hideLoading = true;
        }
        this.loading = false;
      }
    },
  },  
  mounted () {
    if(this.loads > 8) {
      axios.all([
        // Fetch all the Teasers excluding the initally present in the Wordpress Template
        // axios.get(this.url + '/wp-json/wp/v2/events?topics=' + this.topic + '&order=desc&orderby=date&exclude=' + this.excludes),
        axios.get(this.url + '/wp-json/wp/v2/news?topics=' + this.topic + '&order=desc&orderby=date&exclude=' + this.excludes),
        axios.get(this.url + '/wp-json/wp/v2/stories?topics=' + this.topic + '&order=desc&orderby=date&exclude=' + this.excludes),
        axios.get(this.url + '/wp-json/wp/v2/products?topics=' + this.topic + '&order=desc&orderby=date&exclude=' + this.excludes),
        //axios.get(this.url + '/wp-json/wp/v2/event_type'),
      ])
      .then(axios.spread((newsRes, storiesRes, productsRes) => {
        this.teasersFetched = [...newsRes.data, ...storiesRes.data, ...productsRes.data];
        if(this.teasersFetched.length > 0) {
          this.hideLoading = false;
        }
        // Helper Function for Events Type in Events Vue
        /* if(eventTypeRes.data.length > 0) {
          var eventTypeResArray = eventTypeRes.data;
          var newArray = [];
          eventTypeResArray.forEach(eventType => {
            var myObject = {
              id: eventType.id,
              name: eventType.name,
            };
            newArray.push(myObject);
          })
          this.eventTypesArr = newArray;
        } */
      }));
    } 
  },                                                                                                                                
};
</script>

