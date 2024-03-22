<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validators\UsuarioValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function saveUser(Request $request){
        $error = UsuarioValidator::validarSave($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $usuario = new \stdClass();
        $usuario->run = $request->run;
        $usuario->dv = $request->dv;
        $usuario->nombres = $request->nombres;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email = $request->email;
        $usuario->password = $request->password;

        DB::beginTransaction();
        try{
            User::saveUser($usuario);
            DB::commit();

            return response()->json(['msg' => 'Usuario Registrado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }

    public function updateUser(Request $request){
        $error = UsuarioValidator::validarUpdate($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $usuario = new \stdClass();
        $usuario->id = $request->id;
        $usuario->run = $request->run;
        $usuario->dv = $request->dv;
        $usuario->nombres = $request->nombres;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email = $request->email;
        $usuario->password = $request->password;

        DB::beginTransaction();
        try{
            User::updateUser($usuario);
            DB::commit();

            return response()->json(['msg' => 'Usuario Actualizado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }
}
