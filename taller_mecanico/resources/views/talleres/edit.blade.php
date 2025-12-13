@extends('layouts.panel')

@section('content')
<div class="container">
    <h2>Editar Taller</h2>

    <form action="{{ route('talleres.update', $taller->taller_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $taller->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label>Ubicación</label>
            <input type="text" name="ubicacion" class="form-control" value="{{ old('ubicacion', $taller->ubicacion) }}" required>
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                value="{{ old('telefono', $taller->telefono) }}"
                required maxlength="8" pattern="\d{8}"
                title="El teléfono debe tener exactamente 8 números">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $taller->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="horario" class="form-control" value="{{ old('horario', $taller->horario) }}" required>
        </div>

        {{-- MAPA --}}
        <h5>Ubicación del taller</h5>
        <div id="map" style="height: 350px;" class="mb-3"></div>

        <div class="mb-3">
            <label>Latitud</label>
            <input type="text" name="latitude" id="lat" class="form-control" value="{{ old('latitude', $taller->latitude) }}" required>
        </div>

        <div class="mb-3">
            <label>Longitud</label>
            <input type="text" name="longitude" id="lng" class="form-control" value="{{ old('longitude', $taller->longitude) }}" required>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('talleres.index') }}" class="btn btn-secondary ms-2">Cerrar</a>

    </form>
</div>

{{-- LEAFLET --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var lat = parseFloat(document.getElementById('lat').value) || 14.0723;
    var lng = parseFloat(document.getElementById('lng').value) || -87.1921;

    var map = L.map('map').setView([lat, lng], lat && lng ? 14 : 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker = L.marker([lat, lng], {
        draggable: true
    }).addTo(map);

    function updateInputs(e) {
        document.getElementById('lat').value = e.latlng.lat.toFixed(7);
        document.getElementById('lng').value = e.latlng.lng.toFixed(7);
    }

    marker.on('dragend', function(e) {
        updateInputs(e.target.getLatLng ? {
            latlng: e.target.getLatLng()
        } : e);
    });

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateInputs(e);
    });

    document.getElementById('lat').addEventListener('input', function() {
        var newLat = parseFloat(this.value);
        var newLng = parseFloat(document.getElementById('lng').value);
        if (!isNaN(newLat) && !isNaN(newLng)) {
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], map.getZoom());
        }
    });

    document.getElementById('lng').addEventListener('input', function() {
        var newLat = parseFloat(document.getElementById('lat').value);
        var newLng = parseFloat(this.value);
        if (!isNaN(newLat) && !isNaN(newLng)) {
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], map.getZoom());
        }
    });
</script>
@endsection