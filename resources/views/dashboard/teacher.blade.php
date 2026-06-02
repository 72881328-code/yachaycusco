@extends('layouts.app')

@section('title', 'Mi Panel - Docente')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-primary">📝 Panel del Docente</h1>
        <a href="{{ route('resources.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg">+ Nuevo Recurso</a>
    </div>
    
    <!-- Stats -->
    <div class="grid md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl font-bold text-primary">{{ $stats['total'] }}</div>
            <div class="text-sm text-gray-600">Total Recursos</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $stats['approved'] }}</div>
            <div class="text-sm text-gray-600">Aprobados</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
            <div class="text-sm text-gray-600">Pendientes</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['total_downloads'] }}</div>
            <div class="text-sm text-gray-600">Total Descargas</div>
        </div>
    </div>
    
    <!-- My Resources -->
    <div class="bg-white rounded-xl shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold">Mis Recursos</h2>
        </div>
        
        @if($myResources->count())
        <div class="divide-y">
            @foreach($myResources as $resource)
            <div class="p-6 flex justify-between items-center">
                <div>
                    <h3 class="font-bold">{{ $resource->title }}</h3>
                    <div class="flex gap-3 text-sm text-gray-500 mt-1">
                        <span>{{ $resource->subject }}</span>
                        <span>{{ $resource->level }}</span>
                        <span>{{ $resource->lang }}</span>
                        <span class="px-2 py-0.5 rounded text-xs 
                            @if($resource->status == 'approved') bg-green-100 text-green-800
                            @elseif($resource->status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($resource->status) }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('library.show', $resource->id) }}" class="text-blue-600 hover:underline text-sm">Ver</a>
                    <a href="{{ route('resources.edit', $resource->id) }}" class="text-yellow-600 hover:underline text-sm">Editar</a>
                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm" onclick="return confirm('¿Eliminar este recurso?')">Eliminar</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="p-4">
            {{ $myResources->links() }}
        </div>
        @else
        <div class="p-12 text-center text-gray-500">
            No has creado ningún recurso aún.
            <a href="{{ route('resources.create') }}" class="text-primary hover:underline">Crear mi primer recurso</a>
        </div>
        @endif
    </div>
</div>
@endsection