<?php

namespace App\Validators;

use App\Models\Ficha;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class BeneficioValidator{
    public static function validarSave($data){
        $rules = [
            'nombre' => 'required',
            'id_ficha' => function ($attribute, $value, $fail) use($data){
                if(empty($value)){
                    $fail("El campo <strong>ID Ficha</strong> es requerido");
                }

                $checkFicha = Ficha::select("id")->where("id", "=", $value)->first();

                if(!empty($checkFicha)){
                    $fail("La ficha ya se encuentra vinculada con otro beneficio");
                }
            },
            'fecha' => 'required'
        ];

        $customMsg = [
            'required' => 'El campo :attribute es requerido',
            'max' => [
                'string'  => 'El campo :attribute supera el máximo de caracteres.',
            ],
            'min' => 'Valor para :attribute no valido',
            'array' => 'El campo :attribute debe ser un arreglo.',
            'integer' => 'El campo :attribute debe ser entero.',
            'string' => 'El campo :attribute debe ser texto',
            'email' => 'El campo :attribute no tiene formato de Correo Electrónico',
            'custom' => [
                'attibute-name' => [
                    'rule-name' => 'custom-message'
                ]
            ],
        ];

        $atributos = [
            'nombre' => 'Nombre',
            'id_ficha' => 'Ficha',
            'fecha' => 'Fecha'
        ];

        $validateData = Validator::make($data, $rules, $customMsg);

        $validateData->setAttributeNames($atributos);

        if ($validateData->fails()) {
            return $validateData->errors();
        } else {
            return false;
        }
    }

    public static function validarUpdate($data){
        $rules = [
            'id' => 'required|integer',
            'nombre' => 'required',
            'id_ficha' => 'required|integer',
            'fecha' => 'required'
        ];

        $customMsg = [
            'required' => 'El campo :attribute es requerido',
            'max' => [
                'string'  => 'El campo :attribute supera el máximo de caracteres.',
            ],
            'min' => 'Valor para :attribute no valido',
            'array' => 'El campo :attribute debe ser un arreglo.',
            'integer' => 'El campo :attribute debe ser entero.',
            'string' => 'El campo :attribute debe ser texto',
            'email' => 'El campo :attribute no tiene formato de Correo Electrónico',
            'custom' => [
                'attibute-name' => [
                    'rule-name' => 'custom-message'
                ]
            ],
        ];

        $atributos = [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'id_ficha' => 'Ficha',
            'fecha' => 'Fecha'
        ];

        $validateData = Validator::make($data, $rules, $customMsg);

        $validateData->setAttributeNames($atributos);

        if ($validateData->fails()) {
            return $validateData->errors();
        } else {
            return false;
        }
    }
}
