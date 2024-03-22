<?php

namespace App\Http\Controllers;

use App\Models\MontoMaximo;
use App\Validators\MontoMaximoValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MontosMaximosController extends Controller
{
    public function saveMontoMaximo(Request $request){
        $error = MontoMaximoValidator::validarSave($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $montoMaximo = new \stdClass();
        $montoMaximo->id_beneficio = $request->id_beneficio;
        $montoMaximo->monto_minimo = $request->monto_minimo;
        $montoMaximo->monto_maximo = $request->monto_maximo;

        DB::beginTransaction();
        try{
            MontoMaximo::saveMontoMaximo($montoMaximo);
            DB::commit();

            return response()->json(['msg' => 'Monto Máximo Registrado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }

    public function updateMontoMaximo(Request $request){
        $error = MontoMaximoValidator::validarUpdate($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $montoMaximo = new \stdClass();
        $montoMaximo->id = $request->id;
        $montoMaximo->id_beneficio = $request->id_beneficio;
        $montoMaximo->monto_minimo = $request->monto_minimo;
        $montoMaximo->monto_maximo = $request->monto_maximo;

        DB::beginTransaction();
        try{
            MontoMaximo::updateMontoMaximo($montoMaximo);
            DB::commit();

            return response()->json(['msg' => 'Monto Máximo Actualizado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }
}
