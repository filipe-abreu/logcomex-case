<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
// use Illuminate\Http\Request;

class DashboardController extends Controller {
  public function index() {
    $items = Item::inRandomOrder() // Ordena aleatoriamente
        ->limit(10) // Pega apenas 10 registros aleatórios
        ->get();

    return response()->json($items);
  }
}
