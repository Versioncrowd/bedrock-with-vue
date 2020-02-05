<template>
  <div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s uk-width-1-3@l uk-width-1-1">
    <!-- <a v-if="posttype === 'events'" :href="eventUrl ? eventUrl : postUrl" :target="eventUrl ? '_blank' : '_self'">
      <div class="iav-small-teaser events">
        <img v-if="image" class="iav-teaser-event-img" :src="image.url" alt="image.alt">
        <div :class="image ? 'iav-small-teaser-text-container-events' : 'iav-small-teaser-text-container-events-simple'"> 
          <div>
            <span> {{ parsedEventTypes }} </span>
          </div>
          <div v-if="eventStartDate && !eventEndDate && !eventDateFreeform" class="iav-teaser-event-dates">
            <span v-if="eventStartDate">{{ eventStartDate }} &mdash; </span>
          </div>
          <div v-else-if="eventStartDate && eventEndDate" class="iav-teaser-event-dates">
            <span>{{ eventStartDate }}</span>
            <span>- {{ eventEndDate }} &mdash;</span> 
          </div>
          <div v-else-if="eventStartDate && !eventEndDate && eventDateFreeform" class="iav-teaser-event-dates">
            <span>{{ eventDateFreeform }} &mdash;</span>
          </div>
          <h3>{{ parsedTitle | truncate(67) }}</h3>
          <div class="iav-event-teaser-location">
            <p>{{ eventLocation }}</p>
          </div>
          <p class="iav-teaser-description">{{ teaserText | truncate(200) }}</p>
        </div>
      </div>
    </a> -->
    <a v-if="posttype === 'news'" v-bind:href="postUrl">
      <div class="iav-small-teaser news">
        <img v-if="image" class="iav-teaser-event-img" :src="image.url" :alt="image.alt"> 
        <div :class="image ? 'iav-small-teaser-text-container-events' : 'iav-small-teaser-text-container-events-simple'"> 
            <div>
              <span>
                News
              </span>
                <span>– {{ parsedPublishDate }}</span>
            </div>
            <h3>{{ parsedTitle | truncate(67) }}</h3>
            <p class="iav-teaser-description">{{ teaserText | truncate(200) }}</p>
        </div>
      </div>
    </a>
    <a v-else-if="posttype === 'products'" v-bind:href="postUrl">  
      <div class="iav-product-teaser" v-bind:style="'backgroundImage: url(' + baseUrl + image.url + ');'">
        <div class="iav-product-overlay">
          <div>
            {{ productType }}
          </div>
          <h3>{{ parsedTitle | truncate(67) }}</h3>
          <p class="product-teaser-text">{{ teaserText | truncate(200) }}</p>
        </div>
      </div>
    </a>
    <a v-else-if="posttype === 'stories'" :href="postUrl">
      <div class="iav-story-teaser" v-bind:style="{ backgroundImage: 'url(' + baseUrl + image.url + ')' }">
        <div class="iav-story-overlay">
          <div>
            Was uns bewegt
          </div>
          <h3>{{ parsedTitle }}</h3>
          <p class="story-teaser-text">{{ teaserText | truncate(200) }}</p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>

export default {
  name: 'Teaser',
  props: {
    title: Object,
    baseUrl: String,
    posttype: String,
    image: [Boolean, Object],
    teaserText: String,
    postUrl: String, 
    template: String,
    //eventUrl: String,
    //eventLocation: String,
    //eventStartDate: String,
    //eventEndDate: String,
    //eventDateFreeform: String,
    //eventTypes: Array,
    datePublished: String,
    isSimpleEvent: String,
    productType: String,
    //eventTypesArray: Array,
  },
  data() {
    return {
      parsedTitle: '',
      parsedPublishDate: '',
      parsedEventTypes: 'Event',
    }
  },
  mounted() {
      // Parse the HTML Characters and turn them into normal Characters
      var title = this.title.rendered;
      var newString = title.replace(/&#(\d+);/g, function(match, dec) {
        return String.fromCharCode(dec);
      });
      this.parsedTitle = newString;

      if(this.datePublished.length > 0) {
        var dateNew = '';
        var date = this.datePublished;
        var date1 = date.slice(0, 10).split('-');
        dateNew = date1[2] + '.' + date1[1]+ '.'  + date1[0];
        this.parsedPublishDate = dateNew;
      }

      // Get the names of the Event Types from the Event Types Array by checking the id
      /* if(this.eventTypesArray && this.eventTypesArray.length > 0 && this.eventTypes && this.eventTypes.length > 0) {
        var parsed = '';
        this.eventTypes.forEach((eventTypeId, i) => {
          this.eventTypesArray.forEach(eventType => {
            if(eventType.id === eventTypeId) {
              if(i === 0) {
                parsed += eventType.name; 
              } else {
                parsed += ', ' + eventType.name;
              } 
            }
          })
        })
        if (parsed && parsed.length > 0) { 
          this.parsedEventTypes = parsed 
        }
      }  */
  },
}
</script>
