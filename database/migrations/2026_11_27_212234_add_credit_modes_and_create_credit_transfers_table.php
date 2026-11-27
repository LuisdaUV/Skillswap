<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->string('mode', 20)->default('directo');
        });

        Schema::create('credit_transfers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exchange_id')->nullable()->unique()
                ->constrained('exchanges')->nullOnDelete();

            $table->foreignId('payer_id')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->foreignId('recipient_id')->nullable()
                ->constrained('users')->nullOnDelete();

            $table->unsignedInteger('amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_transfers');

        Schema::table('exchanges', function (Blueprint $table) {
            $table->dropColumn('mode');
        });
    }
};