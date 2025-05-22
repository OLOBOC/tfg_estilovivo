
# 💇‍♂️ Estilo Vivo - Gestión Web para Peluquería

Aplicación web desarrollada en Laravel para la gestión de citas en una peluquería. Permite a clientes registrarse y agendar citas, y a peluqueros ver su agenda del día.

---

## 🧰 Requisitos

- PHP >= 8.2
- Composer
- Node.js y NPM
- Laravel Herd (opcional, recomendado en macOS)
- Base de datos MySQL (o SQLite para desarrollo rápido)

---

## ⚙️ Instalación paso a paso

1. Clona el repositorio:
```bash
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo
```

2. Instala las dependencias:
```bash
composer install
npm install
```

3. Copia el archivo `.env.example` y configúralo:
```bash
cp .env.example .env
```

4. Genera la clave de la aplicación:
```bash
php artisan key:generate
```

5. Configura tu base de datos en el archivo `.env`.

6. Ejecuta las migraciones:
```bash
php artisan migrate
```

7. Compila los assets (Tailwind + JS):
```bash
npm run dev
```

8. Levanta el servidor local:
```bash
php artisan serve
```

---

## 🧪 Funcionalidades básicas

- Registro e inicio de sesión (Laravel Breeze).
- Roles: Cliente y Peluquero.
- Gestión de citas por parte de clientes.
- Agenda diaria para peluqueros.
- Galería de cortes (próximamente).

---

## 📸 Stack técnico

- Laravel 11
- Tailwind CSS
- Blade + Alpine.js
- Laravel Breeze (autenticación)
- Vite (para assets)

---

## ✅ Notas

- Si usas Laravel Herd, solo necesitas colocar el proyecto en `~/Sites` y acceder desde `http://tfg-estilovivo.test`.
- Recuerda configurar `.env` correctamente en cualquier equipo nuevo.

---

## 👨‍💻 Autor

Omar — TFG Grado en Ingeniería Informática
