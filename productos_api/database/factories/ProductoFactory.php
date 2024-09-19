<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Producto::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->bothify('PROD-#####'),  // Código único de producto
            'nombre' => $this->faker->word,  // Nombre aleatorio
            'descripcion' => $this->faker->paragraph,  // Descripción aleatoria
            'categoria' => $this->faker->randomElement(['calzado', 'ropa', 'joyería']),  // Selección aleatoria de la categoría
            'precio' => $this->faker->randomFloat(2, 10, 1000),  // Precio aleatorio entre 10 y 1000 con dos decimales
            'stock' => $this->faker->numberBetween(1, 100),  // Stock aleatorio entre 1 y 100
        ];
    }
}
