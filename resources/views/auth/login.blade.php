@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto px-4">
    <div class="bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold text-primary text-center mb-6">Iniciar Sesión</h1>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2">
            </div>
            
            <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-red-800">Ingresar</button>
        </form>
        
        <p class="text-center text-gray-600 mt-4">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="text-primary hover:underline">Regístrate aquí</a>
        </p>
        
        <div class="mt-6 pt-4 border-t text-center text-sm text-gray-500">
            <p>Credenciales de prueba:</p>
            <p>Docente: rosa@yachay.pe / password</p>
            <p>Estudiante: estudiante@yachay.pe / password</p>
        </div>
    </div>
</div>
@endsection