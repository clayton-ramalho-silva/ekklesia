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
        Schema::create('lider_ministerios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membro_id')->constrained()->onDelete('cascade');
            $table->foreignId('ministerio_id')->constrained()->onDelete('cascade');
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->timestamps();

            $table->unique(['membro_id', 'ministerio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lider_ministerios');
    }
};
