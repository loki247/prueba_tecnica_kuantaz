<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;
    protected $table = "prueba.ficha";
    protected $primaryKey = "id";

    public static function saveFicha($data){
        $ficha = new Ficha();
        $ficha->nombre = $data->nombre;
        $ficha->url = $data->url;

        $ficha->save();
    }

    public static function updateFicha($data){
        $ficha = Ficha::find($data->id);
        $ficha->nombre = $data->nombre;
        $ficha->url = $data->url;
        $ficha->publicada = $data->publicada;

        $ficha->save();
    }

    public static function getFicha($idBeneficio){
        $ficha = Ficha::select(
            "ficha.id",
            "ficha.nombre",
            "ficha.url",
            "ficha.publicada")
            ->leftjoin("prueba.beneficios", "ficha.id", "=", "beneficios.id_ficha")
            ->where("beneficios.id", $idBeneficio)
            ->where("ficha.publicada", true)->first();

        return $ficha;
    }
}
