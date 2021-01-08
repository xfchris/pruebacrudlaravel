<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Helpers;
use App\Http\Requests\ClienteUpdateRequest;

class ClienteController extends Controller
{
    /**
     * Muestra pagina principal
     */
    public function principal(){
        return view('index');
    }

    /**
     * Devuelve todos los clientes
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Cliente::orderBy('id', 'DESC')->get();
        return Helpers::ViewAPIResponse($res);
    }

    /**
     * Muestra vista para crear un cliente
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Guarda en base de datos un nuevo cliente
     *
     * @param  \App\Http\Requests\ClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteRequest $request, Cliente $cliente)
    {
        try{
            $cliente->fill($request->all())->save();
            $response = Helpers::ViewAPIResponse($cliente);
        } catch (\Throwable $ex) {
            $response = Helpers::ViewAPIResponse('No se pudo guardar en base de datos', 500, $ex);
        }
        return $response;
    }

    /**
     * Muestra un cliente en expecífico
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return Helpers::ViewAPIResponse($cliente);
    }

    /**
     * Muestra el formulario para editar un cliente en específico
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Actualiza un cliente en expecifico
     *
     * @param  \App\Http\Requests\ClienteUpdateRequest $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        try{
            $cliente->fill($request->all())->save();
            $response = Helpers::ViewAPIResponse($cliente);
        } catch (\Throwable $ex) {
            $response = Helpers::ViewAPIResponse('No se pudo actualizar en base de datos', 500, $ex);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        try{
            if (!$cliente->delete()){
                new \Throwable("Error al eliminar cliente en base de datos");
            }
            $response = Helpers::ViewAPIResponse("Cliente eliminado");
        } catch (\Throwable $ex) {
            $response = Helpers::ViewAPIResponse(null, 500, $ex);
        }       
        return $response;
    }
}
