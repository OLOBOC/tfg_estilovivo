📌 Documentación: Creación del usuario Administrador en Laravel (Tinker)
🎯 Objetivo
Permitir que el administrador del sistema pueda iniciar sesión con su propia cuenta personalizada, sin depender de un formulario de registro.

🛠 Herramienta utilizada
Utilizamos Laravel Tinker, una consola interactiva para ejecutar código PHP directamente dentro del contexto del proyecto Laravel.

🔁 Pasos para crear el administrador
1. Abrir Laravel Tinker
Desde la raíz del proyecto, ejecutar en la terminal:


php artisan tinker
Esto abrirá una consola donde puedes escribir código directamente.

2. Ejecutar el siguiente código
Pega este bloque dentro de la consola Tinker:

php
Copiar
Editar
use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin',
    'email' => 'admin@estilovivo.com',
    'password' => Hash::make('admin1234'), // Puedes cambiar esta contraseña
    'rol' => 'admin'
]);
Esto creará un nuevo usuario con rol de administrador en la base de datos.

3. Acceder al sistema
Luego puedes iniciar sesión desde la interfaz web con:

Correo: admin@estilovivo.com

Contraseña: admin1234

🔐 Nota: Por seguridad, se recomienda cambiar esta contraseña después del primer inicio de sesión.