# Gimnasio

Aplicación web para la gestión de un gimnasio, construida con **Laravel 13**, **CSS3 puro** (sin frameworks) y **Vite 8**.

> **Estado:** proyecto en fase inicial. Por ahora el repositorio contiene la base de Laravel configurada (autenticación de usuarios por defecto, colas, caché y sesiones en base de datos) y el entorno de desarrollo listo para empezar a construir las funcionalidades del gimnasio.

---

## Índice

- [Stack tecnológico](#stack-tecnológico)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Desarrollo](#desarrollo)
- [Tests y calidad de código](#tests-y-calidad-de-código)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Configuración del entorno](#configuración-del-entorno)
- [Desarrollo asistido por IA](#desarrollo-asistido-por-ia)
- [Flujo de trabajo con Git](#flujo-de-trabajo-con-git)
- [Licencia](#licencia)

---

## Stack tecnológico

| Capa | Tecnología | Versión |
|------|------------|---------|
| Lenguaje backend | PHP | 8.5 (mínimo 8.3) |
| Framework | Laravel | 13.x |
| Base de datos | SQLite (por defecto) | — |
| CSS | CSS3 puro (custom properties + `@layer`) | — |
| Bundler | Vite + `laravel-vite-plugin` | 8.x / 3.x |
| Tests | PHPUnit | 12.x |
| Formateo de código | Laravel Pint | 1.x |
| Logs en tiempo real | Laravel Pail | 1.x |
| Herramientas IA | Laravel Boost | 2.x |

## Requisitos

- **PHP 8.3 o superior** (recomendado 8.5) con las extensiones `pdo_sqlite`, `mbstring`, `openssl`, `fileinfo` y `curl`.
- **Composer 2**
- **Node.js 20 o superior** y **npm**
- **Git**

Si no tienes PHP y Composer instalados, puedes usar el instalador oficial de [php.new](https://php.new):

```powershell
# Windows (PowerShell)
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

```bash
# macOS
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"

# Linux
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

### Runtime portable (opcional, solo Windows)

En la máquina de desarrollo original se usa un runtime portable (PHP, Composer y Node) en la carpeta `.runtime/`, que **no se versiona** por su tamaño (~277 MB). Si tienes esa carpeta, actívala en cada terminal antes de trabajar:

```powershell
# PowerShell
. .\.runtime\activate.ps1
```

```bat
:: CMD
.runtime\activate.bat
```

Si no la tienes, simplemente usa PHP, Composer y Node instalados en tu sistema.

## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/cronoscopios/gimnasio.git
cd gimnasio

# 2. Instalación completa en un solo paso
composer run setup
```

El script `setup` hace lo siguiente:

1. `composer install`: instala las dependencias PHP.
2. Copia `.env.example` a `.env` si no existe.
3. `php artisan key:generate`: genera la `APP_KEY`.
4. `php artisan migrate --force`: crea las tablas.
5. `npm install --ignore-scripts`: instala las dependencias JS.
6. `npm run build`: compila los assets.

> **Nota:** con SQLite, si `database/database.sqlite` no existe, Laravel preguntará si quieres crearlo al migrar. También puedes crearlo a mano:
>
> ```powershell
> New-Item database/database.sqlite   # PowerShell
> ```
> ```bash
> touch database/database.sqlite      # bash
> ```

<details>
<summary>Instalación paso a paso (manual)</summary>

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
npm install --ignore-scripts
npm run build
```

</details>

## Desarrollo

### Levantar el entorno

```bash
composer run dev
```

Este comando levanta a la vez el servidor de Laravel, el servidor de Vite con recarga en caliente y los procesos auxiliares de desarrollo. La aplicación queda disponible en **http://localhost:8000**.

Si prefieres levantar los procesos por separado:

```bash
php artisan serve      # servidor PHP en http://localhost:8000
npm run dev            # Vite con hot reload
php artisan queue:listen   # worker de colas (QUEUE_CONNECTION=database)
php artisan pail       # logs en tiempo real
```

### Comandos útiles

| Comando | Descripción |
|---------|-------------|
| `php artisan migrate` | Ejecuta las migraciones pendientes |
| `php artisan migrate:fresh --seed` | Reconstruye la base de datos y ejecuta los seeders |
| `php artisan db:seed` | Ejecuta los seeders |
| `php artisan route:list --except-vendor` | Lista las rutas de la aplicación |
| `php artisan make:model Nombre -mfs` | Crea modelo + migración + factory + seeder |
| `php artisan tinker` | Consola interactiva con el contexto de la app |
| `npm run build` | Compila los assets para producción |

> Si un cambio de frontend no aparece o ves el error *"Unable to locate file in Vite manifest"*, ejecuta `npm run build` o arranca `npm run dev`.

## Tests y calidad de código

### Tests

El proyecto usa **PHPUnit**. Los tests usan una base de datos SQLite en memoria (ver `phpunit.xml`), así que no tocan tu base de datos local.

```bash
composer run test                          # limpia la caché de config y ejecuta todos los tests
php artisan test --compact                 # todos los tests, salida compacta
php artisan test tests/Feature/ExampleTest.php   # un archivo concreto
php artisan test --filter=nombreDelTest    # un test concreto
```

Para crear tests nuevos:

```bash
php artisan make:test --phpunit NombreTest          # test de feature (tests/Feature)
php artisan make:test --phpunit --unit NombreTest   # test unitario (tests/Unit)
```

### Formateo

El estilo de código PHP se controla con **Laravel Pint**:

```bash
vendor/bin/pint            # formatea todo el proyecto
vendor/bin/pint --dirty    # formatea solo los archivos modificados
```

El archivo `.editorconfig` define la indentación (4 espacios) y los finales de línea (LF), y `.gitattributes` normaliza los finales de línea a LF en el repositorio.

## Estructura del proyecto

```
gimnasio/
├── app/
│   ├── Http/Controllers/   # Controladores
│   ├── Models/             # Modelos Eloquent
│   └── Providers/          # Service providers
├── bootstrap/              # Arranque de la app (app.php, providers.php)
├── config/                 # Archivos de configuración
├── database/
│   ├── factories/          # Factories para tests y seeders
│   ├── migrations/         # Migraciones
│   └── seeders/            # Seeders
├── public/                 # Document root (index.php, assets compilados en build/)
├── resources/
│   ├── css/               # CSS puro: base/, layout/, components/, utilities/ (entrada: app.css)
│   ├── js/app.js           # Entrada de JavaScript
│   └── views/              # Vistas Blade
├── routes/
│   ├── web.php             # Rutas web
│   └── console.php         # Comandos y tareas programadas
├── storage/                # Logs, caché, sesiones y archivos subidos
├── tests/
│   ├── Feature/            # Tests de feature
│   └── Unit/               # Tests unitarios
├── .claude/                # Skills y agentes para Claude Code
├── AGENTS.md / CLAUDE.md   # Guías para agentes de IA (Laravel Boost)
└── boost.json              # Configuración de Laravel Boost
```

## Configuración del entorno

Las variables de entorno viven en `.env` (nunca se sube al repositorio). Las más relevantes:

| Variable | Valor por defecto | Descripción |
|----------|-------------------|-------------|
| `APP_NAME` | `Laravel` | Nombre de la aplicación |
| `APP_URL` | `http://localhost:8000` | URL base |
| `APP_LOCALE` | `en` | Idioma (usa `es` para español) |
| `APP_FAKER_LOCALE` | `en_US` | Idioma de los datos falsos (usa `es_ES`) |
| `DB_CONNECTION` | `sqlite` | Motor de base de datos |
| `SESSION_DRIVER` | `database` | Sesiones guardadas en la base de datos |
| `QUEUE_CONNECTION` | `database` | Colas en la base de datos |
| `CACHE_STORE` | `database` | Caché en la base de datos |
| `MAIL_MAILER` | `log` | Los correos se escriben en `storage/logs` |

### Usar MySQL / MariaDB en lugar de SQLite

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gimnasio
DB_USERNAME=root
DB_PASSWORD=
```

Después ejecuta `php artisan migrate`.

## Desarrollo asistido por IA

El proyecto está preparado para trabajar con agentes de IA como **Claude Code** mediante [Laravel Boost](https://laravel.com/docs/ai):

- **`CLAUDE.md` / `AGENTS.md`**: guías y convenciones que siguen los agentes.
- **`boost.json`**: configuración de Boost (guidelines, skills y servidor MCP).
- **`.claude/skills/`**: skills del proyecto (buenas prácticas de Laravel, testing, diseño de interfaces con *Impeccable*, despliegue en Laravel Cloud).
- **`.claude/agents/`**: subagentes especializados.

### Servidor MCP

El archivo `.mcp.json` **no se versiona** porque contiene rutas absolutas de cada máquina. Para activar el servidor MCP de Laravel Boost, créalo en la raíz del proyecto:

```json
{
    "mcpServers": {
        "laravel-boost": {
            "command": "php",
            "args": ["artisan", "boost:mcp"]
        }
    }
}
```

O regenera la configuración con:

```bash
php artisan boost:install
```

### Archivos que no se versionan

Además de lo habitual en Laravel (`vendor/`, `node_modules/`, `.env`, `public/build/`, logs...), el `.gitignore` excluye:

- `.runtime/`: runtime portable local.
- `.mcp.json`: configuración MCP con rutas de la máquina.
- `.claude/settings.local.json`: ajustes personales de Claude Code.
- `.claude/skills/impeccable/scripts/bin/`: binario de la skill *Impeccable* (se descarga solo cuando hace falta).
- `database/*.sqlite`: la base de datos local.

## Flujo de trabajo con Git

- La rama principal es **`main`**.
- Crea una rama por funcionalidad o corrección: `feature/socios`, `fix/login`...
- Antes de hacer commit:
  1. `vendor/bin/pint --dirty`
  2. `php artisan test --compact`
- Escribe mensajes de commit claros y en imperativo (*"Añade gestión de socios"*).

## Licencia

Proyecto basado en [Laravel](https://laravel.com), distribuido bajo la [licencia MIT](https://opensource.org/licenses/MIT).
