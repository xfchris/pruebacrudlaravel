<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use App\Helpers;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

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

    /**
     * @test
     */
    public function verificar_que_se_cree_un_cliente()
    {
        $data = [
            'nombre' => 'Chris',
            'apellido' => 'Vale',
            'telefono' => '123456',
            'email' => 'email@algo.com',
            'direccion' => 'calle falsa 123'
        ];
        $res = $this->post(route('api.clientes.store'),$data);
        $res->assertStatus(200);
        $res->assertJsonFragment(['status'=>'success']);
        $this->assertDatabaseHas('clientes', $data);
    }

    /**
     * @test
     */
    public function verificar_error_al_crear_cliente_con_datos_erroneos()
    {
        $data = [
            'nombre' => 'Chris',
            'apellido' => 'Vale',
            'telefono' => '123456',
            'email' => 'emailFalso',
            'direccion' => 'calle falsa 123'
        ];
        $res = $this->post(route('api.clientes.store'),$data);
        $res->assertStatus(422);
        $res->assertJsonFragment(['status'=>'error']);
    }

    /**
     * @test
     */
    public function verificar_que_se_actualiza_un_cliente()
    {
        $cliente = Cliente::factory()->create();
        $data = [
            'nombre' => 'Nombre actualizado',
            'apellido' => 'Vale actualizdo',
            'telefono' => '123456',
            'email' => 'email@algo.com',
            'direccion' => 'calle falsa 123'
        ];
        $res = $this->put(route('api.clientes.update', [$cliente->id]), $data);
        $res->assertStatus(200);
        $res->assertJsonFragment(['status'=>'success']);
        $this->assertDatabaseHas('clientes', $data);
    }

    /**
     * @test
     */
    public function verificar_que_se_elimina_un_cliente()
    {
        $cliente = Cliente::factory()->create();
        $res = $this->delete(route('api.clientes.destroy', [$cliente->id]));
        $res->assertStatus(200);
        $res->assertJsonFragment(['status'=>'success']);
        $this->assertDatabaseMissing('clientes', ['id' => $cliente->id]);
    }
}
