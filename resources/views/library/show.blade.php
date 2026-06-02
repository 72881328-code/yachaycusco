@extends('layouts.app')

@section('title', $resource->title)

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8">
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-primary text-white px-3 py-1 rounded-full text-sm">{{ $resource->subject }}</span>
                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                    @if($resource->type == 'pdf') 📄 PDF
                    @elseif($resource->type == 'video') 🎥 Video
                    @else 🎵 Audio
                    @endif
                </span>
                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">{{ $resource->level }}</span>
                <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">🌐 {{ $resource->lang }}</span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $resource->title }}</h1>
            
            <div class="prose max-w-none mb-6">
                <p class="text-gray-600">{{ $resource->description ?? 'Sin descripción disponible.' }}</p>
            </div>
            
            <div class="flex items-center gap-6 mb-6 text-sm text-gray-500">
                <span>👁️ {{ $resource->views }} visualizaciones</span>
                <span>📥 {{ $resource->downloads }} descargas</span>
                @if($resource->author)
                <span>✍️ Por: {{ $resource->author->name }} {{ $resource->author->lastname }}</span>
                @endif
            </div>
            
            <div class="flex flex-wrap gap-3">
                @auth
                    <form action="{{ route('library.save', $resource->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-800">
                            {{ $isSaved ? '❤️ Guardado' : '🤍 Guardar para después' }}
                        </button>
                    </form>
                    
                    <button onclick="saveForOffline({{ $resource->id }}, '{{ $resource->title }}')" 
                            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        📥 Descargar para Offline
                    </button>
                @else
                    <a href="{{ route('login') }}" class="bg-primary text-white px-6 py-2 rounded-lg">
                        🔐 Inicia sesión para guardar recursos
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    @if($suggestions->count())
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-primary mb-6">📚 Recursos Relacionados</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($suggestions as $suggestion)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-bold mb-2">{{ Str::limit($suggestion->title, 50) }}</h3>
                <p class="text-sm text-gray-600 mb-3">{{ $suggestion->subject }} · {{ $suggestion->level }}</p>
                <a href="{{ route('library.show', $suggestion->id) }}" class="text-primary hover:underline text-sm">Ver recurso →</a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection