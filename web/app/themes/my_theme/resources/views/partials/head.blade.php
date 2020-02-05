<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php wp_head() @endphp
  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
  <script src="{!! get_template_directory_uri() !!}/assets/scripts/bodyScrollLock.js"></script>

 <!-- Start New Facebook Pixel Code -->

 <script data-pixel="fb">
     var optOutWish = function() {
       var doNotTrack = navigator.doNotTrack === '1';
       var hasOptedOut = localStorage.getItem('fb-pixel-status') === 'opt-out';
       return doNotTrack || hasOptedOut;
       var fp_disableStr = 'fb-pixel-is-disabled';
       if (document.cookie.indexOf(fp_disableStr + '=true') > -1) {
       window[fp_disableStr] = true;
       console.log("Facebook-Pixel ist deaktiviert - Cookie erkannt");}
     }
     var optinWish = function() {
       var doNotTrack = navigator.doNotTrack !== '1';
       var hasOptedin = localStorage.getItem('fb-pixel-status') === 'opt-in';
     }

     if (optOutWish()) {
      var fp_disableStr = '_fbp';
       document.cookie = fp_disableStr + '=disable; max-age=10368000; path=/';
       window[fp_disableStr] = true;
       eraseCookie('_fbp');
       console.log("Facebook-Pixel ist jetzt deaktiviert - Page Refresh nötig");
       location.reload();
       console.info('User prohibits tracking. Not embedding Facebook’s script.')
     }
      if (optinWish()) {
       console.log('Embedding Facebook’s script.');
       !function(f,b,e,v,n,t,s)
       {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
       n.callMethod.apply(n,arguments):n.queue.push(arguments)};
       if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
       n.queue=[];t=b.createElement(e);t.async=!0;
       t.src=v;s=b.getElementsByTagName(e)[0];
       s.parentNode.insertBefore(t,s)}(window, document,'script',
       'https://connect.facebook.net/en_US/fbevents.js');
       fbq('init', '604633606681791');
       fbq('track', 'PageView');
     }
   </script>

   <script type="text/javascript">
       var username = getCookie("fb-pixel-status");
       if (username == "opt-in") {
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window, document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '604633606681791');
         fbq('track', 'PageView');
       } else {
         var fp_disableStr = '_fbp';
          document.cookie = fp_disableStr + '=disable; max-age=10368000; path=/';
          window[fp_disableStr] = true;
       }
     function getCookie(name) {
         var value = "; " + document.cookie;
         var parts = value.split("; " + name + "=");
         if (parts.length == 2) return parts.pop().split(";").shift();
       }
   </script>

  <script src="{!! get_template_directory_uri() !!}/assets/scripts/FacebookPixelController-min.js" async></script>
  <script src="{!! get_template_directory_uri() !!}/assets/scripts/main-min.js" async></script>

  <script>
    var paintStatus = function() {
      var optOut = optOutWish();
      var $status = document.querySelector('.js-opt-out-status');
      var text = optOut ? 'Pixel ist deaktiviert.' : 'Pixel ist aktiviert.';
      //$status.innerText = text;
    }
    var init = function () {
      if (document.readyState === 'complete') {
          paintStatus();
      } else {
          setTimeout(function() {
              init();
          }, 50);
      }
    }
    init();
    </script>

 <!-- New Facebook Pixel Code End -->
  <!-- Start google captcha -->
     <script type="text/javascript">
     
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LfNsakUAAAAAPS8hOMeJPn0AMFG4mmSNkn2LT3o'
        });
      };
      
    </script>
 <!--End google captcha-->

</head>
