@extends('layouts.app')

@section('title', 'Editar Recurso')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold text-primary mb-6">✏️ Editar Recurso</h1>
        
        <form action="{{ route('resources.update', $resource->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Título *</label>
                <input type="text" name="title" value="{{ old('title', $resource->title) }}" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Descripción</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2">{{ old('description', $resource->description) }}</textarea>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Materia *</label>
                    <select name="subject" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Matematica" {{ $resource->subject == 'Matematica' ? 'selected' : '' }}>Matemática</option>
                        <option value="Comunicacion" {{ $resource->subject == 'Comunicacion' ? 'selected' : '' }}>Comunicación</option>
                        <option value="Ciencia" {{ $resource->subject == 'Ciencia' ? 'selected' : '' }}>Ciencia</option>
                        <option value="Quechua" {{ $resource->subject == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Historia" {{ $resource->subject == 'Historia' ? 'selected' : '' }}>Historia</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Nivel *</label>
                    <select name="level" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Primaria" {{ $resource->level == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                        <option value="Secundaria" {{ $resource->level == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                    </select>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Idioma *</label>
                    <select name="lang" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Castellano" {{ $resource->lang == 'Castellano' ? 'selected' : '' }}>Castellano</option>
                        <option value="Quechua" {{ $resource->lang == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Bilingue" {{ $resource->lang == 'Bilingue' ? 'selected' : '' }}>Bilingüe</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Tipo *</label>
                    <select name="type" required class="w-full border rounded-lg px-3 py-2">
                        <option value="pdf" {{ $resource->type == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="video" {{ $resource->type == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="audio" {{ $resource->type == 'audio' ? 'selected' : '' }}>Audio</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Archivo PDF</label>
                <input type="file" name="file" accept="application/pdf" class="w-full text-sm text-gray-500 file:border file:border-gray-300 file:rounded-lg file:px-3 file:py-2">
                @error('file')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
                @if($resource->file_path)
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: <a href="{{ asset('storage/'.$resource->file_path) }}" target="_blank" class="text-primary hover:underline">Ver PDF</a></p>
                @endif
                <p class="text-xs text-gray-500 mt-2">Sube un nuevo PDF solo si deseas reemplazar el existente.</p>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-800">Actualizar</button>
                <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection