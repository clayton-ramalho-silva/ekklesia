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
        Schema::table('academic_info_resumes', function (Blueprint $table) {
            $table->string('tecnico_semestre')->nullable();
            $table->string('tecnico_instituicao')->nullable();
            $table->string('tecnico_completo_curso')->nullable();
            $table->string('tecnico_completo_instituicao')->nullable();
            $table->string('tecnico_completo_data_conclusao')->nullable();
            $table->string('superior_termo')->nullable();
            $table->string('superior_completo_curso')->nullable();
            $table->string('superior_completo_instituicao')->nullable();
            $table->string('superior_completo_data_conclusao')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academic_info_resumes', function (Blueprint $table) {
            $table->dropColumn('tecnico_semestre');
            $table->dropColumn('tecnico_instituicao');
            $table->dropColumn('tecnico_completo_curso');
            $table->dropColumn('tecnico_completo_instituicao');
            $table->dropColumn('tecnico_completo_data_conclusao');
            $table->dropColumn('superior_termo');
            $table->dropColumn('superior_completo_curso');
            $table->dropColumn('superior_completo_instituicao');
            $table->dropColumn('superior_completo_data_conclusao');

        });
    }
};
