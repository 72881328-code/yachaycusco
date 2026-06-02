@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold text-primary text-center mb-6">Crear Cuenta</h1>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Nombres *</label>
                <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Apellidos</label>
                <input type="text" name="lastname" class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Correo Electrónico *</label>
                <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Contraseña *</label>
                <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Confirmar Contraseña *</label>
                <input type="password" name="password_confirmation" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Rol *</label>
                <select name="role" required class="w-full border rounded-lg px-3 py-2">
                    <option value="student">Estudiante</option>
                    <option value="teacher">Docente</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-red-800">Registrarse</button>
        </form>
        
        <p class="text-center text-gray-600 mt-4">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-primary hover:underline">Inicia sesión aquí</a>
        </p>
    </div>
</div>
@endsection