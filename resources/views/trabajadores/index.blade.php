@extends('layouts.app')

@section('content')

@php
    use Carbon\Carbon;
@endphp
    <div class="py-4 px-6 -mt-5 bg-indigo-200 rounded flex justify-between">
        <form action="{{ route('trabajadores.filter') }}" method="post" class="flex justify-around w-2/3">
            @csrf
            <div class="w-2/3">
                <label for="buscar" class="sr-only">Busqueda</label>
                <input type="text" name="buscar" id="buscar" placeholder="Nombre, apellidos, departamento, cargos" class="bg-gray-200 px-4 py-2 rounded-lg text-indigo-900 placeholder:text-indigo-700 w-full">
            </div>

            <div class="flex w-1/4 justify-around items-center">
                <div>
                    <label for="sustituto">Sustituto</label>
                    <input type="checkbox" name="sustituto" id="sustituto" value="sustituto">
                </div>
                <div>
                    <label for="mayor">Mayor 55</label>
                    <input type="checkbox" name="mayor" id="mayor" value="mayor">
                </div>
            </div>

            <button type="submit" class="px-3 py-1 bg-blue-700 text-white rounded-full hover:cursor-pointer">Filtrar</button>
        </form>

        <div>
            <button class="px-3 py-2 bg-indigo-700 text-white rounded-lg">
                <a href="{{ route('trabajadores.create') }}">Añadir nuevo trabajador</a>
            </button>
        </div>
    </div>



    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-4">
        @foreach ($trabajadores as $trabajador)
        @php
        $nacimiento = Carbon::createFromFormat('Y-m-d', $trabajador->fecha_nacimiento)->startOfDay();
        $pumpeAnios = $nacimiento->format('m-d') === Carbon::now()->format('m-d')
        @endphp

        <div class="flex flex-col items-center text-center bg-gray-500 shadow-purple-350 shadow-sm hover:shadow-xl rounded-xl p-4 group">
            <div class="flex justify-center w-1/3 relative">
                @if ($pumpeAnios)
                <span class="absolute -left-2.5 md:left-4 lg:left-0">
                    <img style="height: 37px" src="/icons8-churro-96.png" alt="FELIZ PUMPE">
                </span>
                @endif
                <a href="{{ route('trabajadores.show', $trabajador->id) }}" class="h-18 w-18  overflow-hidden rounded-full border-2 border-cyan-800">
                    <img src="{{ Storage::url($trabajador->foto) }}" alt="{{ $trabajador->foto }}" class="">
                </a>

            </div>

            <h1 class="flex flex-col items-center">
                <a href="{{ route('trabajadores.show', $trabajador->id) }}" class="text-xl font-semobold">
                    {{ $trabajador->nombre }} {{ $trabajador->apellidos }}
                    @if ($trabajador->sustituto)
                        <span class="text-sm"> (Sustituto)</span>
                    @endif
                </a>
                <span class="text-md">{{ $trabajador->departamento }}</span>
            </h1>

            <div class="my-2 py-2">
                @foreach ($trabajador->cargos as $cargo)
                <span class="m-1 px-3 py-1 rounded-full font-medium text-{{$colors[strToLower($cargo)]}}-200 text-sm bg-{{$colors[strToLower($cargo)]}}-700">{{ $cargo }}</span>
                @endforeach
            </div>

            <div class="mb-3 border-b-1 border-gray-600 w-full"></div>

            <div class="flex justify-around w-2/3">
                <p><a href="{{ route('trabajadores.show', $trabajador->id) }}">Ver perfil</a></p>
                <div class="hidden group-hover:flex transition duration-500 justify-around">
                    <p class="mr-5">
                        <a href="{{ route('trabajadores.edit', $trabajador->id) }}">
                            <i class="fa-solid fa-pen-to-square" style="color: #3b144d;"></i>
                        </a>
                    </p>
                    <p>
                        <form action="{{ route('trabajadores.delete', $trabajador->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="hover:cursor-pointer">
                                <i class="fa-solid fa-trash" style="color: #3b144d;"></i>
                            </button>
                        </form>
                    </p>
                </div>
            </div>

        </div>            
        @endforeach
    </div>
@endsection