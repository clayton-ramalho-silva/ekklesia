<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Resume extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'vagas_interesse' => 'array',
        'experiencia_profissional' => 'array'               
    ];

    protected $dates = ['data_nascimento'];

    // protected $fillable = [
    //     'vagas_interesse', 
    //     'experiencia_profissional','experiencia_profissional_outro', 
    //     'participou_selecao', 'participou_selecao_outro', 'foi_jovem_aprendiz', 
    //     'curriculo_doc', 'status','created_at', 'codigo_unico', 'curriculo_externo',
    //     'cras', 'fonte', 'autorizacao_uso_dados', 'autorizacao_responsavel_menor'
    // ];

    protected $guarded = [];

    // Relacionamento muitos para muitos com Job - Vagas que o candidato está associado.
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_resume', 'resume_id', 'job_id');            
            
    }

    public function informacoesPessoais()
    {
        return $this->hasOne(PersonalInfoResume::class);
    }

    public function escolaridade()
    {
        return $this->hasOne(AcademicInfoResume::class);
    }

    public function contato()
    {
        return $this->hasOne(ContactResume::class);
    }

   public function interview()
    {
        return $this->hasOne(Interview::class)->latestOfMany();
    }

    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

    public function observacoes()
    {
        return $this->hasMany(HistoryResume::class);
    }   


}
