<?php

namespace App\Models;

use Carbon\Carbon;
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
        $b = Beneficio::select(
            DB::raw("EXTRACT('Year' FROM beneficios.fecha) AS year"),
            DB::raw("COUNT (beneficios.id) AS num"),
            DB::raw("SUM(beneficios_entregados.total) as monto_total"))
            ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
            ->groupBy(DB::raw("year"))
            ->orderBy("year", "ASC")->get();

        $beneficios = $b->map(function ($value){
            $r = $value->toArray();

            /*
             SELECT
                beneficios.id,
                beneficios.nombre,
                beneficios.fecha,
                SUM(beneficios_entregados.total) as total
                FROM prueba.beneficios
                LEFT JOIN prueba.beneficios_entregados ON beneficios.id = beneficios_entregados.id_beneficio
                WHERE EXTRACT('year' FROM beneficios.fecha) = 2024
                GROUP BY beneficios.id
             */

            $r['beneficios'] = Beneficio::select(
                "beneficios.id",
                "beneficios.nombre",
                DB::raw("SUM(beneficios_entregados.total) as total"),
                "beneficios.fecha")
                ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
                ->where(DB::raw("EXTRACT('year' FROM beneficios.fecha)"), "=", $r['year'])
                ->groupBy("beneficios.id")->get();

                $r2 = $r['beneficios']->map(function ($value2){
                    $r3 = $value2->toArray();

                    $fecha = $r3['fecha'];

                    $r3['fecha'] = Carbon::parse($fecha)->format("d/m/Y");
                    $r3['mes'] = Carbon::parse($fecha)->format("M");

                    return $r3;
                });

            return $r2;
        });

        return $beneficios;
    }
}

