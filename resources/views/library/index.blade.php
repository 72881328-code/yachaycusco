@extends('layouts.app')

@section('title', 'Biblioteca Digital')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-primary mb-6">📖 Biblioteca Digital</h1>
    
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-8">
        <form method="GET" class="flex flex-wrap gap-4">
            <select name="level" class="border rounded-lg px-3 py-2">
                <option value="">Todos los niveles</option>
                <option value="Primaria" {{ request('level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                <option value="Secundaria" {{ request('level') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
            </select>
            
            <select name="subject" class="border rounded-lg px-3 py-2">
                <option value="">Todas las materias</option>
                <option value="Matematica" {{ request('subject') == 'Matematica' ? 'selected' : '' }}>Matemática</option>
                <option value="Comunicacion" {{ request('subject') == 'Comunicacion' ? 'selected' : '' }}>Comunicación</option>
                <option value="Ciencia" {{ request('subject') == 'Ciencia' ? 'selected' : '' }}>Ciencia</option>
                <option value="Quechua" {{ request('subject') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                <option value="Historia" {{ request('subject') == 'Historia' ? 'selected' : '' }}>Historia</option>
            </select>
            
            <select name="type" class="border rounded-lg px-3 py-2">
                <option value="">Todos los tipos</option>
                <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
            </select>
            
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Filtrar</button>
            <a href="{{ route('library.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Limpiar</a>
        </form>
    </div>
    
    <!-- Resources Grid -->
    @if($resources->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($resources as $resource)
        <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
            <div class="p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">{{ $resource->subject }}</span>
                    <span class="text-xs text-gray-500">
                        @if($resource->type == 'pdf') 📄 PDF
                        @elseif($resource->type == 'video') 🎥 Video
                        @else 🎵 Audio
                        @endif
                    </span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $resource->title }}</h3>
                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($resource->description, 80) }}</p>
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span>🌐 {{ $resource->lang }}</span>
                    <span>📥 {{ $resource->downloads }}</span>
                    <span>👁️ {{ $resource->views }}</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('library.show', $resource->id) }}" class="flex-1 text-center bg-primary text-white px-3 py-2 rounded-lg text-sm hover:bg-red-800">
                        Ver Detalle
                    </a>
                    @auth
                    <button onclick="saveForOffline({{ $resource->id }}, '{{ $resource->title }}')" 
                            class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm hover:bg-gray-300">
                        📥 Offline
                    </button>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $resources->links() }}
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <p class="text-gray-500">No se encontraron recursos educativos.</p>
    </div>
    @endif
</div>
@endsection