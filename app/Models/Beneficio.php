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
        $beneficios = Beneficio::select(
            DB::raw("EXTRACT('Year' FROM beneficios.fecha) AS year"),
            DB::raw("COUNT (beneficios.id) AS num"),
            DB::raw("SUM(beneficios_entregados.total) as monto_total"))
            ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
            ->groupBy(DB::raw("year"))
            ->orderBy("year", "ASC")->get();

        $beneficios = $beneficios->map(function ($value){
            $r = $value->toArray();

            $r['monto_total'] = "$" . number_format($r['monto_total'], 0, ",", ".");

            $r['beneficios'] = Beneficio::select(
                "beneficios.id",
                "beneficios.nombre",
                DB::raw("SUM(beneficios_entregados.total) as total"),
                "beneficios.fecha")
                ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
                ->where(DB::raw("EXTRACT('year' FROM beneficios.fecha)"), "=", $r['year'])
                ->groupBy("beneficios.id")->get();

                $r['beneficios'] = $r['beneficios']->map(function ($value2){
                    $r2 = $value2->toArray();

                    $r2['total'] = "$" . number_format($r2['total'], 0, ",", ".");

                    $fecha = Carbon::parse($r2['fecha']);

                    $r2['fecha'] = $fecha->format("d/m/Y");
                    $r2['mes'] = $fecha->locale("es")->isoFormat("MMMM");

                    return $r2;
                });

            return $r;
        });

        return $beneficios;
    }
}

