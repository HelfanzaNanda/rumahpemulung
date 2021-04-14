<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Rumah Pemulung</title>
    <!-- Bootstrap core JavaScript-->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('adm/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style>
    /*html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    }*/
    .controls {
    margin-top: 10px;
    border: 1px solid transparent;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    height: 32px;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 300px;
    }
    #pac-input:focus {
    border-color: #4d90fe;
    }
    /* .pac-container {
    font-family: Roboto;
    }*/
    #type-selector {
    color: #fff;
    background-color: #4d90fe;
    padding: 5px 11px 0px 11px;
    }
    #type-selector label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
    }
    #target {
    width: 345px;
    }
    
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYY-wMcvr6cGuSynbDsfyABKsGzOlz9X0&libraries=places&callback=initAutocomplete"
    async defer></script>
    <script>
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initAutocomplete() {
    <?php
    if (@$lat&&@$lng)
    {
    ?>
    var myLatlng = new google.maps.LatLng(<?php print $lat?>,<?php print $lng?>);
    <?php
    }else
    {
    ?>
    var myLatlng = new google.maps.LatLng(-6.917464, 107.619125);
    <?php
    }
    ?>
    var map = new google.maps.Map(document.getElementById('map'), {
    center: myLatlng,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var geocoder = new google.maps.Geocoder;
    var hasil = '';
    //default marker
    var def_marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    draggable:true,
    title: 'Pindahkan marker, kemudian klik 2 kali untuk mendapatkan lokasi'
    });
    google.maps.event.addListener(def_marker, "click", function (event) {
    var latitude = event.latLng.lat();
    var longitude = event.latLng.lng();
    var mantaps = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
    geocoder.geocode({'location': mantaps}, (results, status)=>{
    if (status == 'OK') {
      hasil = results[0].formatted_address;
    }else{
      hasil = results[0].formatted_address;
    }
    })
    document.getElementById('lat').value=latitude;
    document.getElementById('lng').value=longitude;
    document.getElementById('address').value=hasil;
    }); //end addListener
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
    });
    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();
    if (places.length == 0) {
    return;
    }
    // Clear out the old markers.
    markers.forEach(function(marker) {
    marker.setMap(null);
    });
    markers = [];
    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
    var _marker = new google.maps.Marker({
    position: place.geometry.location,
    map: map,
    draggable: true,
    title:'Pindahkan Marker dan Klik 2 kali Untuk Mendapatkan Data Lokasi'
    });
    google.maps.event.addListener(_marker, "click", function (event) {
    var latitude = event.latLng.lat();
    var longitude = event.latLng.lng();
    var mantaps = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
    geocoder.geocode({'location': mantaps}, (results, status)=>{
    if (status == 'OK') {
      hasil = results[0].formatted_address;
    }else{
      hasil = results[0].formatted_address;
    }
    })
    document.getElementById('lat').value=latitude;
    document.getElementById('lng').value=longitude;
    document.getElementById('address').value=hasil;
    }); //end addListener
    markers.push(_marker);
    if (place.geometry.viewport) {
    // Only geocodes have viewport.
    bounds.union(place.geometry.viewport);
    } else {
    bounds.extend(place.geometry.location);
    }
    });
    map.fitBounds(bounds);
    });
    }
    </script>
    <script>
    function CloseMySelf()
    {
    try {
    var lat=document.getElementById('lat').value;
    var lng=document.getElementById('lng').value;
    var address=document.getElementById('address').value;
    window.opener.HandlePopupResult({
    lat: lat,
    lng: lng,
    address: address,
    });
    }
    catch (err) {}
    window.close();
    return false;
    }
    </script>
  </head>

  <body class="container">
    <br>
    <br>
    <p>*)Pindahkan Marker dan Klik 2 kali Untuk Mendapatkan Data Lokasi</p>
    <input id="pac-input" class="controls" type="text" placeholder="Cari Alamat">
    <div id="map" style="height:450px;margin-bottom: 10px"></div>
    <div style="text-align:center">
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-6 col-xs-6">
            <div class="form-group">
              <input disabled="disabled" class="form-control" value="<?php print (isset($lat)?$lat:"")?>" type="text" name="lat" id="lat" placeholder="latitude">
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="form-group">
              <input disabled="disabled" class="form-control" value="<?php print (isset($lng)?$lng:"")?>" type="text" name="lng" id="lng"  placeholder="longitude">
            </div>
          </div>
          <div class="col-xs-8">
            <div class="form-group">
              <textarea class="form-control" value="<?php print (isset($address)?$address:"")?>" name="address" placeholder="Alamat" id="address" readonly style="margin-left:15px;"></textarea>
            </div>
          </div>
          <div class="col-xs-4">
            <a href="#" result="allow" onclick="return CloseMySelf();" class="btn btn-success btn-block" style="margin-left:40px;">pilih</a>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>