<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Validators\BeneficioValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeneficiosController extends Controller
{
    public function getBeneficiosRun($run){
        return response()->json(Beneficio::getBeneficiosRun($run));
    }

    public function saveBeneficio(Request $request){
        $error = BeneficioValidator::validarSave($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $beneficio = new \stdClass();
        $beneficio->nombre = $request->nombre;
        $beneficio->id_ficha = $request->id_ficha;
        $beneficio->fecha = $request->fecha;

        DB::beginTransaction();
        try{
            Beneficio::saveBeneficio($beneficio);
            DB::commit();

            return response()->json(['msg' => 'Beneficio Registrado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }

    public function updateBeneficio(Request $request){
        $error = BeneficioValidator::validarUpdate($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $beneficio = new \stdClass();
        $beneficio->id = $request->id;
        $beneficio->nombre = $request->nombre;
        $beneficio->id_ficha = $request->id_ficha;
        $beneficio->fecha = $request->fecha;

        DB::beginTransaction();
        try{
            Beneficio::updateBeneficio($beneficio);
            DB::commit();

            return response()->json(['msg' => 'Beneficio Actualizado']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }
}
