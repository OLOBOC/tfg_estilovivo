<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cortes', function (Blueprint $table) {
            $table->id();

            // relacion con el cliente
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // ruta de la imagen del corte
            $table->string('imagen');

            // descripcion opcional del corte
            $table->text('descripcion')->nullable();

            // fecha de creacion
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('cortes');
    }
};


