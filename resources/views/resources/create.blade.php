@extends('layouts.app')

@section('title', 'Crear Recurso')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="glass border border-teal/30 rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gold mb-8">📤 Crear Nuevo Recurso</h1>
        
        <form action="{{ route('resources.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Title -->
            <div>
                <label class="block text-gray-300 mb-2 font-semibold">Título *</label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                    class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60 placeholder-gray-500"
                    placeholder="Título del recurso educativo">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description -->
            <div>
                <label class="block text-gray-300 mb-2 font-semibold">Descripción</label>
                <textarea name="description" rows="4" 
                    class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60 placeholder-gray-500"
                    placeholder="Describe el contenido del recurso">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Subject & Level -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Materia *</label>
                    <select name="subject" required 
                        class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60">
                        <option value="">Selecciona una materia</option>
                        <option value="Matematica" {{ old('subject') == 'Matematica' ? 'selected' : '' }}>Matemática</option>
                        <option value="Comunicacion" {{ old('subject') == 'Comunicacion' ? 'selected' : '' }}>Comunicación</option>
                        <option value="Ciencia" {{ old('subject') == 'Ciencia' ? 'selected' : '' }}>Ciencia</option>
                        <option value="Quechua" {{ old('subject') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Historia" {{ old('subject') == 'Historia' ? 'selected' : '' }}>Historia</option>
                    </select>
                    @error('subject')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Nivel *</label>
                    <select name="level" required 
                        class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60">
                        <option value="">Selecciona un nivel</option>
                        <option value="Primaria" {{ old('level') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                        <option value="Secundaria" {{ old('level') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                    </select>
                    @error('level')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Language & Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Idioma *</label>
                    <select name="lang" required 
                        class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60">
                        <option value="">Selecciona un idioma</option>
                        <option value="Castellano" {{ old('lang') == 'Castellano' ? 'selected' : '' }}>Castellano</option>
                        <option value="Quechua" {{ old('lang') == 'Quechua' ? 'selected' : '' }}>Quechua</option>
                        <option value="Bilingue" {{ old('lang') == 'Bilingue' ? 'selected' : '' }}>Bilingüe</option>
                    </select>
                    @error('lang')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-300 mb-2 font-semibold">Tipo de Contenido *</label>
                    <select name="type" required 
                        class="w-full bg-gray-700 border border-teal/30 text-white rounded-lg px-4 py-2 focus:outline-none focus:border-teal/60">
                        <option value="">Selecciona un tipo</option>
                        <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>🎥 Video</option>
                        <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>🎵 Audio</option>
                    </select>
                    @error('type')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- File Upload -->
            <div>
                <label class="block text-gray-300 mb-2 font-semibold">Archivo PDF</label>
                <input type="file" name="file" accept="application/pdf" 
                    class="w-full text-sm text-gray-500 file:bg-teal/20 file:text-teal file:border file:border-teal/30 file:rounded-lg file:px-4 file:py-2 hover:file:bg-teal/40 transition">
                @error('file')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-2">📋 Cargar archivo PDF. Máximo 10MB.</p>
            </div>
            
            <!-- Info Alert -->
            <div class="glass-light border border-gold/30 rounded-xl p-4 mb-2">
                <p class="text-sm text-gold font-semibold">⚠️ Moderación Requerida</p>
                <p class="text-sm text-gray-400 mt-1">Tu recurso se crea con estado "Pendiente". Un administrador lo revisará antes de publicarlo.</p>
            </div>
            
            <!-- Actions -->
            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary flex-1">Crear Recurso</button>
                <a href="{{ route('dashboard') }}" class="flex-1 text-center bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection