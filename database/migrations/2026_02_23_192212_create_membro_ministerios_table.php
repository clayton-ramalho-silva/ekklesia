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
        Schema::create('membro_ministerios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membro_id')->constrained()->onDelete('cascade');
            $table->foreignId('ministerio_id')->constrained()->onDelete('cascade');
            $table->date('data_entrada')->nullable();
            $table->date('data_saida')->nullable();
            $table->timestamps();

            // Permite múltiplas entradas (ex: saiu e voltou), mas evita duplicata ativa
            $table->index(['membro_id', 'ministerio_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membro_ministerios');
    }
};
