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
            $table->id();  // ID autoincremental
            $table->string('codigo')->unique();  // El código es único
            $table->string('nombre');  // Nombre del producto
            $table->text('descripcion');  // Descripción del producto
            $table->enum('categoria', ['calzado', 'ropa', 'joyería']);  // Enum para la categoría
            $table->float('precio', 8, 2);  // Precio con dos decimales
            $table->integer('stock');  // Stock del producto
            $table->timestamps();  // created_at y updated_at automáticos
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
