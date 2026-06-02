<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YachayCusco - @yield('title', 'Educación Rural')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #83000F; }
        .text-primary { color: #83000F; }
        .border-primary { border-color: #83000F; }
        .bg-secondary { background-color: #FCC432; }
        .text-secondary { color: #785A00; }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg border-b-4 border-primary">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-primary">
                        YachayCusco
                    </a>
                    <span class="ml-2 text-xs text-gray-500">Conectando saberes</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary">Inicio</a>
                    <a href="{{ route('library.index') }}" class="text-gray-700 hover:text-primary">Biblioteca</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary">Mi Panel</a>
                        @if(Auth::user()->isTeacher())
                            <a href="{{ route('resources.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-red-800">+ Crear Recurso</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-primary">Cerrar Sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-red-800">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- Main Content -->
    <main class="py-8">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>YachayCusco - Educación para el Desarrollo Rural</p>
            <p class="text-sm text-gray-400 mt-2">Cusco - Perú</p>
        </div>
    </footer>
    
    <script>
        // CSRF Token setup for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        // Offline download function
        function saveForOffline(resourceId, title) {
            fetch(`/resources/${resourceId}/download`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            }).catch(() => {});
            
            const saved = JSON.parse(localStorage.getItem('yachay_offline') || '[]');
            if (!saved.includes(title)) {
                saved.push(title);
                localStorage.setItem('yachay_offline', JSON.stringify(saved));
                alert('Guardado para modo offline');
            }
        }
    </script>
    
    @stack('scripts')
</body>
</html>