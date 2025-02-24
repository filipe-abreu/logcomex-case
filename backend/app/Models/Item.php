<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
  use HasFactory;

  /**
   * A tabela associada a este Model.
   */
  protected $table = 'items';

  /**
   * Definição dos campos que podem ser preenchidos em massa (mass assignment).
   */
  protected $fillable = [
    'codigo',
    'nome',
    'descricao',
    'quantidade',
  ];
}
