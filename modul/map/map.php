<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>

    <div id="map"></div>
     <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script>

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}

    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiJ0TluQr0ul3OJX2S-yeG5Ovu7rfxsE8&callback=initMap"
        async defer></script>
  </body>
</html>