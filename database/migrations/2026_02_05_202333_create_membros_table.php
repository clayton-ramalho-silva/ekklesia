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
            $table->string('nome');
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('possui_filhos')->nullable();
            $table->string('filhos_qtd')->nullable();
            $table->string('filhos_idade')->nullable();
            $table->string('sexo')->nullable();

            $table->string('cep');
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone_celular')->nullable();
            $table->string('telefone_residencial')->nullable();
            $table->string('nome_contato')->nullable();
            $table->string('instagram')->nullable();

            $table->date('data_conversao')->nullable();
            $table->date('data_batismo')->nullable();
            $table->date('data_membresia')->nullable();
            $table->string('status_membro')->nullable();
            $table->longText('observacao')->nullable();            
            
            $table->text('foto_membro')->nullable();
            $table->timestamps();
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
