function showMap(address) {

  var map = document.createElement("div");
  map.id = "map";
  map.style.width = "100%";
  map.style.height = "200px";
  document.getElementById('mapContainer').appendChild(map);

  var geocoder = new google.maps.Geocoder();

  var map = new google.maps.Map(map, {
            zoom: 13,
            center: {lat: 39.6561216, lng: -0.4425349},
            disableDefaultUI: true,
            draggable: false
          });

  geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          }
        });
}
