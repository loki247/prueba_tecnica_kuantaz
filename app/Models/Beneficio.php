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

    public static function saveBeneficio($data){
        $beneficio = new Beneficio();
        $beneficio->nombre = $data->nombre;
        $beneficio->id_ficha = $data->id_ficha;
        $beneficio->fecha = $data->fecha;

        $beneficio->save();
    }

    public static function updateBeneficio($data){
        $beneficio = Beneficio::find($data->id);
        $beneficio->nombre = $data->nombre;
        $beneficio->id_ficha = $data->id_ficha;
        $beneficio->fecha = $data->fecha;

        $beneficio->save();
    }

    public static function getBeneficiosRun($run){
        $beneficios = Beneficio::select(
            DB::raw("EXTRACT('Year' FROM beneficios.fecha) AS year"),
            DB::raw("COUNT (beneficios.id) AS num"),
            DB::raw("SUM(beneficios_entregados.total) as monto_total"))
            ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
            ->where("beneficios_entregados.run", $run)
            ->groupBy(DB::raw("year"))
            ->orderBy("year", "ASC")->get();

        $beneficios = $beneficios->map(function ($value) use ($run){
            $r = $value->toArray();

            $r['monto_total'] = "$" . number_format($r['monto_total'], 0, ",", ".");

            $r['beneficios'] = Beneficio::select(
                "beneficios.id",
                "beneficios.nombre",
                "beneficios_entregados.total",
                "beneficios.fecha")
                ->leftJoin("prueba.beneficios_entregados", "beneficios.id", "=", "beneficios_entregados.id_beneficio")
                ->where(DB::raw("EXTRACT('year' FROM beneficios.fecha)"), $r['year'])
                ->where("beneficios_entregados.run", $run)->get();

                $r['beneficios'] = $r['beneficios']->map(function ($value2){
                    $r2 = $value2->toArray();

                    $montosMinMAx = MontoMaximo::getMontoMinMax($r2['id']);
                    $total = $r2['total'];

                    $r2['total'] = "$" . number_format($total, 0, ",", ".");

                    $fecha = Carbon::parse($r2['fecha']);

                    $r2['fecha'] = $fecha->format("d/m/Y");
                    $r2['mes'] = $fecha->locale("es")->isoFormat("MMMM");

                    $ficha = Ficha::getFicha($r2['id']);

                    if (!is_null($ficha)){
                        $r2['ficha'] = $ficha;
                    }

                    if ($total >= $montosMinMAx['monto_minimo'] && $total <= $montosMinMAx['monto_maximo']){
                        return $r2;
                    }
                });

            return $r;
        });

        return $beneficios;
    }
}

