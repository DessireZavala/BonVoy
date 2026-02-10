<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    // ESTA ES LA PARTE QUE FALTA:
    protected $fillable = [
        'user_id',
        'favorable_id',
        'favorable_type',
    ];

    /**
     * Obtener el modelo poseedor del favorito (Vuelo, Hotel, etc.)
     */
    public function favorable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relación con el usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}