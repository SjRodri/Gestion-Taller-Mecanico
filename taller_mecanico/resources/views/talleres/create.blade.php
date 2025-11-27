@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Taller</h2>

    <form action="{{ route('talleres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="horario" class="form-control" required>
        </div>

        {{-- MAPA --}}
        <h5>Seleccionar ubicación en el mapa</h5>
        <div id="map" style="height: 350px;" class="mb-3"></div>

        <div class="mb-3">
            <label>Latitud</label>
            <input type="text" name="latitude" id="lat" class="form-control" required readonly>
        </div>

        <div class="mb-3">
            <label>Longitud</label>
            <input type="text" name="longitude" id="lng" class="form-control" required readonly>
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('talleres.index') }}" class="btn btn-secondary ms-2">Cerrar</a>

    </form>
</div>

{{-- LEAFLET --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([14.0723, -87.1921], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker;

    map.on('click', function(e) {

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker(e.latlng).addTo(map);

        document.getElementById('lat').value = e.latlng.lat.toFixed(7);
        document.getElementById('lng').value = e.latlng.lng.toFixed(7);
    });
</script>
@endsection
