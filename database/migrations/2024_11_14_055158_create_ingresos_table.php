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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proveedor');
            $table->string('comprobante', 20);
            $table->string('num_comprobante', 10);
            $table->dateTime('fecha_hora');
            $table->decimal('impuesto');
            $table->string('estatus', 20);

            $table->timestamps();

            $table->foreign('id_proveedor')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
