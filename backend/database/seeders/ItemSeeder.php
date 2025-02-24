<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder {
  /**
   *  Cria 2000 itens falsos.
   */
  public function run(): void {
    // \App\Models\Item::factory()->count(2000)->create();
    Item::factory(2000)->create();
  }
}
