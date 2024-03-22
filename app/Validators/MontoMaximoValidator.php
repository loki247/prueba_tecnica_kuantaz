<?php

namespace App\Validators;

use App\Models\Beneficio;
use App\Models\MontoMaximo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class MontoMaximoValidator{
    public static function validarSave($data){
        $rules = [
            'id_beneficio' => function ($attribute, $value, $fail) use($data){
                if(empty($value)){
                    $fail("El campo <strong>ID Beneficio</strong> es requerido");
                }

                $checkBeneficio = MontoMaximo::select("id_beneficio")->where("id_beneficio", "=", $value)->first();

                if(!empty($checkBeneficio)){
                    $fail("El beneficio ya se encuentra vinculado a otro monto máximo");
                }
            },
            'monto_minimo' => 'required|integer',
            'monto_maximo' => 'required|integer'
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
            'id_beneficio' => 'ID Beneficio',
            'monto_minimo' => 'Monto Mímimo',
            'monto_maximo' => 'Monto Máximo'
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
            'id_beneficio' => 'required|integer',
            'monto_minimo' => 'required|integer',
            'monto_maximo' => 'required|integer'
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
            'id_beneficio' => 'ID Beneficio',
            'monto_minimo' => 'Monto Mímimo',
            'monto_maximo' => 'Monto Máximo'
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
