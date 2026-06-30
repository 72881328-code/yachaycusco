@extends('layouts.app')

@section('title', 'Biblioteca Digital')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-4xl font-bold text-gold mb-8">📖 Biblioteca Digital</h1>
    
    <!-- Filters -->
    <div class="glass border border-teal/30 rounded-2xl p-6 mb-8">
        <form method="GET" class="flex flex-col md:flex-row flex-wrap gap-4">
            <select name="level" class="bg-gray-700 border border-teal/30 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-teal/60">
                <option value="">Todos los niveles</option>
                <option value="Primaria" {{ request('level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ request('level') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
            </select>
            
            <select name="subject" class="bg-gray-700 border border-teal/30 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-teal/60">
                <option value="">Todas las materias</option>
                <option value="Matematica" {{ request('subject') == 'Matematica' ? 'selected' : '' }}>Matemática</option>
                <option value="Comunicacion" {{ request('subject') == 'Comunicacion' ? 'selected' : '' }}>Comunicación</option>
                <option value="Ciencia" {{ request('subject') == 'Ciencia' ? 'selected' : '' }}>Ciencia</option>
                <option value="Quechua" {{ request('subject') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                <option value="Historia" {{ request('subject') == 'Historia' ? 'selected' : '' }}>Historia</option>
            </select>
            
            <select name="type" class="bg-gray-700 border border-teal/30 text-white rounded-lg px-3 py-2 focus:outline-none focus:border-teal/60">
                <option value="">Todos los tipos</option>
                <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>🎥 Video</option>
                <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>🎵 Audio</option>
            </select>
            
            <div class="flex gap-2">
                <button type="submit" class="btn-primary">Filtrar</button>
                <a href="{{ route('library.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition">Limpiar</a>
            </div>
        </form>
    </div>
    
    <!-- Resources Grid -->
    @if($resources->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($resources as $resource)
        <div class="glass border border-teal/30 rounded-2xl overflow-hidden hover:border-teal/60 transition group">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-teal/20 text-teal text-xs px-3 py-1 rounded-full font-semibold">{{ $resource->subject }}</span>
                    <span class="text-xs text-gray-400">
                        @if($resource->type == 'pdf') 📄 PDF
                        @elseif($resource->type == 'video') 🎥 Video
                        @else 🎵 Audio
                        @endif
                    </span>
                </div>
                <h3 class="font-bold text-lg mb-2 text-white group-hover:text-gold transition">{{ $resource->title }}</h3>
                <p class="text-gray-400 text-sm mb-3">{{ Str::limit($resource->description, 80) }}</p>
                <div class="flex items-center justify-between text-sm text-gray-400 mb-4 pb-4 border-b border-teal/20">
                    <span>🌐 {{ $resource->lang }}</span>
                    <span>⬇️ {{ $resource->downloads }}</span>
                    <span>👁️ {{ $resource->views }}</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('library.show', $resource->id) }}" class="flex-1 text-center btn-primary text-sm">
                        Ver Detalle
                    </a>
                    @auth
                    <button onclick="saveForOffline({{ $resource->id }}, '{{ addslashes($resource->title) }}')" 
                            class="bg-yellow-500/20 hover:bg-yellow-500/40 text-yellow-400 hover:text-yellow-300 px-3 py-2 rounded-lg text-sm font-semibold transition border border-yellow-500/30">
                        💾
                    </button>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($resources->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $resources->links() }}
    </div>
    @endif
    @else
    <div class="glass border border-teal/30 rounded-2xl p-12 text-center">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-400 text-lg">No se encontraron recursos educativos</p>
        <a href="{{ route('library.index') }}" class="btn-primary inline-block mt-6">Ver Todos</a>
    </div>
    @endif
</div>
@endsection