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
     Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');              // Nombre del producto
        $table->string('categoria');           // Grano, fruta, verdura, insumo
        $table->decimal('precio', 8, 2);       // Precio unitario
        $table->integer('cantidad');           // Stock disponible
        $table->string('foto')->nullable();    // Imagen del producto
        $table->text('descripcion')->nullable(); // Detalles opcionales
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
