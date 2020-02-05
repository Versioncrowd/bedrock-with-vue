@php
    $map_zoom_level = $object->map_zoom_level;
    var_dump($locations);
    $map_locations = $locations;
    $markers_array = '[';
    $alphas = range('A', 'Z');
    foreach($map_locations as $key => $element) {
      $address = $element->google_maps_api_address;
      if ($key === array_key_last($map_locations)) {
        $markers_array .= '"' . $address . '"]';
      } else {
        $markers_array .= '"' . $address . '", ';
      } 
    };
@endphp

<div class="iav-map-container">
  <div style="width: 100vw; height: 500px;" id="map" data-mapzoom="{{$map_zoom_level}}" data-locations="{{$markers_array}}">
  </div>
</div>


<div class="uk-container iav-map-locations">
  @if(!empty($object->headline))
    <h3>{{$object->headline}}</h3>
  @endif
  <div uk-grid class="uk-grid">
    @foreach($map_locations as $item)
      <div id="{{$loop->index}}" class="iav-location-item uk-width-1-1 uk-width-1-2@s uk-width-1-3@m">
        @if(!empty($item->location_type))
          <h4 id="iav-map-location-type" class="iav-map-location-type">{{$item->location_type}}</h4>
        @endif
        <div class="iav-location-container">
          <div class="iav-map-location-iteration">
            {{$alphas[$loop->index]}}
          </div> 
          @if(!empty($item->location_name))
            <h6 id="iav-map-location-name" class="iav-map-location-name">{{$item->location_name}}</h6>
          @endif
          @if(!empty($item->location_image))
            <img hidden id="iav-map-location-image" class="iav-map-location-image" src="{{$item->location_image->url}}" />
          @endif
          @if(!empty($item->location_infos))
            <div id="iav-map-location-address" class="iav-map-location-address">{!!$item->location_infos!!}</div>
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>