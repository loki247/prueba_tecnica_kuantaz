<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ficha;

class FichaController extends Controller
{
    public function saveFicha(Request $request){
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
}
