<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontoMaximo extends Model
{
    use HasFactory;
    protected $table = "prueba.montos_maximos";
    protected $primaryKey = "id";

    public static function saveMontoMaximo($data){
        $montoMaximo = new MontoMaximo();
        $montoMaximo->id_beneficio = $data->id_beneficio;
        $montoMaximo->monto_minimo = !is_null($data->monto_minimo) ? $data->monto_minimo : 0;
        $montoMaximo->monto_maximo = $data->monto_maximo;

        $montoMaximo->save();
    }

    public static function updateMontoMaximo($data){
        $montoMaximo = MontoMaximo::find($data->id);
        $montoMaximo->id_beneficio = $data->id_beneficio;
        $montoMaximo->monto_minimo = !is_null($data->monto_minimo) ? $data->monto_minimo : 0;
        $montoMaximo->monto_maximo = $data->monto_maximo;

        $montoMaximo->save();
    }

    public static function getMontoMinMax($idBeneficio){
        $montoMinMax = MontoMaximo::select("monto_minimo", "monto_maximo")
            ->where("id_beneficio", $idBeneficio)->first();

        return $montoMinMax;
    }
}
