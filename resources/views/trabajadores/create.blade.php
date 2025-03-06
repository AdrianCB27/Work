@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 rounded-lg shadow-lg bg-indigo-800 text-white">
    <h1 class="text-3xl font-bold text-center mb-6"> Añadir Trabajador </h1>

    <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 
        
        <label class="block mb-2 font-semibold">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border p-2 rounded">
        <br>

        <label class="block mt-4 mb-2 font-semibold">Apellidos</label>
        <input type="text" name="apellidos" value="{{ old('apellidos') }}" class="w-full border p-2 rounded">
        <br>

        <label class="block mt-4 mb-2 font-semibold">Teléfono</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}" class="w-full border p-2 rounded">
        <br>

        <label class="block mt-4 mb-2 font-semibold">Correo Electrónico</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border p-2 rounded">
        <br>

        <label class="block mt-4 mb-2 font-semibold">Foto</label>
        <input type="file" name="foto" class="w-full border p-2 rounded">
        @error('foto')            
        <p>{{ $message }}</p>
        @enderror
        <br>

        <label class="block mt-4 mb-2 font-semibold">Departamento</label>
        <select name="departamento" class="w-full border p-2 rounded">
            @foreach($deps as $key => $departamento)
                <option class="black" value="{{ $key }}">
                    {{ $departamento }}
                </option>
            @endforeach
        </select>
        <br>
        
        <label class="block mt-4 mb-2 font-semibold">Cargos</label>
        <div class="flex flex-wrap">
            @foreach($cargos as $key => $cargo)
                <div class="mr-6 mb-2">
                    <input id="{{ $key }}" type="checkbox" name="cargos[]" value="{{ $key }}"
                    class="mr-2">
                    <label for="{{ $key }}">{{ $cargo }}</label>
                </div>
            @endforeach
        </div>
        <br>
        
        <label class="block mt-4 mb-2 font-semibold">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="w-full border p-2 rounded">
        <br>

        <label class="block mt-4 mb-2 font-semibold">Sustituto</label>
        <input type="checkbox" name="sustituto" class="mr-2">
        <br>

        <button type="submit" class="mt-6 w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
            Crear
        </button>
    </form>
</div>
@endsection