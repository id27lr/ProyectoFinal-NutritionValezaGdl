<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER tr_ingresostock
            AFTER INSERT ON detalle_ingresos
            FOR EACH ROW
            BEGIN
                UPDATE productos 
                SET stock = stock + NEW.cantidad
                WHERE id = NEW.id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS tr_ingresostock;");
    }
};
