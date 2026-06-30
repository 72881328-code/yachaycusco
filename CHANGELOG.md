# 🎨 YachayCusco - Modernización de Interfaz y Sistema de Aprobación

## ✅ Cambios Implementados

### 1. **Rediseño Completo de UI/UX** 
Se ha implementado una modernización visual completa de la plataforma con:

#### Paleta de Colores Nueva:
- **Azul Oscuro (#0A1828)**: Fondo principal y fondos secundarios
- **Turquesa (#178582)**: Botones primarios, enlaces y acentos interactivos
- **Dorado (#BFA181)**: Títulos destacados, insignias y elementos premium

#### Diseño Glassmorphism:
- Tarjetas con efecto de vidrio transparente (blur)
- Bordes sutiles en turquesa
- Transiciones suaves y animaciones

#### Tipografía Moderna:
- **Inter**: Font principal para el cuerpo del texto
- **Poppins**: Font para títulos y headings
- Pesos adecuados (300-700) para jerarquía visual

#### Componentes Mejorados:
- Navegación **sticky** (fija) con transparencia
- Botones redondeados con animaciones suaves
- Modo oscuro por defecto para reducir fatiga visual
- Efectos hover y transiciones suaves en todos los elementos

### 2. **Sistema de Roles y Aprobación de Contenido**

#### Nuevos Roles:
- **Admin**: Acceso completo al panel de administración
- **Teacher/Docente**: Puede crear y editar recursos (existente)
- **Student/Estudiante**: Acceso a recursos aprobados (existente)

#### Flujo de Aprobación:
1. Los profesores suben materiales → Estado: **"Pendiente"**
2. Admin ve dashboard con recursos pendientes
3. Admin puede: **Aprobar** (→ Publicado) o **Rechazar** (→ Rechazado)
4. Estudiantes solo ven recursos en estado **"Publicado"**

#### Nuevas Vistas:
- **Dashboard Admin** (`/admin/dashboard`): Resumen y recursos pendientes
- **Gestor de Recursos** (`/admin/resources`): Listado completo con filtros
- Modales para aprobar/rechazar con razón de rechazo

---

## 🚀 Cómo Usar la Plataforma

### Crear Usuario Admin

Ejecuta el siguiente comando en la terminal:

```bash
php artisan db:seed --class=CreateAdminSeeder
```

**Credenciales de prueba:**
- Email: `admin@yachay.dev`
- Contraseña: `admin123`
- Rol: `admin`

O crea un admin personalizado:

```bash
php artisan app:create-admin-user
```

### Acceso a Paneles

**Panel de Admin:**
- URL: `/admin/dashboard`
- Accesible solo para usuarios con rol `admin`
- Muestra estadísticas y recursos pendientes

**Panel de Docente:**
- URL: `/dashboard` (si eres profesor)
- Visualiza tus recursos, estadísticas y estado de aprobación

**Panel de Estudiante:**
- URL: `/dashboard` (si eres estudiante)
- Visualiza recursos guardados y destacados

### Flujo de Subida de Recursos (Profesor)

1. Inicia sesión como profesor
2. Haz clic en "+ Nuevo Recurso" en la navbar
3. Completa el formulario:
   - Título
   - Descripción
   - Materia (Matemática, Comunicación, Ciencia, Quechua, Historia)
   - Nivel (Primaria, Secundaria)
   - Idioma (Castellano, Quechua, Bilingüe)
   - Tipo (PDF, Video, Audio)
   - Archivo (si es PDF)
4. El recurso se crea con estado **"Pendiente"**
5. El admin lo revisa y aprueba o rechaza

### Flujo de Aprobación (Admin)

1. Accede a `/admin/dashboard`
2. Visualiza todos los recursos en estado "Pendiente"
3. Para cada recurso:
   - ✓ **Aprobar**: El recurso pasa a "Publicado" y estudiantes lo ven
   - ✗ **Rechazar**: Puedes incluir un motivo (opcional)
4. En `/admin/resources` puedes filtrar por estado y materia

---

## 📁 Cambios en Archivos

### Backend
- `app/Models/User.php`: Agregado método `isAdmin()`
- `app/Models/Resource.php`: Agregado campo `rejection_reason` al fillable
- `app/Http/Controllers/AdminController.php`: **NUEVO** - Gestión de aprobación
- `app/Http/Controllers/DashboardController.php`: Redirección de admin
- `app/Console/Commands/CreateAdminUser.php`: **NUEVO** - Comando para crear admin
- `database/seeders/CreateAdminSeeder.php`: **NUEVO** - Seeder para admin
- `routes/web.php`: Rutas admin agregadas

### Migraciones
- `2026_06_30_121434_update_users_table_add_admin_role.php`: Agrega rol 'admin'
- `2026_06_30_121522_add_rejection_reason_to_resources_table.php`: Campo rejection_reason

### Frontend
- `resources/views/layouts/app.blade.php`: **Rediseño completo** con glassmorphism
- `resources/views/home/index.blade.php`: **Rediseño** con nueva paleta
- `resources/views/library/index.blade.php`: **Rediseño** con glassmorphism
- `resources/views/library/show.blade.php`: **Rediseño** con nueva paleta
- `resources/views/dashboard/teacher.blade.php`: **Rediseño** con glassmorphism
- `resources/views/dashboard/student.blade.php`: **Rediseño** con glassmorphism
- `resources/views/admin/dashboard.blade.php`: **NUEVO** - Dashboard admin
- `resources/views/admin/resources.blade.php`: **NUEVO** - Gestor de recursos

---

## 🎯 Características del Nuevo Diseño

### Navbar Sticky
- Fija en la parte superior
- Transparencia con efecto blur
- Logo con colores diferenciados (Dorado + Turquesa)
- Enlace especial para admin (⚙️ Admin)
- Menú responsive para móviles

### Tarjetas Glassmorphism
- Fondo semi-transparente
- Efecto blur de 10px
- Bordes turquesa sutiles (20% opacity)
- Hover suave que aumenta opacidad
- Transiciones de 0.3s

### Botones
- **Primarios**: Turquesa con hover elevado
- **Secundarios/Gold**: Dorado con sombra suave
- Redondeados (border-radius: 0.75rem)
- Animaciones: hover traduce -2px hacia arriba

### Colores Tailwind Personalizados
```css
--color-dark: #0A1828 (Azul oscuro)
--color-teal: #178582 (Turquesa)
--color-gold: #BFA181 (Dorado)
```

### Estados de Recursos
- **Pendiente** (⏳): Amarillo
- **Aprobado** (✓): Turquesa
- **Rechazado** (✗): Rojo

---

## 🔒 Seguridad

- Solo admins pueden acceder a `/admin/*`
- Middleware de autenticación en rutas protegidas
- Validación de permisos en controladores
- Protección CSRF en formularios

---

## 📝 Base de Datos

### Cambios en `users` table
- Campo `role`: enum('student', 'teacher', 'admin') default 'student'

### Cambios en `resources` table
- Campo `rejection_reason`: text, nullable - Motivo del rechazo
- Campo `status`: enum('pending', 'approved', 'rejected') default 'pending'

---

## 🎓 Próximas Mejoras Sugeridas

1. Notificaciones por email cuando un recurso es aprobado/rechazado
2. Edición de recursos por parte del admin
3. Búsqueda avanzada en biblioteca
4. Análisis de estadísticas más detallado
5. Sistema de comentarios en recursos
6. Categorías y etiquetas adicionales

---

## 📞 Soporte

Para más información, contacta al equipo de desarrollo de YachayCusco.

**Versión**: 2.0 (Modernización UI + Sistema de Aprobación)
**Fecha**: 30 de Junio de 2026
