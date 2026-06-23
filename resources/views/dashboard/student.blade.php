@extends('layouts.app')

@section('title', 'Mi Panel - Estudiante')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-primary">📚 Mis Recursos Guardados</h1>
            <p class="text-gray-600 mt-2">Accede rápidamente a tus materiales favoritos y descubre los recursos más populares.</p>
        </div>
        <a href="{{ route('library.index') }}" class="bg-primary text-white px-4 py-2 rounded-lg shadow hover:bg-red-800">Explorar Biblioteca</a>
    </div>

    @if($savedResources->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($savedResources as $resource)
        <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition">
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
    <div class="mt-8">{{ $savedResources->links() }}</div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <p class="text-gray-500">No tienes recursos guardados.</p>
        <a href="{{ route('library.index') }}" class="inline-block mt-4 bg-primary text-white px-6 py-2 rounded-lg">Explorar Biblioteca</a>
    </div>
    @endif

    <div class="mt-12 bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-bold text-primary mb-4">📈 Estadísticas destacadas</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="border rounded-xl p-6 bg-gray-50">
                <p class="text-sm text-gray-500">Docente que subió más material</p>
                @if($topTeacher && $topTeacher->author)
                    <p class="mt-3 text-xl font-bold text-gray-800">{{ $topTeacher->author->name }} {{ $topTeacher->author->lastname }}</p>
                    <p class="text-gray-600">{{ $topTeacher->total }} recursos</p>
                @else
                    <p class="text-gray-500 mt-3">No hay suficientes datos aún.</p>
                @endif
            </div>
            <div class="border rounded-xl p-6 bg-gray-50">
                <p class="text-sm text-gray-500">Archivo más buscado</p>
                @if($topResource)
                    <p class="mt-3 text-xl font-bold text-gray-800">{{ $topResource->title }}</p>
                    <p class="text-gray-600">{{ $topResource->views }} vistas · {{ $topResource->downloads }} descargas</p>
                @else
                    <p class="text-gray-500 mt-3">Aún no hay recursos aprobados.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection