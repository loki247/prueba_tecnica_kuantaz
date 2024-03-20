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
        Schema::create('prueba.beneficios', function (Blueprint $table) {
            $table->increments("id");
            $table->string('nombre');
            $table->integer('id_ficha');
            $table->timestamp('fecha');
            $table->timestamps();
        });

        Schema::create('prueba.ficha', function (Blueprint $table) {
            $table->increments("id");
            $table->string('nombre');
            $table->text('url');
            $table->boolean('publicada')->default(true);
            $table->timestamps();
        });

        Schema::create('prueba.beneficios_entregados', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('id_beneficio');
            $table->string('run', 8);
            $table->string('dv', 1);
            $table->integer('total');
            $table->string('estado');
            $table->timestamp('fecha');
            $table->timestamps();
        });

        Schema::create('prueba.montos_maximos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('id_beneficio');
            $table->integer('monto_minimo')->default(0);
            $table->integer('monto_maximo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prueba.montos_maximos');
        Schema::dropIfExists('prueba.beneficios_entregados');
        Schema::dropIfExists('prueba.ficha');
        Schema::dropIfExists('prueba.beneficios');
    }
};
