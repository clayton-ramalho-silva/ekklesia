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
        Schema::create('ministerios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('igreja_id')->constrained('igrejas')->onDelete('cascade');
            $table->foreignId('lider_id')->constrained('membros')->onDelete('cascade');
            $table->string('nome');
            $table->string('slug')->unique();
            $table->text('descricao')->nullable();
            $table->softDeletes();
            $table->timestamps();
             // Índices
            $table->index('igreja_id');
            $table->index('lider_id');
            $table->index('nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ministerios');
    }
};
