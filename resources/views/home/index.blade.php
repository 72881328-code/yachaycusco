@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-red-700 rounded-2xl text-white p-12 mb-12">
        <h1 class="text-4xl font-bold mb-4">YachayCusco</h1>
        <p class="text-xl mb-6">"Conectando saberes, construyendo futuros en el ande peruano"</p>
        <p class="text-lg opacity-90">Plataforma educativa offline-first para comunidades rurales de Cusco</p>
        <div class="mt-8">
            <a href="{{ route('library.index') }}" class="bg-white text-primary px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Explorar Biblioteca
            </a>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="grid md:grid-cols-2 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold text-primary">{{ $totalResources ?? 0 }}</div>
            <div class="text-gray-600 mt-2">Recursos Educativos</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold text-primary">{{ $totalDownloads ?? 0 }}</div>
            <div class="text-gray-600 mt-2">Descargas Realizadas</div>
        </div>
    </div>
    
    <!-- Top Resources -->
    @if(isset($topResources) && $topResources->count())
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 text-primary">📚 Recursos Más Populares</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($topResources as $resource)
            <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs bg-secondary text-secondary-container px-2 py-1 rounded">{{ $resource->subject }}</span>
                        <span class="text-xs text-gray-500">{{ $resource->type }}</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $resource->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($resource->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📥 {{ $resource->downloads }} descargas</span>
                        <a href="{{ route('library.show', $resource->id) }}" class="text-primary hover:underline text-sm">Ver más →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Features -->
    <div class="bg-white rounded-xl shadow p-8">
        <h2 class="text-2xl font-bold text-center mb-8 text-primary">¿Por qué YachayCusco?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-4xl mb-3">📡</div>
                <h3 class="font-bold mb-2">Offline-First</h3>
                <p class="text-gray-600">Descarga recursos y accede sin conexión a internet</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-3">🗣️</div>
                <h3 class="font-bold mb-2">Contenido Bilingüe</h3>
                <p class="text-gray-600">Materiales en Castellano, Quechua y formato bilingüe</p>
            </div>
            <div class="text-center">
                <div class="text-4xl mb-3">🎓</div>
                <h3 class="font-bold mb-2">100% Gratuito</h3>
                <p class="text-gray-600">Educación de calidad al alcance de todos</p>
            </div>
        </div>
    </div>
</div>
@endsection