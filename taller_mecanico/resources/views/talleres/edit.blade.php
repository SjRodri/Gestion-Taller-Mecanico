@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Taller</h2>

    <form action="{{ route('talleres.update', $taller->taller_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $taller->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ $taller->ubicacion }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ $taller->telefono }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $taller->email }}" required>
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="horario" class="form-control" value="{{ $taller->horario }}" required>
        </div>

        {{-- MAPA --}}
        <h5>Ubicación del taller</h5>
        <div id="map" style="height: 350px;" class="mb-3"></div>

        <div class="mb-3">
            <label>Latitud</label>
            <input type="text" name="latitude" id="lat" class="form-control"
                value="{{ $taller->latitude }}" required readonly>
        </div>

        <div class="mb-3">
            <label>Longitud</label>
            <input type="text" name="longitude" id="lng" class="form-control"
                value="{{ $taller->longitude }}" required readonly>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('talleres.index') }}" class="btn btn-secondary ms-2">Cerrar</a>

    </form>
</div>

{{-- LEAFLET --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var lat = {
        {
            $taller - > latitude
        }
    };
    var lng = {
        {
            $taller - > longitude
        }
    };

    var map = L.map('map').setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

    map.on('click', function(e) {

        marker.setLatLng(e.latlng);

        document.getElementById('lat').value = e.latlng.lat.toFixed(7);
        document.getElementById('lng').value = e.latlng.lng.toFixed(7);
    });
</script>
@endsection