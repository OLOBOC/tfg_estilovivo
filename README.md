# 💇‍♂️ Estilo Vivo – Gestión Web para Peluquería

Aplicación web desarrollada con Laravel y Tailwind CSS como proyecto de TFG. Permite a los clientes **registrarse, iniciar sesión y pedir cita**, a los peluqueros **consultar su agenda del día**.Incluye galería de cortes y panel administrativo básico.

---

## 🧰 Requisitos

- PHP >= 8.2
- Composer
- Node.js y NPM
- Laravel 12
- SQLite (por simplicidad en desarrollo)
- Navegador web (Chrome, Firefox...)
- Laravel Herd (opcional)
---

## ⚙️ Instalación paso a paso

1. **Clona o descarga el repositorio**  
```bash
git clone https://github.com/usuario/tfg_estilovivo.git
cd tfg_estilovivo
```

2. **Instala las dependencias de PHP**  
```bash
composer install
```

3. **Instala las dependencias de JavaScript**  
```bash
npm install
```

4. **Copia el archivo de entorno y edítalo**  
```bash
cp .env.example .env
```

5. **Comprueba la configuracion de la base de datos en `.env`**  
```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
```

6. **Genera la clave de aplicación**  
```bash
php artisan key:generate
```

7. **Limpia la caché de configuración**  
```bash
php artisan config:clear
```

8. **Ejecuta las migraciones y, si necesitas datos de ejemplo, los seeders**
```bash
php artisan migrate
php artisan db:seed
```

9. **Compila los assets del frontend (Tailwind + JS)**  
```bash
npm run dev
```

10. **Inicia el servidor local**  
```bash
php artisan serve
```

Accede desde tu navegador a:  
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧪 Funcionalidades principales

- Registro e inicio de sesión con Laravel Breeze
- Rol **cliente**: reserva de citas
- Rol **peluquero**: vista de agenda diaria
- Visualización de imágenes de cortes en `/public/img`
- Interfaz con Tailwind CSS para diseño responsive

---

## 📦 Stack tecnológico

- **Laravel 12**
- **Tailwind CSS**
- **Blade + Vite**
- **SQLite** (modo desarrollo)
- **Laravel Breeze** para autenticación
- **Eloquent ORM** para gestión de base de datos

---

## 🛠 Despliegue

La aplicación necesita PHP/Laravel, una base de datos persistente y variables de entorno de producción. SQLite local sirve para desarrollo, pero no debe usarse como base de datos de una instancia serverless.

El repositorio incluye una configuración inicial de Vercel: Vite compila los recursos, `public` sirve los archivos estáticos y el runtime comunitario `vercel-php` deriva las peticiones de Laravel a `api/index.php`. Este runtime no es un runtime oficial de Vercel; confirma su disponibilidad durante el despliegue.

Antes de desplegar, añade en la configuración de Vercel —no en Git— las variables `APP_KEY` (generada con `php artisan key:generate --show`), `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL`, `LARAVEL_STORAGE_PATH=/tmp/storage`, `VIEW_COMPILED_PATH=/tmp/views`, `LOG_CHANNEL=stderr`, una conexión de base de datos gestionada (`DB_CONNECTION=pgsql` y `DB_URL`), `SESSION_DRIVER=database`, `CACHE_STORE=database`, y `SESSION_SECURE_COOKIE=true`. Migra el esquema a esa base de datos gestionada antes de probar registro, acceso y reservas. No uses SQLite local, ni los drivers de sesión o caché `array` para producción: las funciones serverless no conservan su disco o memoria entre ejecuciones.

La galería guarda imágenes subidas en el disco local `public`, que no persiste en Vercel. El adaptador Laravel para S3 ya está incluido en Composer. Configura un almacenamiento de objetos compatible con S3, selecciona `FILESYSTEM_DISK=s3` y proporciona `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`, `AWS_URL` y, cuando el proveedor lo requiera, `AWS_ENDPOINT` antes de activar las subidas. Configura también un proveedor SMTP si vas a utilizar correo o recuperación de contraseñas. No subas `.env`, contraseñas ni claves al repositorio.

Esta configuración permite intentar el despliegue del servidor, pero no provisiona esos servicios ni verifica sus credenciales. Comprueba el log de la primera compilación y prueba todas las funciones en Preview. Antes de publicar al público, completa los datos reales del titular, contacto, conservación de datos y proveedores en las páginas de aviso legal y privacidad.

---

## 👨‍💻 Autor

**Omar Lobo Cuesta**  
Proyecto de TFG — Desarrollo de Aplicaciones Web  
2º DAW