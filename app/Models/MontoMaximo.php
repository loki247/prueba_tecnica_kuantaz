<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MontoMaximo extends Model
{
    use HasFactory;
    protected $table = "prueba.montos_maximos";
    protected $primaryKey = "id";
}
