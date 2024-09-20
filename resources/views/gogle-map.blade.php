<!DOCTYPE html>
<html>
<head>
    <title>Select Location from Map</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #selectedLocation {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBecVmH1Y3ZVu6YjtOsBOW-mPYQrSOq_Gc&callback=initMap" async defer></script>
    <script>
        let map, marker;

        function initMap() {
            const initialLocation = { lat:27.698588559774088, lng: 85.30444392266055}; // Initial map center

            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 8
            });

            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true
            });

            // Update the input field when the marker is dragged
            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById('selectedLocation').value = event.latLng.lat() + ', ' + event.latLng.lng();
            });

            // Update the input field when the map is clicked
            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById('selectedLocation').value = event.latLng.lat() + ', ' + event.latLng.lng();
            });
        }
    </script>
</head>
<body onload="initMap()">
    <h1>Select Location from Map</h1>
    <input type="text" id="selectedLocation" placeholder="Selected location will appear here" readonly>
    <div id="map"></div>
</body>
</html>
