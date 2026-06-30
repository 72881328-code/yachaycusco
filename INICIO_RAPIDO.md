# 🎯 INICIO RÁPIDO - YachayCusco Modernizado

## ⚡ Pasos Inmediatos

### 1️⃣ Prepara la Base de Datos
```bash
cd c:\xampp\htdocs\yachaycusco
php artisan migrate --fresh --seed
php artisan db:seed --class=CreateAdminSeeder
```

### 2️⃣ Inicia la Aplicación
```bash
php artisan serve
# O accede a: http://localhost/yachaycusco
```

### 3️⃣ Credenciales de Admin (Para Pruebas)
```
Email:    admin@yachay.dev
Password: admin123
Rol:      admin
```

---

## 🚀 Rutas Principales

| Ruta | Descripción |
|------|-------------|
| `/` | Home modernizado |
| `/biblioteca` | Biblioteca con filtros |
| `/login` | Página de login |
| `/register` | Registro de usuarios |
| `/dashboard` | Dashboard (según rol) |
| `/admin/dashboard` | Panel administrativo |
| `/admin/resources` | Gestor de recursos |
| `/recursos/crear` | Crear nuevo recurso |

---

## 👥 Tipos de Usuario

### 👮 Admin
- Email: `admin@yachay.dev`
- Acceso: `/admin/dashboard`
- Permisos: Aprobar/Rechazar recursos

### 👨‍🏫 Profesor (Teacher)
- Registro normal con rol actualizado a 'teacher'
- Acceso: Crear recursos
- Permisos: Subir y editar propios recursos

### 👨‍🎓 Estudiante (Student)
- Registro normal (rol por defecto)
- Acceso: Ver recursos aprobados
- Permisos: Guardar favoritos

---

## 🎨 Paleta de Colores Nueva

```
🔵 Azul Oscuro:   #0A1828 (Fondos)
🟢 Turquesa:      #178582 (Primario)
🟡 Dorado:        #BFA181 (Destacado)
```

---

## ✨ Cambios Principales

### Frontend
✅ Glassmorphism en componentes
✅ Navbar sticky mejorada
✅ Tipografía moderna (Inter + Poppins)
✅ Modo oscuro por defecto
✅ Animaciones suaves

### Backend
✅ Nuevo rol: Admin
✅ Flujo de aprobación: Pendiente → Aprobado/Rechazado
✅ Sistema de rechazo con motivos
✅ Visibilidad controlada de recursos

---

## 📊 Archivos Documentación

- 📄 `CHANGELOG.md` - Cambios técnicos detallados
- 📄 `RESUMEN_PROYECTO.md` - Resumen ejecutivo
- 📄 `GUIA_PRUEBAS.md` - Casos de prueba paso a paso
- 📄 `INICIO_RAPIDO.md` - Este archivo

---

## 🧪 Test Rápido (5 min)

1. ✅ Login como `admin@yachay.dev`
2. ✅ Ve a `/admin/dashboard` 
3. ✅ Crea un profesor y un recurso
4. ✅ Aprueba desde admin
5. ✅ Login como estudiante y ve el recurso en biblioteca

---

## 📞 Soporte

Para problemas, consulta:
- `GUIA_PRUEBAS.md` - Sección "Si Encuentras Problemas"
- Terminal: `php artisan tinker` para debugging

---

**¡YachayCusco está listo para usarse!** 🚀

Versión: 2.0 | Fecha: 30 de Junio de 2026
