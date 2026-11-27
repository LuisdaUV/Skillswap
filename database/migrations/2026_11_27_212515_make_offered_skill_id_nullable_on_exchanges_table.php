<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->unsignedBigInteger('offered_skill_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (DB::table('exchanges')->whereNull('offered_skill_id')->exists()) {
            throw new \RuntimeException(
                'Hay sesiones sin habilidad ofrecida. No se puede revertir esta migración.'
            );
        }

        Schema::table('exchanges', function (Blueprint $table) {
            $table->unsignedBigInteger('offered_skill_id')->nullable(false)->change();
        });
    }
};