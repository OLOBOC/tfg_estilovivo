<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    // ✅ Define explícitamente el nombre de la tabla
    protected $table = 'galeria';

    protected $fillable = [
        'imagen',
        'servicio',
        'nombre_estilo',
        'descripcion',
    ];

    // Opcional: relación inversa si la usas desde User
    public function usuariosQueGuardaron()
    {
        return $this->belongsToMany(User::class, 'galeria_user')->withTimestamps();
    }
}
