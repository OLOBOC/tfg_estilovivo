<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    // estos son los campos que se pueden rellenar masivamente
    protected $fillable = ['user_id', 'peluquero_id', 'fecha', 'hora', 'servicio'];

    // relacion con el cliente que reservo la cita
    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relacion con el peluquero asignado
    public function peluquero()
    {
        return $this->belongsTo(User::class, 'peluquero_id');
    }
}
