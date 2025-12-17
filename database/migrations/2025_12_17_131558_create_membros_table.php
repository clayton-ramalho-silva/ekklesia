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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('igreja_id')->constrained('igrejas')->onDelete('cascade');
            $table->string('nome');
            $table->string('apelido')->nullable();

            $table->date('data_nascimento')->nullable();
            $table->enum('sexo', ['M', 'F', 'O'])->nullable()->comment('M=Masculino, F=Feminino, O=Outro');
            $table->string('estado_civil')->nullable()->comment('solteiro, casado, viúvo, divorciado');

            $table->string('cpf', 14)->nullable()->unique();
            $table->string('rg', 20)->nullable();
            $table->string('titulo_eleitor', 20)->nullable();

            $table->string('telefone', 20)->nullable();
            $table->string('email')->nullable()->unique();
            $table->boolean('whatsapp_ativo')->default(false);

            $table->text('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->char('uf', 2)->nullable();
            $table->string('cep', 10)->nullable();

            $table->date('data_conversao')->nullable();
            $table->date('data_batismo')->nullable();
            $table->date('data_entrada_igreja')->nullable();

            $table->enum('status', [
                'ativo',
                'inativo',
                'visitante',
                'transferido',
                'falecido',
            ])->default('ativo');

            $table->text('observacoes')->nullable();
            $table->string('foto_url')->nullable();

            $table->timestamps();
            $table->softDeletes(); // opcional, mas recomendado para auditoria

            // Índices para melhor performance em buscas
            $table->index('igreja_id');
            $table->index('cpf');
            $table->index('email');
            $table->index('telefone');
            $table->index('status');
            $table->index('data_entrada_igreja');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membros');
    }
};
