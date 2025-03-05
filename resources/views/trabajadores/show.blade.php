@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@section('content')

<div class="flex flex-col bg-indigo-500 w-1/2 mx-auto py-12 rounded-4xl">
    <div class="flex w-2/3 justify-between mx-auto px-5">
        <a href="{{ route('trabajadores.edit', $trabajador->id) }}">
            <i class="fa-solid fa-pen-to-square" style="color: #cb90e6;"></i>
        </a>
        <h1 class="text-3xl font-bold text-center mb-6">Detalles del Trabajador</h1>
        <form action="{{ route('trabajadores.delete', $trabajador->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="hover:cursor-pointer">
                <i class="fa-solid fa-trash" style="color: rgb(255, 125, 125);"></i>
            </button>
        </form>
    </div>

    
    <div>
        <div class="rounded-full shadow-md shadow-cyan-600 mx-auto h-48 w-48 overflow-hidden">
            <img src="{{ asset('storage/' . $trabajador->foto) }}" class="object-cover">
        </div>

        <div class="text-center w-full">
            <h1 class="text-4xl font-semibold mt-3">{{ $trabajador->nombre }} {{ $trabajador->apellidos }}
            @if ($trabajador->sustituto)
                <span class="text-sm"> (Sustituto)</span>
            @endif
            </h1>
            <p class="flex justify-center px-4 pb-3">
                <span class="pt-3 text-xl"> {{ implode(', ', $trabajador->cargos) }} </span>
            </p>

        </div>
    </div>


    <div class="text-center text-lg">
        <div>
            <p><i class="fa-solid fa-building" style="color: #3b144d;"></i> {{ $trabajador->departamento }} </p>
            <p><i class="fa-solid fa-phone-flip" style="color: #3b144d;"></i> {{ $trabajador->telefono }}</p>
            <p><i class="fa-solid fa-envelope" style="color: #3b144d;"></i> <a href="mailto:{{ $trabajador->email }}" class="text-cyan-100 hover:underline">{{ $trabajador->email }}</a></p>
            <p><i class="fa-solid fa-child-reaching" style="color: #3b144d;"></i> {{ Carbon::parse($trabajador->fecha_nacimiento)->format('d/m/Y') }}</p>
        </div>
    </div>
</div>
@endsection