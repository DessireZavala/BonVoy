<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['user_id', 'contenido_id', 'total', 'estado', 'fecha_reserva'];

    // Relación con el Usuario (ESTO ES LO QUE FALTA)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contenido()
    {
        return $this->belongsTo(Contenido::class);
    }
}