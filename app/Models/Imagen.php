<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';
    
    protected $fillable = [
        'contenido_id',
        'ruta',
        'es_principal'
    ];

    public function contenido()
    {
        return $this->belongsTo(Contenido::class);
    }
}

