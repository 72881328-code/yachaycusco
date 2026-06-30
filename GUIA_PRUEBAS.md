# 🧪 GUÍA DE PRUEBAS - YachayCusco Modernizado

## Preparación Inicial

### 1. Verificar que las migraciones se ejecutaron
```bash
cd c:\xampp\htdocs\yachaycusco
php artisan migrate --fresh --seed
```

Deberías ver:
```
✓ 0001_01_01_000000_create_users_table
✓ 0001_01_01_000001_create_cache_table
✓ 0001_01_01_000002_create_jobs_table
✓ 2026_06_02_135124_create_resources_table
✓ 2026_06_02_135137_create_user_saved_resources_table
✓ 2026_06_02_141840_create_sessions_table
✓ 2026_06_30_121434_update_users_table_add_admin_role
✓ 2026_06_30_121522_add_rejection_reason_to_resources_table
```

### 2. Crear usuario Admin
```bash
php artisan db:seed --class=CreateAdminSeeder
```

Deberías ver:
```
✓ Administrador creado:
  Email: admin@yachay.dev
  Contraseña: admin123
  Rol: admin
```

---

## 🎯 Casos de Prueba

### Caso 1: Verificar Nuevo Diseño Visual

**Pasos:**
1. Abre `http://localhost/yachaycusco`
2. Observa el home

**Verificar:**
- ✅ Fondo azul oscuro (#0A1828)
- ✅ Navbar sticky en la parte superior
- ✅ Logo con colores "Yachay" (dorado) + "Cusco" (turquesa)
- ✅ Tarjetas con efecto glassmorphism
- ✅ Botones turquesa con hover suave
- ✅ Tipografía moderna (Poppins en títulos)

**Resultado Esperado:**
```
✓ Página con diseño moderno
✓ Colores según paleta especificada
✓ Efecto blur visible en tarjetas
✓ Transiciones suaves
```

---

### Caso 2: Crear Usuario Admin y Acceder a Panel

**Pasos:**
1. En terminal, ejecuta: `php artisan db:seed --class=CreateAdminSeeder`
2. Abre `http://localhost/yachaycusco/login`
3. Ingresa:
   - Email: `admin@yachay.dev`
   - Contraseña: `admin123`
4. Haz clic en "Iniciar Sesión"

**Verificar:**
- ✅ Login exitoso
- ✅ Serás redirigido a `/admin/dashboard`
- ✅ La navbar muestra "⚙️ Admin"
- ✅ Ves el dashboard con estadísticas

**Resultado Esperado:**
```
✓ Usuario admin autenticado
✓ Dashboard admin visible
✓ Botón Admin en navbar
```

---

### Caso 3: Crear Usuario Profesor

**Pasos:**
1. Haz logout (si estás en sesión)
2. Abre `http://localhost/yachaycusco/register`
3. Completa el formulario:
   - Nombre: "Juan"
   - Apellido: "Docente"
   - Email: "profesor@test.dev"
   - Contraseña: "password123"
4. Abre la consola de MySQL o la base de datos
5. Actualiza el rol a 'teacher':
   ```sql
   UPDATE users SET role = 'teacher' WHERE email = 'profesor@test.dev';
   ```
6. Login nuevamente

**Verificar:**
- ✅ Usuario creado exitosamente
- ✅ Rol actualizado a 'teacher'
- ✅ Dashboard muestra opciones de profesor

**Resultado Esperado:**
```
✓ Usuario profesor registrado
✓ Rol actualizado en BD
```

---

### Caso 4: Crear un Recurso (Profesor)

**Pasos:**
1. Estando logueado como profesor
2. Haz clic en "+ Nuevo Recurso" en la navbar
3. Completa el formulario:
   - Título: "Introducción a Matemáticas"
   - Descripción: "Concepto básico de números"
   - Materia: Matemática
   - Nivel: Primaria
   - Idioma: Castellano
   - Tipo: PDF
   - Archivo: (Sube un PDF si deseas)
4. Haz clic en "Crear Recurso"

**Verificar:**
- ✅ Formulario con diseño glassmorphism
- ✅ Mensaje de alerta sobre moderación
- ✅ Recurso creado exitosamente
- ✅ Redirección a dashboard
- ✅ Recurso aparece con estado "Pendiente"

**Resultado Esperado:**
```
✓ Recurso creado con estado "Pendiente"
✓ Visible en panel docente
✓ No visible en biblioteca para estudiantes
```

---

### Caso 5: Aprobar Recurso (Admin)

**Pasos:**
1. Login como admin (`admin@yachay.dev`)
2. Automáticamente vas a `/admin/dashboard`
3. Verás el recurso pendiente en la lista
4. Haz clic en "✓ Aprobar"

**Verificar:**
- ✅ Botón de aprobación visible
- ✅ Recurso desaparece de la lista de pendientes
- ✅ Mensaje de éxito
- ✅ Recurso ahora está "Publicado"

**Resultado Esperado:**
```
✓ Recurso aprobado
✓ Estado cambiado a "Publicado"
✓ Feedback visual positivo
```

---

### Caso 6: Ver Recurso Aprobado (Estudiante)

**Pasos:**
1. Crea un usuario estudiante:
   - Registro normal (sin cambiar rol)
   - Email: `estudiante@test.dev`
2. Login como estudiante
3. Haz clic en "Biblioteca"
4. Busca el recurso creado

**Verificar:**
- ✅ Solo ves el recurso aprobado
- ✅ El recurso del profesor rechazado NO aparece
- ✅ Puedes hacer clic en "Ver Detalle"
- ✅ Puedes guardar el recurso

**Resultado Esperado:**
```
✓ Estudiante ve solo recursos aprobados
✓ Control de visibilidad funciona
✓ Pueden guardar recursos favoritos
```

---

### Caso 7: Rechazar Recurso (Admin)

**Pasos:**
1. Como profesor, crea otro recurso
2. Login como admin
3. En `/admin/dashboard`, busca el nuevo recurso pendiente
4. Haz clic en "✗ Rechazar"
5. En el modal, ingresa un motivo:
   - "El contenido no cumple los estándares"
6. Haz clic en "Rechazar"

**Verificar:**
- ✅ Modal de rechazo visible
- ✅ Campo de motivo funciona
- ✅ Recurso cambio a estado "Rechazado"
- ✅ Motivo guardado en BD

**Resultado Esperado:**
```
✓ Recurso rechazado con motivo
✓ Estado "Rechazado" asignado
✓ Profesor puede ver motivo
```

---

### Caso 8: Ver Estado en Panel Profesor

**Pasos:**
1. Login como profesor
2. Ve a `/dashboard`
3. Observa la sección "Mis Recursos"

**Verificar:**
- ✅ Recursos aprobados: Badge turquesa "✓ Publicado"
- ✅ Recursos pendientes: Badge amarillo "⏳ Pendiente"
- ✅ Recursos rechazados: Badge rojo "✗ Rechazado"
- ✅ Diseño glassmorphism en tarjetas

**Resultado Esperado:**
```
✓ Badges de estado funciona
✓ Colores según especificación
✓ Dashboard actualizado
```

---

### Caso 9: Filtros en Admin

**Pasos:**
1. Login como admin
2. Ve a `/admin/resources`
3. Prueba filtros:
   - Estado: "Pendiente"
   - Materia: "Matemática"
4. Haz clic en "Filtrar"

**Verificar:**
- ✅ Filtros funcionan correctamente
- ✅ Solo muestra recursos según filtros
- ✅ Botón "Limpiar" resetea filtros
- ✅ Paginación funciona

**Resultado Esperado:**
```
✓ Filtros aplicados correctamente
✓ Resultados reducidos
✓ Paginación funciona
```

---

### Caso 10: Responsividad Móvil

**Pasos:**
1. En el navegador, abre DevTools (F12)
2. Activa modo móvil (Ctrl+Shift+M)
3. Navega por las páginas principales

**Verificar:**
- ✅ Navbar se adapta (menú hamburguesa)
- ✅ Tarjetas se apilan correctamente
- ✅ Formularios son legibles
- ✅ Botones son tocables (>44px)

**Resultado Esperado:**
```
✓ Diseño responsive funciona
✓ Sin elementos cortados
✓ Navegación en móvil fluida
```

---

## ⚠️ Pruebas de Seguridad

### Test 1: Admin-Only Routes

```bash
# Sin autenticarse, intenta acceder a:
curl http://localhost/yachaycusco/admin/dashboard
```

**Esperado:** Redirección a login

### Test 2: Profesor No Puede Acceder Admin

1. Login como profesor
2. Intenta acceder a `http://localhost/yachaycusco/admin/dashboard`

**Esperado:** Error 403 (Acceso Denegado)

### Test 3: CSRF Protection

1. Abre el DevTools → Network
2. Envía un formulario
3. Verifica header `X-CSRF-TOKEN` presente

**Esperado:** Token presente en todas las requests POST

---

## 📊 Verificación de Base de Datos

### Ejecutar Queries para Verificar

```sql
-- Ver usuarios con sus roles
SELECT id, name, email, role FROM users;

-- Ver recursos con estado
SELECT id, title, status, rejection_reason, author_id FROM resources;

-- Ver usuario admin
SELECT * FROM users WHERE role = 'admin';
```

**Resultado Esperado:**
```
id | name               | email              | role
1  | Administrador      | admin@yachay.dev   | admin
2  | Juan Docente       | profesor@test.dev  | teacher
3  | Estudiante Prueba  | estudiante@test.dev| student
```

---

## ✅ Checklist Final de Pruebas

- [ ] Diseño visual correcto (colores, glassmorphism)
- [ ] Navegación sticky funciona
- [ ] Login/Logout funciona correctamente
- [ ] Admin dashboard accesible solo para admin
- [ ] Profesor puede crear recursos
- [ ] Recursos se crean con estado "Pendiente"
- [ ] Admin puede ver recursos pendientes
- [ ] Admin puede aprobar recursos
- [ ] Admin puede rechazar con motivo
- [ ] Estudiante ve solo recursos aprobados
- [ ] Filtros funcionan en admin
- [ ] Responsive design en móvil
- [ ] Mensajes de error/éxito
- [ ] Protección CSRF activa
- [ ] Acceso a rutas admin verificado

---

## 🐛 Si Encuentras Problemas

### Problem: Migraciones no se ejecutan
```bash
php artisan migrate:fresh
php artisan migrate
```

### Problem: Usuario admin no existe
```bash
php artisan db:seed --class=CreateAdminSeeder
```

### Problem: CSS no se ve actualizado
```bash
# Limpia cache
php artisan config:clear
php artisan cache:clear
# Recarga página: Ctrl+Shift+R
```

### Problem: Base de datos corrupta
```bash
php artisan migrate:fresh --seed
```

---

## 📝 Reporte de Pruebas

Después de completar todas las pruebas, documenta:
- ✅ Pruebas pasadas
- ❌ Pruebas fallidas
- 🐛 Bugs encontrados
- 💡 Mejoras sugeridas

---

*Gracias por probar YachayCusco 2.0* 🚀
