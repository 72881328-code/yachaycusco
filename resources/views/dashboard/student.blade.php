@extends('layouts.app')

@section('title', 'Mi Panel - Estudiante')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-primary mb-6">📚 Mis Recursos Guardados</h1>
    
    @if($savedResources->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($savedResources as $resource)
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ $resource->subject }}</span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $resource->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($resource->description, 80) }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('library.show', $resource->id) }}" class="flex-1 text-center bg-primary text-white px-3 py-2 rounded-lg text-sm">
                        Ver Recurso
                    </a>
                    <form action="{{ route('library.save', $resource->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $savedResources->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <p class="text-gray-500">No tienes recursos guardados.</p>
        <a href="{{ route('library.index') }}" class="inline-block mt-4 bg-primary text-white px-6 py-2 rounded-lg">Explorar Biblioteca</a>
    </div>
    @endif
</div>
@endsection