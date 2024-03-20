<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficioEntregado extends Model
{
    use HasFactory;
    protected $table = "prueba.beneficios_entregados";
    protected $primaryKey = "id";
}
