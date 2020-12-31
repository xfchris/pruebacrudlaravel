<?php

namespace App\Http\Requests;

use App\Helpers;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ClienteRequest extends FormRequest
{
    /**
     * Determina si el usuario esta autorizado
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna las reglas de validacion a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|max:80',
            'apellido' => 'required|max:80',
            'telefono' => 'required|max:120',
            'email' => 'required|email|unique:clientes|max:120',
            'direccion' => 'required|max:500'
        ];
    }
    
    /**
     * Retorna errores con estructura base de respuestas
     *
     * @param Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(Helpers::APIResponse($validator->errors(), 'error'), 422);
        throw new ValidationException($validator, $response);
    }
}
