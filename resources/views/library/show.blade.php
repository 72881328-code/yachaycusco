@extends('layouts.app')

@section('title', $resource->title)

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="glass border border-teal/30 rounded-2xl overflow-hidden">
        <div class="p-8">
            <!-- Tags -->
            <div class="flex items-center gap-3 mb-6 flex-wrap">
                <span class="bg-teal/20 text-teal px-3 py-1 rounded-full text-sm font-semibold">{{ $resource->subject }}</span>
                <span class="bg-gold/20 text-gold px-3 py-1 rounded-full text-sm font-semibold">
                    @if($resource->type == 'pdf') 📄 PDF
                    @elseif($resource->type == 'video') 🎥 Video
                    @else 🎵 Audio
                    @endif
                </span>
                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm">{{ $resource->level }}</span>
                <span class="bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm">🌐 {{ $resource->lang }}</span>
            </div>
            
            <!-- Title -->
            <h1 class="text-4xl font-bold text-gold mb-4">{{ $resource->title }}</h1>
            
            <!-- Description -->
            <div class="prose prose-invert max-w-none mb-8">
                <p class="text-gray-300">{{ $resource->description ?? 'Sin descripción disponible.' }}</p>
            </div>
            
            <!-- Stats -->
            <div class="flex items-center gap-6 mb-8 text-sm text-gray-400 pb-8 border-b border-teal/20">
                <span>👁️ {{ $resource->views }} visualizaciones</span>
                <span>⬇️ {{ $resource->downloads }} descargas</span>
                @if($resource->author)
                <span>✍️ Por: <span class="text-teal">{{ $resource->author->name }}</span></span>
                @endif
            </div>
            
            <!-- Actions -->
            <div class="flex flex-wrap gap-3">
                @auth
                    <form action="{{ route('library.save', $resource->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-primary">
                            {{ $isSaved ? '❤️ Guardado' : '🤍 Guardar' }}
                        </button>
                    </form>
                    
                    @if($resource->type === 'pdf' && $resource->file_path)
                        <a href="{{ route('resources.file', $resource->id) }}" class="bg-teal hover:bg-teal/80 text-white font-semibold py-2 px-6 rounded-lg transition">
                            📄 Descargar PDF
                        </a>
                    @endif

                    <button onclick="saveForOffline({{ $resource->id }}, '{{ addslashes($resource->title) }}')" 
                            class="bg-gold hover:bg-gold/80 text-gray-900 font-semibold py-2 px-6 rounded-lg transition">
                        💾 Descargar Offline
                    </button>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        🔐 Inicia sesión para guardar
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    <!-- Related Resources -->
    @if($suggestions->count())
    <div class="mt-12">
        <h2 class="text-3xl font-bold text-gold mb-8">📚 Recursos Relacionados</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($suggestions as $suggestion)
            <div class="glass border border-teal/30 rounded-xl p-6 hover:border-teal/60 transition group">
                <h3 class="font-bold mb-2 text-white group-hover:text-gold transition">{{ Str::limit($suggestion->title, 50) }}</h3>
                <p class="text-sm text-gray-400 mb-4">{{ $suggestion->subject }} · {{ $suggestion->level }}</p>
                <a href="{{ route('library.show', $suggestion->id) }}" class="text-teal hover:text-gold transition text-sm font-semibold">Ver recurso →</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection