<?php

namespace App\Http\Controllers;

use App\Validators\FichaValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ficha;

class FichaController extends Controller
{
    public function saveFicha(Request $request){
        $error = FichaValidator::validarSave($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $ficha = new \stdClass();
        $ficha->nombre = $request->nombre;
        $ficha->url = $request->url;

        DB::beginTransaction();
        try{
            Ficha::saveFicha($ficha);
            DB::commit();

            return response()->json(['msg' => 'Ficha Registrada']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }

    public function updateFicha(Request $request){
        $error = FichaValidator::validarUpdate($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        $ficha = new \stdClass();
        $ficha->id = $request->id;
        $ficha->nombre = $request->nombre;
        $ficha->url = $request->url;
        $ficha->publicada = $request->publicada;

        DB::beginTransaction();
        try{
            Ficha::updateFicha($ficha);
            DB::commit();

            return response()->json(['msg' => 'Ficha Actualizada']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }

    public function deleteFicha(Request $request){
        $error = FichaValidator::validarDelete($request->all());

        if($error) {
            return response()->json(['error' => $error], 400);
        }

        DB::beginTransaction();
        try{
            Ficha::deleteFicha($request->id);
            DB::commit();

            return response()->json(['msg' => 'Ficha Eliminada']);
        }catch (Exception $e){
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }
}
