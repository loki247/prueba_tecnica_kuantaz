<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Beneficio extends Model
{
    use HasFactory;
    protected $table = "prueba.beneficios";
    protected $primaryKey = "id";

    public static function getBeneficiosAnhos(){
        $beneficios = Beneficio::select(
            DB::raw("EXTRACT('Year' FROM beneficios.fecha) AS year"),
            DB::raw("COUNT (beneficios.id) AS num"),
            DB::raw("SUM(montos_maximos.monto_maximo) as monto_total"))
            ->leftJoin("prueba.montos_maximos", "beneficios.id", "=", "montos_maximos.id_beneficio")
            ->groupBy(DB::raw("EXTRACT('Year' FROM beneficios.fecha)"))->get();

        return collect($beneficios);
    }
}

