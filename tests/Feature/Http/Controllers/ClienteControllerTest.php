<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use App\Helpers;

class ClienteControllerTest extends TestCase
{

    /**
     * @test
     */
    public function verificar_que_se_lista_todos_los_clientes()
    {
        Cliente::factory(3)->create();
        $clientes = Cliente::orderBy('id', 'DESC')->get();
        $res = $this->get(route('api.clientes.index'));
        $res->assertStatus(200);
        $res->assertJsonFragment(Helpers::APIResponse($clientes->toArray()));
    }

    /**
     * @test
     */
    public function verificar_que_se_muestra_un_cliente()
    {
        $cliente = Cliente::factory()->create();
        $res = $this->get(route('api.clientes.show', [$cliente->id]));
        $res->assertStatus(200);
        $res->assertJsonFragment(Helpers::APIResponse($cliente->toArray()));
    }
    
}
