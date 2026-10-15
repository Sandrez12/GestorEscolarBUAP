# Gestor Escolar BUAP

Sistema académico web para profesores y estudiantes de la BUAP. Permite administrar materias, grupos y estudiantes, inscribir estudiantes en grupos y consultar la carga académica desde un panel con autenticación.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-supported-4169E1?logo=postgresql&logoColor=white)

## Funcionalidades

- **Autenticación** de usuarios (registro, inicio de sesión, recuperación de contraseña y perfil) con Laravel Breeze.
- **Panel principal** con la carga académica.
- **Materias:** crear, editar, listar y eliminar.
- **Grupos:** crear grupos asociados a una materia y consultar su detalle.
- **Estudiantes:** registro y listado.
- **Inscripciones:** asociar estudiantes a grupos y ver quiénes están inscritos.
- Interfaz con identidad institucional BUAP.

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2+, Laravel 12 (arquitectura MVC) |
| Frontend | Blade, Tailwind CSS, Vite |
| Base de datos | MySQL, PostgreSQL o SQLite (configurable en `.env`) |
| Pruebas | Pest |
| Despliegue | Docker + Apache (listo para Render), configuración para Vercel |

## Estructura del proyecto

```
app/
  Http/Controllers/   Materia, Grupo, Estudiante, Dashboard, Auth, Profile
  Models/             User, Materia, Grupo, Estudiante, GrupoEstudiante
database/migrations/  Esquema: materias, grupos, estudiantes y grupo_estudiantes
resources/views/      Blade: dashboard, materias, grupos, estudiantes, auth
routes/web.php        Rutas protegidas por autenticación
tests/                Pruebas con Pest
Dockerfile            Imagen de producción (PHP 8.4 + Apache)
```

## Instalación local

Requisitos: PHP 8.2+, Composer, Node.js y una base de datos (MySQL, PostgreSQL o SQLite).

```bash
git clone https://github.com/Sandrez12/GestorEscolarBUAP.git
cd GestorEscolarBUAP

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Configura la base de datos en `.env` (por defecto usa SQLite). Ejemplo con MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_academico
DB_USERNAME=root
DB_PASSWORD=
```

Luego crea las tablas y levanta el proyecto:

```bash
php artisan migrate
npm run dev        # en una terminal
php artisan serve  # en otra terminal
```

Abre `http://127.0.0.1:8000`.

## Pruebas

```bash
php artisan test
```

## Despliegue con Docker

El `Dockerfile` instala las dependencias de producción y arranca Apache; `start.sh` limpia la caché y ejecuta las migraciones al iniciar. Define estas variables de entorno en tu proveedor (por ejemplo Render): `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false` y las `DB_*` de tu base de datos.

```bash
docker build -t gestor-escolar .
docker run -p 8080:80 --env-file .env gestor-escolar
```

## Equipo

Proyecto desarrollado para la asignatura **Modelos de Desarrollo Web**.

- Andrés Felipe Joya Buitrago
- Emily Nicoll David Villadiego
- Jessica Juarez

## Licencia

Proyecto con fines académicos.
