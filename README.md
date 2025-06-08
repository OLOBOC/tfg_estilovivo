# 💇‍♂️ Estilo Vivo – Gestión Web para Peluquería

Aplicación web desarrollada con Laravel y Tailwind CSS como proyecto de TFG. Permite a los clientes **registrarse, iniciar sesión y pedir cita**, a los peluqueros **consultar su agenda del día**.Incluye galería de cortes y panel administrativo básico.

---

## 🧰 Requisitos

- PHP >= 8.1
- Composer
- Node.js y NPM
- Laravel 10
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

8. **Ejecuta las migraciones de base de datos con los seeders**  
```bash
php artisan migrate:fresh --seed
php artisan migrate
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

- **Laravel 10**
- **Tailwind CSS**
- **Blade + Vite**
- **SQLite** (modo desarrollo)
- **Laravel Breeze** para autenticación
- **Eloquent ORM** para gestión de base de datos

---

## 🛠 Despliegue

Este proyecto está pensado para funcionar localmente en desarrollo.  
Para producción se puede portar fácilmente a MySQL y desplegar en servicios como:
- Laravel Forge
- Railway
- VPS con Apache/Nginx

---

## 👨‍💻 Autor

**Omar Lobo Cuesta**  
Proyecto de TFG — Desarrollo de Aplicaciones Web  
2º DAW