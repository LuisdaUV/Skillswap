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
        Schema::create('exchanges', function (Blueprint $table) {
        $table->id();
        // Usuario que envía (Tú)
        $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
        // Usuario que recibe (El compañero)
        $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
        // Habilidad que quieres aprender
        $table->foreignId('requested_skill_id')->constrained('skills')->onDelete('cascade');
        // Habilidad que ofreces a cambio
        $table->foreignId('offered_skill_id')->constrained('skills')->onDelete('cascade');
        // Estado del intercambio (pendiente, aceptado, rechazado)
        $table->string('status')->default('pendiente');
        $table->timestamps();
        $table->date('meet_date')->nullable(); // Guarda el día (AAAA-MM-DD)
        $table->time('meet_time')->nullable(); // Guarda la hora (HH:MM:SS)ñ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
