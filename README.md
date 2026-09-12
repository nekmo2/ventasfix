# VentasFix - Sistema de Gestión de Carro de Compra

Backoffice y API REST para la gestión de usuarios, productos y clientes de VentasFix, desarrollado como examen del ramo Desarrollo de Software Web I. Construido con Laravel sobre el template Approx (Admin Dashboard).

## Descripción

Sistema con dos frentes de acceso:
- **Backoffice web**: interfaz gráfica para trabajadores del sistema, con login, dashboard y mantenedores (crear, ver, editar, eliminar) de Usuarios, Productos y Clientes.
- **API REST**: permite que aplicaciones de terceros (como el sistema Softland) interactúen con los mismos datos, protegida mediante autenticación por token (Laravel Sanctum).

También incluye un componente reutilizable que simula el consumo de un servicio externo (Softland) para consultar disponibilidad de stock por SKU.

## Tecnologías utilizadas

- PHP 8.3
- Laravel 11
- MySQL 8.0
- Laragon 6 (entorno de desarrollo local)
- Blade (motor de vistas de Laravel)
- Eloquent (ORM de Laravel)
- Laravel Sanctum (autenticación de la API mediante tokens)
- Template Approx (Bootstrap 5 Admin Dashboard)

## Funcionalidades

**Backoffice (interfaz web)**
- Login y registro de usuarios del sistema (clave cifrada con bcrypt)
- Dashboard con contadores de usuarios, productos y clientes registrados
- Mantenedor de Usuarios: listar, crear, editar, eliminar
- Mantenedor de Productos: listar, crear, editar, eliminar (con cálculo automático del precio de venta según el 19% de IVA)
- Mantenedor de Clientes: listar, crear, editar, eliminar
- Componente reutilizable que simula la consulta de disponibilidad de un producto en el sistema Softland

**API REST**
- Login con generación de token de acceso (Sanctum)
- Logout con invalidación del token
- CRUD completo de Usuarios, Productos y Clientes, protegido por autenticación
- Códigos de respuesta HTTP según estándar (200, 201, 404, 401)

## Estructura del proyecto

- `app/Models/` — modelos Eloquent: `User`, `Producto`, `Cliente`
- `app/Http/Controllers/UsuarioController.php`, `ProductoController.php`, `ClienteController.php` — controladores del backoffice
- `app/Http/Controllers/DashboardController.php` — controlador del dashboard
- `app/Http/Controllers/Api/` — controladores de la API (`AuthApiController`, `UsuarioApiController`, `ProductoApiController`, `ClienteApiController`)
- `app/Services/SoftlandService.php` — componente reutilizable que simula el servicio externo
- `resources/views/` — vistas del backoffice (usa el layout del template Approx)
- `routes/web.php` — rutas del backoffice
- `routes/api.php` — rutas de la API
- `database/migrations/` — migraciones de `users`, `productos`, `clientes`
- `postman/` — colección de Postman con las pruebas de la API

## Configuración de base de datos

Variables de entorno necesarias en `.env`:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ventasfix
DB_USERNAME=root
DB_PASSWORD=desarrollo_software_1


## Cómo ejecutar el proyecto

```bash
composer install
copy .env.example .env
php artisan key:generate
npm install
npm run build
php artisan migrate
php artisan serve
```

Luego entrar a `http://127.0.0.1:8000`

## Usuario de prueba

Para acceder al backoffice sin necesidad de registrarse:

- **Email:** alvaro@ventasfix.cl
- **Contraseña:** 12345678

Este mismo usuario puede usarse para autenticarse en la API mediante `POST /api/login`.

## Pruebas de la API (Postman)

En la carpeta `postman/` se incluye la colección `Examen-API-VentasFix.postman_collection.json` con las pruebas realizadas a todos los endpoints de la API (login, logout, y el CRUD completo de usuarios, productos y clientes, incluyendo casos de error 404 y 401).

Para probarla:

1. Abrir Postman
2. Importar el archivo (`File → Import`)
3. Con el proyecto corriendo (`php artisan serve`), ejecutar primero el request de `Login` dentro de la carpeta `Auth` para obtener un token
4. Usar ese token (Bearer Token) en las demás requests

## Grupo

Álvaro Vásquez