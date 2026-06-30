@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Hero Section -->
    <div class="glass border border-teal/30 rounded-2xl text-white p-12 mb-12">
        <h1 class="text-5xl font-bold mb-4"><span class="text-gold">Yachay</span><span class="text-teal">Cusco</span></h1>
        <p class="text-2xl mb-6 text-teal font-semibold">"Conectando saberes, construyendo futuros en el ande peruano"</p>
        <p class="text-lg opacity-90 text-gray-300 mb-8">Plataforma educativa offline-first para comunidades rurales del Cusco con contenido multilingüe</p>
        <div class="mt-8">
            <a href="{{ route('library.index') }}" class="btn-primary">
                Explorar Biblioteca →
            </a>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <div class="glass border border-teal/30 rounded-2xl p-8 text-center hover:border-teal/60 transition">
            <div class="text-5xl font-bold text-gold mb-2">{{ $totalResources ?? 0 }}</div>
            <div class="text-gray-300 text-lg">Recursos Educativos</div>
            <p class="text-gray-400 text-sm mt-2">Disponibles en la plataforma</p>
        </div>
        <div class="glass border border-teal/30 rounded-2xl p-8 text-center hover:border-teal/60 transition">
            <div class="text-5xl font-bold text-teal mb-2">{{ $totalDownloads ?? 0 }}</div>
            <div class="text-gray-300 text-lg">Descargas Realizadas</div>
            <p class="text-gray-400 text-sm mt-2">Por la comunidad educativa</p>
        </div>
    </div>
    
    <!-- Top Resources -->
    @if(isset($topResources) && $topResources->count())
    <div class="mb-12">
        <h2 class="text-3xl font-bold mb-8 text-gold">📚 Recursos Más Populares</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($topResources as $resource)
            <div class="glass border border-teal/30 rounded-2xl overflow-hidden hover:border-teal/60 transition group">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="bg-teal/20 text-teal text-xs px-3 py-1 rounded-full font-semibold">{{ $resource->subject }}</span>
                        <span class="bg-gold/20 text-gold text-xs px-3 py-1 rounded-full font-semibold">{{ $resource->type }}</span>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-white group-hover:text-gold transition">{{ $resource->title }}</h3>
                    <p class="text-gray-400 text-sm mb-4">{{ Str::limit($resource->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-teal">⬇️ {{ $resource->downloads }} descargas</span>
                        <a href="{{ route('library.show', $resource->id) }}" class="text-gold hover:text-gold/80 transition text-sm font-semibold">Ver más →</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Features -->
    <div class="glass border border-teal/30 rounded-2xl p-12">
        <h2 class="text-3xl font-bold text-center mb-12 text-gold">¿Por qué YachayCusco?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass-light border border-teal/20 rounded-xl p-8 text-center hover:border-teal/50 transition">
                <div class="text-5xl mb-4">📡</div>
                <h3 class="font-bold text-lg text-teal mb-2">Offline-First</h3>
                <p class="text-gray-400">Descarga recursos y accede sin conexión a internet en zonas rurales</p>
            </div>
            <div class="glass-light border border-teal/20 rounded-xl p-8 text-center hover:border-teal/50 transition">
                <div class="text-5xl mb-4">🗣️</div>
                <h3 class="font-bold text-lg text-teal mb-2">Contenido Bilingüe</h3>
                <p class="text-gray-400">Materiales en Castellano, Quechua y formato bilingüe</p>
            </div>
            <div class="glass-light border border-teal/20 rounded-xl p-8 text-center hover:border-teal/50 transition">
                <div class="text-5xl mb-4">🎓</div>
                <h3 class="font-bold text-lg text-teal mb-2">100% Gratuito</h3>
                <p class="text-gray-400">Educación de calidad al alcance de todos</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="mt-12 glass border border-gold/30 rounded-2xl p-12 text-center">
        <h2 class="text-3xl font-bold text-gold mb-4">¿Listo para descubrir?</h2>
        <p class="text-gray-300 mb-8 text-lg">Accede a cientos de recursos educativos diseñados para tu comunidad</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('library.index') }}" class="btn-primary">Explorar Ahora</a>
            @if (!Auth::check())
                <a href="{{ route('register') }}" class="btn-gold">Crear Cuenta</a>
            @endif
        </div>
    </div>
</div>
@endsection