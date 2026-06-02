@extends('layouts.app')

@section('title', 'Crear Recurso')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold text-primary mb-6">📤 Crear Nuevo Recurso</h1>
        
        <form action="{{ route('resources.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Título *</label>
                <input type="text" name="title" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Descripción</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Materia *</label>
                    <select name="subject" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Matematica">Matemática</option>
                        <option value="Comunicacion">Comunicación</option>
                        <option value="Ciencia">Ciencia</option>
                        <option value="Quechua">Quechua</option>
                        <option value="Historia">Historia</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Nivel *</label>
                    <select name="level" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                    </select>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Idioma *</label>
                    <select name="lang" required class="w-full border rounded-lg px-3 py-2">
                        <option value="Castellano">Castellano</option>
                        <option value="Quechua">Quechua</option>
                        <option value="Bilingue">Bilingüe</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Tipo *</label>
                    <select name="type" required class="w-full border rounded-lg px-3 py-2">
                        <option value="pdf">PDF</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                    </select>
                </div>
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