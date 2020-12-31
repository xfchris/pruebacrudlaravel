<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Helpers;
use Exception;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Cliente::orderBy('id', 'DESC')->get();
        return Helpers::ViewAPIResponse($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente)
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
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return Helpers::ViewAPIResponse($cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
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
