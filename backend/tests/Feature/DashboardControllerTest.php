<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Item;

class DashboardControllerTest extends TestCase {
  use RefreshDatabase;

  /**
   * Testa se a rota de dashboard retorna status 200 e uma estrutura esperada.
   */
  public function test_can_retrieve_dashboard_data() {
    // Cria alguns itens que serão agregados
    Item::factory()->create(['codigo' => 'ABC001']);
    Item::factory()->create(['codigo' => 'ABC001']);
    Item::factory()->create(['codigo' => 'XYZ999']);

    $response = $this->getJson('/api/dashboard');
    $response->assertStatus(200);

    // Verifica se a estrutura retornada tem o que precisamos
    // Exemplo: array de objetos {codigo, total}
    $response->assertJsonStructure([
        ['codigo', 'total']
    ]);

    // Se quisermos verificar quantas linhas existiriam no agregador
    $data = $response->json();
    // Ex.: Esperamos 2 grupos (ABC001 e XYZ999)
    $this->assertCount(2, $data);

    // Verifica se o "ABC001" tem total=2
    $abcGroup = collect($data)->firstWhere('codigo', 'ABC001');
    $this->assertEquals(2, $abcGroup['total']);
  }
}
