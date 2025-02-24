<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Item;

class ItemControllerTest extends TestCase {
  use RefreshDatabase;

  /**
   * Teste que verifica se a rota de itens retorna 200 (OK).
   */
  public function test_can_get_items_list() {
    // Prepara: cria alguns registros de teste
    Item::factory()->count(10)->create();

    // Ação: faz uma requisição GET “falsa” para /api/items
    $response = $this->getJson('/api/items');

    // Verificação: status e se há algum resultado retornado
    $response->assertStatus(200);
    $response->assertJsonStructure([
        'data', // Se estiver usando pagination do Laravel
    ]);

    // Se quiser verificar se retornou 10 itens:
    $this->assertCount(10, $response->json('data'));
  }

  /**
   * Teste de filtro pelo campo 'codigo' (char).
   */
  public function test_can_filter_items_by_codigo() {
    // Cria 1 Item específico e 2 genéricos
    $itemAlvo = Item::factory()->create(['codigo' => 'ABC123']);
    Item::factory()->count(2)->create(['codigo' => 'XYZ999']);

    $response = $this->getJson('/api/items?codigo=ABC123');

    $response->assertStatus(200);
    // Espera retornar só o item com codigo=ABC123
    $this->assertCount(1, $response->json('data'));
    // Verifica se o primeiro item retornado realmente é o ABC123
    $this->assertEquals('ABC123', $response->json('data.0.codigo'));
  }

  /**
   * Teste de filtro pelo campo 'nome' (varchar).
   */
  public function test_can_filter_items_by_nome() {
    Item::factory()->create(['nome' => 'Caneta Azul']);
    Item::factory()->create(['nome' => 'Lápis Preto']);

    // Vamos filtrar por “Caneta”
    $response = $this->getJson('/api/items?nome=Caneta');
    $response->assertStatus(200);

    // Deve retornar somente 1 item (o “Caneta Azul”)
    $data = $response->json('data');
    $this->assertCount(1, $data);
    $this->assertEquals('Caneta Azul', $data[0]['nome']);
  }

  /**
   * Teste de filtro pelo campo 'descricao' (text).
   */
  public function test_can_filter_items_by_descricao() {
    Item::factory()->create([
        'descricao' => 'Este item é especial e tem cor amarela'
    ]);
    Item::factory()->create([
        'descricao' => 'Normal sem nada de cor'
    ]);

    // Filtra com a palavra "amarela"
    $response = $this->getJson('/api/items?descricao=amarela');
    $response->assertStatus(200);

    $this->assertCount(1, $response->json('data'));
    $this->assertStringContainsString(
        'amarela',
        $response->json('data.0.descricao')
    );
  }

  /**
   * Teste de filtro pelo campo 'quantidade' (integer).
   */
  public function test_can_filter_items_by_quantidade() {
    Item::factory()->create(['quantidade' => 100]);
    Item::factory()->create(['quantidade' => 200]);

    $response = $this->getJson('/api/items?quantidade=100');
    $response->assertStatus(200);

    $this->assertCount(1, $response->json('data'));
    $this->assertEquals(100, $response->json('data.0.quantidade'));
  }
}
