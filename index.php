<?php
// ============================================
// INICIO DE SESIÓN - DEBE IR PRIMERO
// ============================================
session_start();

// ============================================
// DATOS SIMULADOS (SIN BASE DE DATOS)
// ============================================

// Recursos educativos simulados
$recursos = [
    1 => [
        'id' => 1,
        'titulo_es' => 'Matemáticas - Números y operaciones',
        'titulo_qu' => 'Yupay Yachay - Yupaykuna',
        'descripcion_es' => 'Guía completa de matemáticas para primaria con ejercicios prácticos y ejemplos resueltos.',
        'descripcion_qu' => 'Primaria yachaykuqkunapaq yupay yachay guía, ruwaykuna ejemplokuna.',
        'nivel' => 'Primaria',
        'area' => 'Matemáticas',
        'descargas' => 245,
        'idioma' => 'Español',
        'icono' => '📐'
    ],
    2 => [
        'id' => 2,
        'titulo_es' => 'Comunicación - Lectura y escritura',
        'titulo_qu' => 'Willakuy - Ñawinchay qillqay',
        'descripcion_es' => 'Material didáctico para mejorar la comprensión lectora y producción de textos.',
        'descripcion_qu' => 'Ñawinchayta allinyachiyta yachanapaq material, qillqayta ruwanapaq.',
        'nivel' => 'Primaria',
        'area' => 'Comunicación',
        'descargas' => 189,
        'idioma' => 'Ambos',
        'icono' => '📖'
    ],
    3 => [
        'id' => 3,
        'titulo_es' => 'Ciencias - El cuerpo humano',
        'titulo_qu' => 'Yachaykuna - Runap kurkun',
        'descripcion_es' => 'Explora los sistemas del cuerpo humano de forma interactiva con imágenes y actividades.',
        'descripcion_qu' => 'Runap kurkun sistemankunata yachay, imágenkuna ruwaykunawan.',
        'nivel' => 'Secundaria',
        'area' => 'Ciencias',
        'descargas' => 312,
        'idioma' => 'Quechua',
        'icono' => '🧬'
    ],
    4 => [
        'id' => 4,
        'titulo_es' => 'EIB - Cultura quechua',
        'titulo_qu' => 'EIB - Runasimi kawsay',
        'descripcion_es' => 'Recursos para la educación intercultural y bilingüe, tradiciones andinas.',
        'descripcion_qu' => 'Iskay simipi yachakuypaq yachaykuna, andes kawsaymanta.',
        'nivel' => 'Primaria',
        'area' => 'EIB',
        'descargas' => 156,
        'idioma' => 'Quechua',
        'icono' => '🪶'
    ],
    5 => [
        'id' => 5,
        'titulo_es' => 'Matemáticas - Geometría',
        'titulo_qu' => 'Yupay Yachay - Pacha kimsakuy',
        'descripcion_es' => 'Aprende figuras geométricas, áreas y perímetros con ejercicios prácticos.',
        'descripcion_qu' => 'Pacha kimsakuykunata, áreas perímetrosta yachay ruwaykunawan.',
        'nivel' => 'Secundaria',
        'area' => 'Matemáticas',
        'descargas' => 278,
        'idioma' => 'Español',
        'icono' => '📐'
    ],
    6 => [
        'id' => 6,
        'titulo_es' => 'Comunicación - Quechua básico',
        'titulo_qu' => 'Willakuy - Runasimi yachay',
        'descripcion_es' => 'Vocabulario básico, frases útiles y pronunciación en quechua sureño.',
        'descripcion_qu' => 'Runasimipi rimanapaq yachaykuna, qillqayta ruwanapaq.',
        'nivel' => 'Primaria',
        'area' => 'Comunicación',
        'descargas' => 203,
        'idioma' => 'Quechua',
        'icono' => '🗣️'
    ],
    7 => [
        'id' => 7,
        'titulo_es' => 'Ciencias - Medio ambiente',
        'titulo_qu' => 'Yachaykuna - Pachamama',
        'descripcion_es' => 'Cuidado del ambiente, reciclaje y recursos naturales de nuestra región.',
        'descripcion_qu' => 'Pachamamata allinta qhawarimanta, reciclaje, llaqtaykuq recursos.',
        'nivel' => 'Secundaria',
        'area' => 'Ciencias',
        'descargas' => 167,
        'idioma' => 'Ambos',
        'icono' => '🌿'
    ],
    8 => [
        'id' => 8,
        'titulo_es' => 'EIB - Tradiciones andinas',
        'titulo_qu' => 'EIB - Andeskuna kawsaynin',
        'descripcion_es' => 'Costumbres, festividades y saberes ancestrales de los pueblos andinos.',
        'descripcion_qu' => 'Andes llaqtakunapa kawsaynin, fiestakuna, yachaykuna.',
        'nivel' => 'Secundaria',
        'area' => 'EIB',
        'descargas' => 134,
        'idioma' => 'Quechua',
        'icono' => '🏔️'
    ]
];

// Usuarios simulados (docentes)
$usuarios = [
    'carlos.mamani@yachaycusco.pe' => [
        'nombre' => 'Carlos Mamani',
        'password' => 'docente123',
        'rol' => 'docente',
        'escuela' => 'IE San Jerónimo'
    ],
    'maria.quispe@yachaycusco.pe' => [
        'nombre' => 'María Quispe',
        'password' => 'docente456',
        'rol' => 'docente',
        'escuela' => 'IE Chillihuani'
    ]
];

// Función para traducir textos
$textos = [
    'es' => [
        'logo_subtitle' => 'Recursos Educativos Abiertos',
        'hero_title' => '🎓 Bienvenido a YachayCusco',
        'hero_subtitle' => 'Recursos educativos gratuitos para estudiantes de San Jerónimo, Cusco',
        'stat_recursos' => 'Recursos disponibles',
        'stat_escuelas' => 'Instituciones educativas',
        'stat_estudiantes' => 'Estudiantes beneficiados',
        'filter_nivel' => 'Nivel educativo',
        'filter_area' => 'Área curricular',
        'footer_text' => '© 2026 YachayCusco - Educación sin fronteras, conocimiento sin conexión',
        'footer_license' => 'Licencia MIT - Código abierto',
        'modal_title' => '📤 Subir nuevo recurso',
        'modal_title_login' => '🔐 Iniciar Sesión',
        'no_results' => 'No se encontraron recursos. ¡Sé el primero en subir uno!',
        'login_title' => 'Iniciar Sesión (Docentes)',
        'email_label' => 'Correo electrónico',
        'password_label' => 'Contraseña',
        'login_btn' => 'Ingresar',
        'upload_title' => 'Título del recurso',
        'description_label' => 'Descripción',
        'level_label' => 'Nivel',
        'area_label' => 'Área',
        'language_label' => 'Idioma',
        'submit_btn' => 'Subir recurso',
        'cancel_btn' => 'Cancelar',
        'welcome' => 'Bienvenido',
        'logout' => 'Cerrar sesión'
    ],
    'qu' => [
        'logo_subtitle' => 'Yachay Qullqikuna',
        'hero_title' => '🎓 YachayCuscoman allin hamunkuy',
        'hero_subtitle' => 'San Jerónimo, Cuscomanta yachakuqkunapaq yachaykuna',
        'stat_recursos' => 'Yachaykuna',
        'stat_escuelas' => 'Yachay wasikuna',
        'stat_estudiantes' => 'Yachakuqkuna',
        'filter_nivel' => 'Yachay pata',
        'filter_area' => 'Yachay wasi',
        'footer_text' => '© 2026 YachayCusco - Yachayniyuq kay, internetniyuq kay',
        'footer_license' => 'MIT Licencia - Kichasqa qillqa',
        'modal_title' => '📤 Musuq yachayta churay',
        'modal_title_login' => '🔐 Yaykuy',
        'no_results' => 'Mana yachaykuna tarikunchu. ¡Qamray ñawpaqta churay!',
        'login_title' => 'Yaykuy (Yachachiqkuna)',
        'email_label' => 'Correo electrónico',
        'password_label' => 'Pakasqa simi',
        'login_btn' => 'Yaykuy',
        'upload_title' => 'Yachaypa sutin',
        'description_label' => 'Willakuy',
        'level_label' => 'Yachay pata',
        'area_label' => 'Yachay wasi',
        'language_label' => 'Simi',
        'submit_btn' => 'Yachayta churay',
        'cancel_btn' => 'Kichay',
        'welcome' => 'Allin hamunkuy',
        'logout' => 'Lluqsiy'
    ]
];

// ============================================
// PROCESAR FORMULARIOS
// ============================================

$usuario_actual = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$error_login = null;
$upload_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (isset($usuarios[$email]) && $usuarios[$email]['password'] === $password) {
            $_SESSION['user'] = [
                'nombre' => $usuarios[$email]['nombre'],
                'email' => $email,
                'rol' => $usuarios[$email]['rol'],
                'escuela' => $usuarios[$email]['escuela']
            ];
            $usuario_actual = $_SESSION['user'];
            $lang_redirect = isset($_GET['lang']) ? $_GET['lang'] : 'es';
            header("Location: ?lang=" . $lang_redirect);
            exit();
        } else {
            $error_login = "Email o contraseña incorrectos";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'logout') {
        session_destroy();
        $lang_redirect = isset($_GET['lang']) ? $_GET['lang'] : 'es';
        header("Location: ?lang=" . $lang_redirect);
        exit();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'upload' && $usuario_actual) {
        $nuevo_id = count($recursos) + 1;
        $recursos[$nuevo_id] = [
            'id' => $nuevo_id,
            'titulo_es' => $_POST['titulo_es'] ?? '',
            'titulo_qu' => $_POST['titulo_qu'] ?? ($_POST['titulo_es'] . ' (Quechua)'),
            'descripcion_es' => $_POST['descripcion_es'] ?? '',
            'descripcion_qu' => $_POST['descripcion_qu'] ?? ($_POST['descripcion_es'] . ' (Quechua simipi)'),
            'nivel' => $_POST['nivel'] ?? 'Primaria',
            'area' => $_POST['area'] ?? 'Comunicación',
            'descargas' => 0,
            'idioma' => $_POST['idioma'] ?? 'Español',
            'icono' => '📚'
        ];
        $_SESSION['recursos'] = $recursos;
        $upload_success = true;
        $lang_redirect = isset($_GET['lang']) ? $_GET['lang'] : 'es';
        header("Location: ?lang=" . $lang_redirect . "&upload_success=1");
        exit();
    }
}

// Recuperar recursos de sesión si existen
if (isset($_SESSION['recursos'])) {
    $recursos = $_SESSION['recursos'];
}

// Obtener idioma
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'es');
setcookie('lang', $lang, time() + 86400 * 30, '/');

// Aplicar filtros
$nivel_filter = isset($_GET['nivel']) ? $_GET['nivel'] : 'todos';
$area_filter = isset($_GET['area']) ? $_GET['area'] : 'todas';
$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';

$recursos_filtrados = [];
foreach ($recursos as $recurso) {
    $titulo = $lang === 'es' ? strtolower($recurso['titulo_es']) : strtolower($recurso['titulo_qu']);
    $descripcion = $lang === 'es' ? strtolower($recurso['descripcion_es']) : strtolower($recurso['descripcion_qu']);
    
    $match_search = empty($search) || strpos($titulo, $search) !== false || strpos($descripcion, $search) !== false;
    $match_nivel = $nivel_filter === 'todos' || $recurso['nivel'] === $nivel_filter;
    $match_area = $area_filter === 'todas' || $recurso['area'] === $area_filter;
    
    if ($match_search && $match_nivel && $match_area) {
        $recursos_filtrados[] = $recurso;
    }
}

$total_recursos = count($recursos);
$mostrar_success = isset($_GET['upload_success']) && $_GET['upload_success'] == 1;
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>YachayCusco - Recursos Educativos Abiertos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8edf2 100%);
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #1a472a, #2d6a4f);
            color: white;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo h1 {
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .logo p {
            font-size: 0.8rem;
            opacity: 0.9;
        }

        .lang-selector {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .lang-btn {
            background: rgba(255,255,255,0.2);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .lang-btn:hover, .lang-btn.active {
            background: #ffd166;
            color: #1a472a;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: bold;
        }

        .btn-logout {
            background: rgba(255,255,255,0.2);
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            color: white;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #ff6b6b;
        }

        .hero {
            background: linear-gradient(135deg, #2d6a4f, #1b4332);
            color: white;
            text-align: center;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
        }

        .hero h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .filters-section {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .search-box {
            margin-bottom: 1rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: #2d6a4f;
        }

        .filters {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 150px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 0.3rem;
            font-weight: 600;
            color: #333;
        }

        .filter-group select {
            width: 100%;
            padding: 0.6rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            cursor: pointer;
        }

        .resources-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .resource-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #2d6a4f, #1b4332);
            color: white;
            padding: 1rem;
        }

        .card-header h3 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .card-badges {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(255,255,255,0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            font-size: 0.7rem;
        }

        .card-body {
            padding: 1rem;
        }

        .card-body p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 1rem;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 1rem;
            background: #f8f9fa;
            border-top: 1px solid #eee;
        }

        .download-count {
            color: #2d6a4f;
            font-weight: bold;
        }

        .btn-download {
            background: #2d6a4f;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-download:hover {
            background: #1b4332;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 500px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
        }

        .modal-content h3 {
            margin-bottom: 1rem;
            color: #1a472a;
        }

        .modal-content input,
        .modal-content textarea,
        .modal-content select {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: inherit;
            box-sizing: border-box;
        }

        .btn-submit {
            background: #2d6a4f;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .btn-close {
            background: #ccc;
            margin-top: 0.5rem;
        }

        .btn-close:hover {
            background: #aaa;
        }

        .fab {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: #2d6a4f;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s;
            z-index: 90;
            font-size: 30px;
            font-weight: bold;
        }

        .fab:hover {
            transform: scale(1.1);
        }

        .footer {
            background: #1a472a;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            color: #666;
        }

        .toast {
            position: fixed;
            bottom: 100px;
            right: 20px;
            background: #2d6a4f;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            z-index: 1000;
            animation: fadeInOut 3s ease-in-out;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(20px); }
            15% { opacity: 1; transform: translateY(0); }
            85% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 0.8rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }

        @media (max-width: 768px) {
            .hero h2 { font-size: 1.8rem; }
            .stats { gap: 1.5rem; }
            .resources-grid { grid-template-columns: 1fr; }
            .header-content { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<?php if ($mostrar_success): ?>
<script>
    function showToast() {
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.innerHTML = '✅ <?php echo $lang === "es" ? "Recurso subido correctamente" : "Yachayqa allichu churarikun"; ?>';
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
    window.addEventListener('DOMContentLoaded', showToast);
</script>
<?php endif; ?>

<!-- Header -->
<header class="header">
    <div class="header-content">
        <div class="logo">
            <h1>📚 YachayCusco</h1>
            <p><?php echo $textos[$lang]['logo_subtitle']; ?></p>
        </div>
        <div class="lang-selector">
            <a href="?lang=es&nivel=<?php echo urlencode($nivel_filter); ?>&area=<?php echo urlencode($area_filter); ?>&search=<?php echo urlencode($search); ?>" 
               class="lang-btn <?php echo $lang === 'es' ? 'active' : ''; ?>">🇪🇸 Español</a>
            <a href="?lang=qu&nivel=<?php echo urlencode($nivel_filter); ?>&area=<?php echo urlencode($area_filter); ?>&search=<?php echo urlencode($search); ?>" 
               class="lang-btn <?php echo $lang === 'qu' ? 'active' : ''; ?>">🇵🇪 Quechua</a>
            
            <?php if ($usuario_actual): ?>
                <div class="user-info">
                    <span class="user-name">👨‍🏫 <?php echo htmlspecialchars($usuario_actual['nombre']); ?></span>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="btn-logout"><?php echo $textos[$lang]['logout']; ?></button>
                    </form>
                </div>
            <?php else: ?>
                <button class="lang-btn" onclick="openLoginModal()">🔐 <?php echo $textos[$lang]['login_title']; ?></button>
            <?php endif; ?>
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero">
    <h2><?php echo $textos[$lang]['hero_title']; ?></h2>
    <p><?php echo $textos[$lang]['hero_subtitle']; ?></p>
    <div class="stats">
        <div class="stat">
            <div class="stat-number"><?php echo $total_recursos; ?></div>
            <div class="stat-label"><?php echo $textos[$lang]['stat_recursos']; ?></div>
        </div>
        <div class="stat">
            <div class="stat-number">3</div>
            <div class="stat-label"><?php echo $textos[$lang]['stat_escuelas']; ?></div>
        </div>
        <div class="stat">
            <div class="stat-number">500+</div>
            <div class="stat-label"><?php echo $textos[$lang]['stat_estudiantes']; ?></div>
        </div>
    </div>
</section>

<!-- Contenido principal -->
<div class="container">
    <!-- Sección de filtros -->
    <div class="filters-section">
        <form method="GET" id="filter-form">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>">
            <div class="search-box">
                <input type="text" name="search" id="search-input" 
                       placeholder="<?php echo $lang === 'es' ? '🔍 Buscar recursos...' : '🔍 Maskay yachaykuna...'; ?>"
                       value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="filters">
                <div class="filter-group">
                    <label><?php echo $textos[$lang]['filter_nivel']; ?></label>
                    <select name="nivel" id="nivel-filter">
                        <option value="todos" <?php echo $nivel_filter === 'todos' ? 'selected' : ''; ?>><?php echo $lang === 'es' ? 'Todos los niveles' : 'Tukuypi'; ?></option>
                        <option value="Primaria" <?php echo $nivel_filter === 'Primaria' ? 'selected' : ''; ?>>Primaria</option>
                        <option value="Secundaria" <?php echo $nivel_filter === 'Secundaria' ? 'selected' : ''; ?>>Secundaria</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><?php echo $textos[$lang]['filter_area']; ?></label>
                    <select name="area" id="area-filter">
                        <option value="todas" <?php echo $area_filter === 'todas' ? 'selected' : ''; ?>><?php echo $lang === 'es' ? 'Todas las áreas' : 'Tukuypi'; ?></option>
                        <option value="Matemáticas" <?php echo $area_filter === 'Matemáticas' ? 'selected' : ''; ?>>Matemáticas</option>
                        <option value="Comunicación" <?php echo $area_filter === 'Comunicación' ? 'selected' : ''; ?>>Comunicación</option>
                        <option value="Ciencias" <?php echo $area_filter === 'Ciencias' ? 'selected' : ''; ?>>Ciencias</option>
                        <option value="EIB" <?php echo $area_filter === 'EIB' ? 'selected' : ''; ?>>EIB</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <!-- Grid de recursos -->
    <div class="resources-grid">
        <?php if (empty($recursos_filtrados)): ?>
            <div class="no-results"><?php echo $textos[$lang]['no_results']; ?></div>
        <?php else: ?>
            <?php foreach ($recursos_filtrados as $recurso): ?>
                <div class="resource-card">
                    <div class="card-header">
                        <h3><?php echo $recurso['icono']; ?> <?php echo $lang === 'es' ? htmlspecialchars($recurso['titulo_es']) : htmlspecialchars($recurso['titulo_qu']); ?></h3>
                        <div class="card-badges">
                            <span class="badge">📚 <?php echo $recurso['nivel']; ?></span>
                            <span class="badge">📖 <?php echo $recurso['area']; ?></span>
                            <span class="badge">🌐 <?php echo $recurso['idioma']; ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><?php echo $lang === 'es' ? htmlspecialchars(substr($recurso['descripcion_es'], 0, 120)) . '...' : htmlspecialchars(substr($recurso['descripcion_qu'], 0, 120)) . '...'; ?></p>
                    </div>
                    <div class="card-footer">
                        <span class="download-count">⬇️ <?php echo $recurso['descargas']; ?> <?php echo $lang === 'es' ? 'descargas' : 'churarikuynin'; ?></span>
                        <button type="button" class="btn-download" onclick="descargarRecurso(<?php echo $recurso['id']; ?>, '<?php echo $lang; ?>')">
                            📥 <?php echo $lang === 'es' ? 'Descargar PDF' : 'Churaricuy'; ?>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Botón flotante para docente -->
<?php if ($usuario_actual && $usuario_actual['rol'] === 'docente'): ?>
    <div class="fab" id="fabBtn">+</div>
<?php endif; ?>

<!-- Modal para subir recurso -->
<div id="uploadModal" class="modal">
    <div class="modal-content">
        <h3><?php echo $textos[$lang]['modal_title']; ?></h3>
        <form method="POST" id="upload-form">
            <input type="hidden" name="action" value="upload">
            <input type="text" name="titulo_es" id="recurso-titulo" placeholder="<?php echo $textos[$lang]['upload_title']; ?>" required>
            <textarea name="descripcion_es" id="recurso-descripcion" rows="3" placeholder="<?php echo $textos[$lang]['description_label']; ?>" required></textarea>
            <select name="nivel" id="recurso-nivel" required>
                <option value="Primaria">Primaria</option>
                <option value="Secundaria">Secundaria</option>
            </select>
            <select name="area" id="recurso-area" required>
                <option value="Matemáticas">Matemáticas</option>
                <option value="Comunicación">Comunicación</option>
                <option value="Ciencias">Ciencias</option>
                <option value="EIB">Educación Intercultural Bilingüe</option>
            </select>
            <select name="idioma" id="recurso-idioma" required>
                <option value="Español">Español</option>
                <option value="Quechua">Quechua</option>
                <option value="Ambos">Ambos idiomas</option>
            </select>
            <button type="submit" class="btn-submit">📤 <?php echo $textos[$lang]['submit_btn']; ?></button>
            <button type="button" class="btn-submit btn-close" id="closeModal">❌ <?php echo $textos[$lang]['cancel_btn']; ?></button>
        </form>
    </div>
</div>

<!-- Modal para login -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <h3><?php echo $textos[$lang]['modal_title_login']; ?></h3>
        <?php if ($error_login): ?>
            <div class="error-message"><?php echo $error_login; ?></div>
        <?php endif; ?>
        <form method="POST" class="login-form">
            <input type="hidden" name="action" value="login">
            <input type="email" name="email" placeholder="<?php echo $textos[$lang]['email_label']; ?>" required>
            <input type="password" name="password" placeholder="<?php echo $textos[$lang]['password_label']; ?>" required>
            <button type="submit" class="btn-submit">🔐 <?php echo $textos[$lang]['login_btn']; ?></button>
            <button type="button" class="btn-submit btn-close" onclick="closeLoginModal()">❌ <?php echo $textos[$lang]['cancel_btn']; ?></button>
        </form>
        <p style="margin-top: 1rem; font-size: 0.8rem; text-align: center; color: #666;">
            <?php echo $lang === 'es' ? 'Docentes de prueba: carlos.mamani@yachaycusco.pe / docente123' : 'Prueba yachachiq: carlos.mamani@yachaycusco.pe / docente123'; ?>
        </p>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p><?php echo $textos[$lang]['footer_text']; ?></p>
    <p style="margin-top: 0.5rem; font-size: 0.8rem;"><?php echo $textos[$lang]['footer_license']; ?></p>
</footer>

<script>
    // Datos de recursos
    const recursos = <?php echo json_encode($recursos); ?>;
    
    function descargarRecurso(id, lang) {
        const recurso = recursos[id];
        if(recurso) {
            const mensaje = lang === 'es' 
                ? `✅ Descargando: ${recurso.titulo_es}\n\nEl archivo se ha descargado correctamente.`
                : `✅ Churaricuy: ${recurso.titulo_qu}\n\nYachayqa allichu churarikusqa.`;
            alert(mensaje);
            
            // Simular descarga
            const link = document.createElement('a');
            link.href = '#';
            link.download = `recurso_${id}.pdf`;
            link.click();
        }
    }
    
    // Auto-submit filtros
    const nivelFilter = document.getElementById('nivel-filter');
    const areaFilter = document.getElementById('area-filter');
    const searchInput = document.getElementById('search-input');
    const filterForm = document.getElementById('filter-form');
    
    if(nivelFilter) {
        nivelFilter.addEventListener('change', () => filterForm.submit());
    }
    if(areaFilter) {
        areaFilter.addEventListener('change', () => filterForm.submit());
    }
    
    let searchTimeout;
    if(searchInput) {
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => filterForm.submit(), 500);
        });
    }
    
    // Modal functions
    function openLoginModal() {
        document.getElementById('loginModal').classList.add('active');
    }
    
    function closeLoginModal() {
        document.getElementById('loginModal').classList.remove('active');
    }
    
    <?php if ($usuario_actual && $usuario_actual['rol'] === 'docente'): ?>
    const fabBtn = document.getElementById('fabBtn');
    const uploadModal = document.getElementById('uploadModal');
    const closeModal = document.getElementById('closeModal');
    
    if(fabBtn) {
        fabBtn.addEventListener('click', () => {
            uploadModal.classList.add('active');
        });
    }
    
    if(closeModal) {
        closeModal.addEventListener('click', () => {
            uploadModal.classList.remove('active');
        });
    }
    
    window.addEventListener('click', (e) => {
        if(e.target === uploadModal) {
            uploadModal.classList.remove('active');
        }
        if(e.target === document.getElementById('loginModal')) {
            document.getElementById('loginModal').classList.remove('active');
        }
    });
    <?php endif; ?>
    
    // Cerrar login modal con click fuera
    window.addEventListener('click', (e) => {
        const loginModal = document.getElementById('loginModal');
        if(e.target === loginModal) {
            loginModal.classList.remove('active');
        }
    });
</script>

</body>
</html>