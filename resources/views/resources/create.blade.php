@extends('layouts.app')

@section('title', 'Crear Recurso')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold text-primary mb-6">📤 Crear Nuevo Recurso</h1>
        
        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Título *</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Descripción</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2">{{ old('description') }}</textarea>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Materia *</label>
                    <select name="subject" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Matematica" {{ old('subject') == 'Matematica' ? 'selected' : '' }}>Matemática</option>
                        <option value="Comunicacion" {{ old('subject') == 'Comunicacion' ? 'selected' : '' }}>Comunicación</option>
                        <option value="Ciencia" {{ old('subject') == 'Ciencia' ? 'selected' : '' }}>Ciencia</option>
                        <option value="Quechua" {{ old('subject') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Historia" {{ old('subject') == 'Historia' ? 'selected' : '' }}>Historia</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Nivel *</label>
                    <select name="level" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Primaria" {{ old('level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                        <option value="Secundaria" {{ old('level') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                    </select>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Idioma *</label>
                    <select name="lang" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Castellano" {{ old('lang') == 'Castellano' ? 'selected' : '' }}>Castellano</option>
                        <option value="Quechua" {{ old('lang') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Bilingue" {{ old('lang') == 'Bilingue' ? 'selected' : '' }}>Bilingüe</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Tipo *</label>
                    <select name="type" required class="w-full border rounded-lg px-3 py-2">
                        <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                        <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Archivo PDF</label>
                <input type="file" name="file" accept="application/pdf" class="w-full text-sm text-gray-500 file:border file:border-gray-300 file:rounded-lg file:px-3 file:py-2">
                @error('file')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-2">Cargar archivo PDF para recursos tipo PDF. Máx 10MB.</p>
            </div>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                <p class="text-sm text-yellow-800">⚠️ Los recursos requieren moderación antes de ser publicados.</p>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-red-800">Crear Recurso</button>
                <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection