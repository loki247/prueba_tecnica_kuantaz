<?php

namespace App\Validators;

use App\Models\Beneficio;
use App\Models\MontoMaximo;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsuarioValidator{
    public static function validarSave($data){
        $rules = [
            'run' => function ($attribute, $value, $fail) use($data){
                if(empty($value)){
                    $fail("El campo <strong>RUN</strong> es requerido");
                }

                $checkRun = User::select("run")->where("run", "=", $value)->first();

                if(!empty($checkRun)){
                    $fail("El RUN ya se encuentra registrado");
                }
            },
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'email' => function ($attribute, $value, $fail) use($data){
                if(empty($value)){
                    $fail("El campo <strong>RUN</strong> es requerido");
                }

                $checkEmail = User::select("email")->where("email", "=", $value)->first();

                if(!empty($checkEmail)){
                    $fail("El Email ya se encuentra registrado");
                }
            },
            'password' => 'required'
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
            'run' => 'RUN',
            'nombres' => 'Nombres',
            'apellido_paterno' => 'Apellido Paterno',
            'email' => 'Email',
            'password' => 'Password'
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
            'run' => 'required',
            'nombres' => 'required',
            'apellido_paterno' => 'required',
            'email' => 'required|email',
            'password' => 'required'
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
            'run' => 'RUN',
            'nombres' => 'Nombres',
            'apellido_paterno' => 'Apellido Paterno',
            'email' => 'Email',
            'password' => 'Password'
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
