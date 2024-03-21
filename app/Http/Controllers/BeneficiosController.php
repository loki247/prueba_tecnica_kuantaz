<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use Illuminate\Http\Request;

class BeneficiosController extends Controller
{
    public function getBeneficiosAnhos(){
        return response()->json(Beneficio::getBeneficiosAnhos());
    }
}
