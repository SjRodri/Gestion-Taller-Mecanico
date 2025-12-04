@extends('layouts.panel')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Sucursales</title>

    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>

<body>

    <div class="main-content">

        <div class="header-mapa">
            <h1>Dónde estamos ubicados en Honduras</h1>
        </div>

        <div class="mapa-container">
            <h2>Agenda una cita en tu taller más cercano</h2>
            <div id="map"></div>
        </div>

    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var map = L.map('map').setView([14.0723, -87.1921], 7);

            // Consumimos la API
            fetch('/api/talleres')
                .then(res => res.json())
                .then(puntos => {

                    puntos.forEach(p => {

                        // IMPORTANTE: usar latitude y longitude (como vienen en el JSON)
                        let lat = parseFloat(p.latitude);
                        let lng = parseFloat(p.longitude);

                        if (!lat || !lng) {
                            console.warn("Coordenadas inválidas:", p);
                            return;
                        }

                        L.marker([lat, lng])
                            .addTo(map)
                            .bindPopup(`
                        <strong>${p.nombre}</strong><br>
                        ${p.ubicacion}<br>
                        Tel: ${p.telefono}
                    `);
                    });
                })
                .catch(err => console.error('Error al cargar talleres:', err));

            // Capa base
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

        });
    </script>


</body>

</html>