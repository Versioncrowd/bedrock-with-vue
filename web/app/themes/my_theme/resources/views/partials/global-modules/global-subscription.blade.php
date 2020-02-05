@php
  $subscription_banner = $global_subscription;
@endphp
<div class="iav-global-subscription">
  <div class="uk-container">
    @if(!empty($subscription_banner['subscription_banner_text']))
        <h2>{{$subscription_banner['subscription_banner_text']}}</h2>
    @endif
    @if(!empty($subscription_banner['subscription_banner_link']))
        <p ><a href="{{$subscription_banner['subscription_banner_link']['url']}}" class="subs-link">{{$subscription_banner['subscription_banner_link']['title']}}</a></p>
    @endif
  </div>
</div>

