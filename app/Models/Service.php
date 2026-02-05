<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Añade esto si vas a relacionarlos:
use App\Models\Service; 
use App\Models\DigitalPass;

class Destination extends Model {
    // Aquí van las funciones que te pasé antes...
    public function destination() {
        return $this->belongsTo(Destination::class);
    }
}