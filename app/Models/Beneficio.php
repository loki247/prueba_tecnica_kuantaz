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
            DB::raw("SUM(beneficios_entregados.total) as monto_total"))
            ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
            ->groupBy(DB::raw("year"))
            ->orderBy("year", "ASC")->get();

        return collect($beneficios);
    }
}

