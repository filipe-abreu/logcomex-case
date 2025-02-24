<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller {
  public function index(Request $request) {
    $query = Item::query();

    if ($request->filled('codigo')) {
        $query->where('codigo', $request->codigo);
    }
    if ($request->filled('nome')) {
        $query->where('nome', 'like', "%{$request->nome}%");
    }
    if ($request->filled('descricao')) {
        $query->where('descricao', 'like', "%{$request->descricao}%");
    }
    if ($request->filled('quantidade')) {
        $query->where('quantidade', $request->quantidade);
    }

    $items = $query->paginate(50);

    return response()->json($items);
  }
}
