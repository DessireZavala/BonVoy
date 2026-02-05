<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{
    protected $table = 'contenido';

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'precio',
        'activo'
    ];

    public function imagenes() {
    return $this->hasMany(Imagen::class, 'contenido_id');
}

// Esta función te servirá para obtener solo la foto de portada
public function imagenPrincipal() {
    return $this->hasOne(Imagen::class, 'contenido_id')->where('es_principal', true);
}
}

