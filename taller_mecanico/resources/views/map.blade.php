<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Mapa de Talleres</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>

<body>
    <div id="map" style="height: 500px;"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([14.0818, -87.2068], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contribuyentes'
            }).addTo(map);

            var locations = @json($locations);

            locations.forEach(function(loc) {
                L.marker([loc.latitude, loc.longitude])
                    .addTo(map)
                    .bindPopup(loc.name);
            });
        });
    </script>
</body>

</html>