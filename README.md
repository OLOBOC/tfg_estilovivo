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

**No está lista para desplegarse en Vercel todavía.** Vercel no ofrece Laravel como framework de despliegue automático; aunque existe un runtime PHP comunitario, este repositorio aún no tiene configuración de runtime/rutas para Vercel ni una base de datos, almacenamiento y correo de producción configurados. No subas `.env` ni credenciales al repositorio. Configura primero esos servicios y sus variables en el panel de despliegue y verifica registro, inicio de sesión y reservas en un entorno de pruebas.

Como alternativa más directa para una aplicación Laravel, utiliza un proveedor con soporte de PHP persistente (por ejemplo, Laravel Cloud, Railway o un VPS). En cualquier proveedor, completa antes de publicar los datos reales del titular, contacto, conservación de datos y proveedores en las páginas de aviso legal y privacidad.

---

## 👨‍💻 Autor

**Omar Lobo Cuesta**  
Proyecto de TFG — Desarrollo de Aplicaciones Web  
2º DAW