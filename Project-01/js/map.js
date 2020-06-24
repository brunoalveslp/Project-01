function myMap() {
    var mapCanvas = document.getElementById("map");
    var mapOptions = {
        center: new google.maps.LatLng(-27.0817512, -48.8921239),
        zoom: 16
    };
    var map = new google.maps.Map(mapCanvas, mapOptions);
}

myMap()