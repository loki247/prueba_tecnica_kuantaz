<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("prueba.beneficios", function (Blueprint $table) {
            $table->foreign("id_ficha")->references("id")->on("prueba.ficha")->onDelete("RESTRICT")->onUpdate("CASCADE");
        });

        Schema::table("prueba.beneficios_entregados", function (Blueprint $table) {
            $table->foreign("id_beneficio")->references("id")->on("prueba.beneficios")->onDelete("RESTRICT")->onUpdate("CASCADE");
        });

        Schema::table("prueba.montos_maximos", function (Blueprint $table) {
            $table->foreign("id_beneficio")->references("id")->on("prueba.beneficios")->onDelete("RESTRICT")->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
    }
};
