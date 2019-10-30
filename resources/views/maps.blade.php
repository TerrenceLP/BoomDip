@extends('layouts.yelp')

@section('content')
<!-- Create an instance of the todo-item component -->
<div class="container">
<div class="row">
    <div class="col text-center">
        <example-component></example-component>
        <card-component></card-component>
    </div>
</div>
<div class="row">
    <div class="col">
        <div id="map" style="height:600px; width:100%;"></div>
        <script type="application/javascript">
            // Note: This example requires that you consent to location sharing when
            // prompted by your browser. If you see the error "The Geolocation service
            // failed.", it means you probably did not give permission for the browser to
            // locate you.
            var map, infoWindow;

            function initMap() {
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 10
              });

              infoWindow = new google.maps.InfoWindow;

              // Try HTML5 geolocation.
              if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(

                  function(position) {

                      var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                      };

                      infoWindow.setPosition(pos);
                      infoWindow.setContent('Location found.');
                      infoWindow.open(map);
                      map.setCenter(pos);
                      console.log(JSON.stringify(pos));
                  },

                  function() {
                      handleLocationError(true, infoWindow, map.getCenter());
                  }
                );
              } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
              }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
              infoWindow.setPosition(pos);
              infoWindow.setContent(browserHasGeolocation ?
                                    'Error: The Geolocation service failed.' :
                                    'Error: Your browser doesn\'t support geolocation.');
              infoWindow.open(map);
            }
          </script>

          <script type="application/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap"></script>
    </div>
</div>
</div>
@endsection
