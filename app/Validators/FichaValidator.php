<?php

namespace App\Validators;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class FichaValidator{
    public static function validarSave($data){
        $rules = [
            'nombre' => 'required',
            'url' => 'required'
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
            'url' => 'URL'
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
            'url' => 'required'
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
            'url' => 'URL'
        ];

        $validateData = Validator::make($data, $rules, $customMsg);

        $validateData->setAttributeNames($atributos);

        if ($validateData->fails()) {
            return $validateData->errors();
        } else {
            return false;
        }
    }

    public static function validarDelete($data){
        $rules = [
            'id' => 'required|integer'
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
            'id' => 'ID'
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
