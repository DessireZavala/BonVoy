<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::table('contenido', function (Blueprint $table) {
        // Agregamos la columna rating después de la descripción
        $table->decimal('rating', 3, 1)->default(0.0)->after('descripcion');
    });
}

public function down(): void
{
    Schema::table('contenido', function (Blueprint $table) {
        $table->dropColumn('rating');
    });
}
};
