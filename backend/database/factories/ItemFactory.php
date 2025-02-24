<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory {
  /**
   * A classe do Model que esta Factory cria instâncias.
   */
  protected $model = Item::class;

  /**
   * Define o "estado padrão" da Factory.
   */
  public function definition() {
    return [
      'codigo' => strtoupper($this->faker->lexify('???')).$this->faker->numerify('###'),
      'nome' => $this->faker->words(2, true),
      'descricao' => $this->faker->paragraph,
      'quantidade' => $this->faker->numberBetween(1, 1000),
    ];
  }
}
