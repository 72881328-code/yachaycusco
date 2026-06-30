@extends('layouts.app')

@section('title', 'Mi Panel - Estudiante')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gold mb-2">📚 Mis Recursos Guardados</h1>
            <p class="text-gray-400">Accede rápidamente a tus materiales favoritos y descubre recursos destacados</p>
        </div>
        <a href="{{ route('library.index') }}" class="btn-primary self-fit">Explorar Biblioteca</a>
    </div>

    @if($savedResources->count())
    <!-- Saved Resources Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($savedResources as $resource)
        <div class="glass border border-teal/30 rounded-2xl overflow-hidden hover:border-teal/60 transition group">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-teal/20 text-teal text-xs px-3 py-1 rounded-full font-semibold">{{ $resource->subject }}</span>
                    <span class="text-xl">⭐</span>
                </div>
                <h3 class="font-bold text-lg text-white mb-2 group-hover:text-gold transition">{{ $resource->title }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ Str::limit($resource->description, 80) }}</p>
                <div class="flex gap-2">
                    <a href="{{ route('library.show', $resource->id) }}" class="flex-1 btn-primary text-center text-sm">
                        👁️ Ver
                    </a>
                    <form action="{{ route('library.save', $resource->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500/20 hover:bg-red-500/40 text-red-400 hover:text-red-300 px-4 py-2 rounded-lg text-sm font-semibold transition border border-red-500/30">
                            ✗
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($savedResources->hasPages())
        <div class="mb-12 flex justify-center">
            {{ $savedResources->links() }}
        </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="glass border border-teal/30 rounded-2xl p-12 text-center mb-12">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-400 text-lg mb-6">No tienes recursos guardados aún</p>
        <a href="{{ route('library.index') }}" class="btn-primary inline-block">Explorar Biblioteca</a>
    </div>
    @endif

    <!-- Statistics Section -->
    <div class="glass border border-teal/30 rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gold mb-6">📈 Estadísticas Destacadas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Top Teacher -->
            <div class="glass-light border border-teal/20 rounded-xl p-6">
                <p class="text-sm text-gray-400 mb-3">👨‍🏫 Docente Destacado</p>
                @if($topTeacher && $topTeacher->author)
                    <p class="text-2xl font-bold text-gold mb-2">{{ $topTeacher->author->name }}</p>
                    <p class="text-gray-300">{{ $topTeacher->total }} recursos creados</p>
                @else
                    <p class="text-gray-400 mt-3">No hay datos disponibles aún</p>
                @endif
            </div>

            <!-- Top Resource -->
            <div class="glass-light border border-teal/20 rounded-xl p-6">
                <p class="text-sm text-gray-400 mb-3">⭐ Recurso Más Popular</p>
                @if($topResource)
                    <p class="text-lg font-bold text-teal mb-2">{{ $topResource->title }}</p>
                    <div class="flex gap-4 text-sm">
                        <span class="text-gray-300">👁️ {{ $topResource->views }} vistas</span>
                        <span class="text-gold">⬇️ {{ $topResource->downloads }} descargas</span>
                    </div>
                @else
                    <p class="text-gray-400 mt-3">Aún no hay recursos publicados</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection