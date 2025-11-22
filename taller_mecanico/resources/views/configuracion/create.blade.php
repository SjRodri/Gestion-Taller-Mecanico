@extends('welcome')

@section('content')
<div style="padding: 20px;">
    <h2 style="font-size: 22px; margin-bottom: 20px;">➕ Agregar Configuración</h2>

    <a href="{{ route('configuracion.index') }}" 
       style="display: inline-block; padding: 8px 12px; color: white; background: #222; border-radius: 5px; text-decoration: none; margin-bottom: 20px;">
        🔙 Volver al Listado
    </a>

    <form action="{{ route('configuracion.store') }}" method="POST" 
          style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="clave" style="display: block; font-weight: bold; margin-bottom: 5px;">Clave</label>
            <input type="text" name="clave" id="clave" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="valor" style="display: block; font-weight: bold; margin-bottom: 5px;">Valor</label>
            <input type="text" name="valor" id="valor" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="descripcion" style="display: block; font-weight: bold; margin-bottom: 5px;">Descripción</label>
            <textarea name="descripcion" id="descripcion" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;"></textarea>
        </div>

        <button type="submit" 
                style="padding: 10px 15px; background: #222; color: white; border: none; border-radius: 5px; cursor: pointer;">
            💾 Guardar Configuración
        </button>
    </form>
</div>
@endsection
