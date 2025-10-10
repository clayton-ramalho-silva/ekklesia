<?php

use App\Models\Company;
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('setor'); // representa a área texto livre
            $table->string('cargo');  // representa o setor select          
            $table->string('cbo');
            $table->text('descricao')->nullable();
            $table->enum('genero', ['Masculino', 'Feminino', 'Indiferente']);
            $table->integer('qtd_vagas');
            $table->unsignedBigInteger('filled_positions')->default(0);
            $table->string('cidade');
            $table->string('uf');
            $table->decimal('salario', 10, 2);
            $table->string('dias_semana');
            $table->string('horario');
            $table->text('beneficios')->nullable(); // Requisitos/Diferenciais
            $table->string('exp_profissional'); // Benefícios
            $table->enum('informatica', ['Não', 'Básico', 'Intermediário', 'Avançado']);
            $table->enum('ingles', ['Não', 'Básico', 'Intermediário', 'Avançado']);     
            $table->date('data_inicio_contratacao')->nullable();      
            $table->date('data_fim_contratacao')->nullable();
            $table->enum('status',['aberta', 'fechada', 'espera', 'cancelada']);           
            $table->foreignIdFor(Company::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
