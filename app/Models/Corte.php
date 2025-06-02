<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corte extends Model
{
    use HasFactory;

    // campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',
        'imagen',
        'descripcion'
    ];

    // relacion: un corte pertenece a un usuario (cliente)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

