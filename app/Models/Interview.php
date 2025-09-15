<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Interview extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'saude_candidato',
    //     'vacina_covid',
    //     'perfil',
    //     'perfil_santa_casa',
    //     'classificacao',
    //     'qual_formadora', 
    //     'parecer_recrutador', 
    //     'curso_extracurricular', 
    //     'apresentacao_pessoal', 
    //     'experiencia_profissional', 
    //     'caracteristicas_positivas', 
    //     'habilidades', 
    //     'porque_ser_jovem_aprendiz', 
    //     'qual_motivo_demissao', 
    //     'pretencao_candidato', 
    //     'objetivo_longo_prazo', 
    //     'pontos_melhoria', 
    //     'familia', 
    //     'disponibilidade_horario', 
    //     'sobre_candidato', 
    //     'rotina_candidato', 
    //     'familia_cras',
    //     'outros_idiomas', 
    //     'fonte_curriculo',
    //     'sugestao_empresa', 
    //     'observacoes', 
    //     'pontuacao',                      
    //     'resume_id',
    //     'recruiter_id',
    //     'created_at',
    //     'obs_rh',
    //     'renda_familiar',
    //     'tipo_beneficio'
    // ];

    protected $guarded = [];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);            
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    
}
