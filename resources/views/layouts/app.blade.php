<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YachayCusco - @yield('title', 'Educación Rural')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter & Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    
    <style>
        :root {
            --color-dark: #0A1828;
            --color-teal: #178582;
            --color-gold: #BFA181;
        }

        * {
            color-scheme: dark;
        }

        body { 
            font-family: 'Inter', sans-serif;
            background-color: var(--color-dark);
            color: #ffffff;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .bg-dark-primary { background-color: var(--color-dark); }
        .text-gold { color: var(--color-gold); }
        .bg-gold { background-color: var(--color-gold); }
        .text-teal { color: var(--color-teal); }
        .bg-teal { background-color: var(--color-teal); }
        .border-teal { border-color: var(--color-teal); }

        /* Glassmorphism */
        .glass {
            background: rgba(23, 133, 130, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(191, 161, 129, 0.2);
        }

        .glass-light {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Botones */
        .btn-primary {
            background-color: var(--color-teal);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(23, 133, 130, 0.3);
        }

        .btn-gold {
            background-color: var(--color-gold);
            color: var(--color-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(191, 161, 129, 0.3);
        }

        /* Animaciones suaves */
        .smooth-transition {
            transition: all 0.3s ease;
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--color-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--color-teal);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(191, 161, 129, 0.6);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-dark-primary text-white">
    <!-- Navbar - Sticky -->
    <nav class="sticky top-0 z-50 glass-light border-b border-teal/20 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">
                        <span class="text-gold">Yachay</span><span class="text-teal">Cusco</span>
                    </a>
                    <span class="text-xs text-gray-400">Conectando saberes</span>
                </div>
                
                <!-- Menu Principal -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-gold smooth-transition">Inicio</a>
                    <a href="{{ route('library.index') }}" class="text-gray-300 hover:text-gold smooth-transition">Biblioteca</a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-gold smooth-transition">Mi Panel</a>
                        
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gold font-semibold hover:text-gold/80 smooth-transition">⚙️ Admin</a>
                        @endif
                        
                        @if(Auth::user()->isTeacher())
                            <a href="{{ route('resources.create') }}" class="btn-primary text-sm">+ Recurso</a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-gold smooth-transition">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-gold smooth-transition">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm">Registrarse</a>
                    @endauth
                </div>

                <!-- Mobile Menu Toggle -->
                <div class="md:hidden">
                    <button onclick="toggleMobileMenu()" class="text-gold text-2xl">☰</button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-teal/20">
                <a href="{{ route('home') }}" class="block py-2 text-gray-300 hover:text-gold">Inicio</a>
                <a href="{{ route('library.index') }}" class="block py-2 text-gray-300 hover:text-gold">Biblioteca</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block py-2 text-gray-300 hover:text-gold">Mi Panel</a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gold font-semibold">⚙️ Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="pt-2">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-gray-300 hover:text-gold">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-gray-300 hover:text-gold">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="block py-2 text-gold">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="glass border border-teal/50 text-teal p-4 rounded-xl flex items-center gap-3 animate-fade-in">
                <span class="text-xl">✓</span>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="glass border border-red-500/50 text-red-300 p-4 rounded-xl">
                @foreach($errors->all() as $error)
                    <p class="flex items-center gap-2"><span>✗</span>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- Main Content -->
    <main class="min-h-screen py-12">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="glass border-t border-teal/20 mt-16 py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h3 class="text-gold font-bold mb-4">YachayCusco</h3>
                    <p class="text-gray-400 text-sm">Conectando saberes ancestrales con educación moderna para comunidades rurales del Cusco.</p>
                </div>
                <div>
                    <h4 class="text-gold font-semibold mb-4">Enlaces Rápidos</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-teal smooth-transition">Inicio</a></li>
                        <li><a href="{{ route('library.index') }}" class="hover:text-teal smooth-transition">Biblioteca</a></li>
                        <li><a href="{{ route('dashboard') }}" class="hover:text-teal smooth-transition">Dashboard</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gold font-semibold mb-4">Contacto</h4>
                    <p class="text-gray-400 text-sm">Cusco - Perú</p>
                    <p class="text-gray-400 text-sm">Educación para el Desarrollo Rural</p>
                </div>
            </div>
            <div class="border-t border-teal/20 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2026 YachayCusco. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // CSRF Token setup for AJAX
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

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