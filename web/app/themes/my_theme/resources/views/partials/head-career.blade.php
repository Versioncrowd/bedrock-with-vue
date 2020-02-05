<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php wp_head() @endphp
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
          document.cookie = fp_disableStr + '=disable; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
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
          window.reload();
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
           document.cookie = fp_disableStr + '=disable; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
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


    <!-- End Facebook Pixel Code -->

    <!-- Chat Bot Code for Career Pages -->
    @if(ICL_LANGUAGE_CODE=='de')
      <script type="application/javascript" charset="UTF-8" src="https://cdn.agentbot.net/core/424a6783647610a4222134b610df5f6d.js"></script>
    @else
    <script type="application/javascript" charset="UTF-8" src="https://cdn.agentbot.net/core/4ada83bc058c49cbd10673f5702d9563.js"></script>
    @endif
    <!-- End Chat Bot Code for Career Pages -->
  </head>
