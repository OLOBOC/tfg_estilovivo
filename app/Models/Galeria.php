<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'galeria';

    protected $fillable = [
        'imagen',
        'servicio',
        'nombre_estilo',
        'descripcion',
    ];

    /**
     * Relación con los usuarios que han guardado esta publicación
     */


    public function usuariosQueGuardaron()
    {
        return $this->belongsToMany(User::class, 'galeria_user')->withTimestamps();
    }
}
