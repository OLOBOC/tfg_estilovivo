<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    
    protected $fillable = ['user_id', 'peluquero_id', 'fecha', 'hora', 'servicios'];
    protected $casts = [
        'servicios' => 'array',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function peluquero()
    {
        return $this->belongsTo(User::class, 'peluquero_id');
    }
}

