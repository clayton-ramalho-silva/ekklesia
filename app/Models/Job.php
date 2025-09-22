<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'data_inicio_contratacao' => 'date',
        'data_fim_contratacao' => 'date',
        'data_entrevista_empresa' => 'date',
    ];

    protected $fillable = [
        'setor', 'cargo', 'cbo', 'descricao', 'genero',
        'qtd_vagas','filled_positions', 'cidade', 'uf',
        'salario', 'dias_semana', 'horario', 'beneficios',
        'exp_profissional', 'informatica', 'ingles', 'data_inicio_contratacao',
        'data_fim_contratacao', 'status', 'company_id', 'dias_curso', 'data_entrevista_empresa'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function updateStatus()
    {
        if($this->filled_positions >= $this->qtd_vagas){
            $this->status = 'fechada';
        }elseif($this->filled_positions < $this->qtd_vagas && $this->status == 'fechada'){
            $this->status = 'aberta';
        }

        $this->save();
    }

    public function recruiters()
    {
        return $this->belongsToMany(User::class, 'job_recruiter', 'job_id', 'recruiter_id');
    }

    // Relacionamento muitos para muitos com Resume
    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'job_resume', 'job_id', 'resume_id');

    }


    // Acessar para exibir o salario formatado
    public function getSalarioFormattedAttribute()
    {
        return number_format($this->salario, 2, ',', '.'); // Exibe no formato brasileiro
    }

    // Mutator para garantir que o valor do salário é salvo corretamente
    public function setSalarioAttribute($value)
    {
        $this->attributes['salario'] = (float) str_replace(array('.',','), array('','.'), $value);
    }


    // Histórico de observações da vaga
    public function observacoes()
    {
        return $this->hasMany(HistoryJob::class);
    }

    // Relacioanmento um para muitos com Selection
    public function selections()
    {
        return $this->hasMany(Selection::class);
    }

    // Verifica se o usuário é Admin ou recrutador associado a vaga
    public function isEditableBy(User $user)
    {
        return $user->role === 'admin' || $this->recruiters->contains($user->id);
    }

    protected static function booted()
    {
        static::deleting(function ($job){
            // Se for soft delete
            if (!$job->isForceDeleting()){
                // Soft delete dos filhos diretos
                $job->selections()->delete();
                $job->observacoes()->delete();

                // Remover relacionamentos many-to-many
                $job->resumes()->detach();
                $job->recruiters()->detach();
            }
        });
    }

    public function resumesWithoutSelection()
    {
        return $this->resumes()->whereDoesntHave('selections', function($query){
            $query->where('job_id', $this->id);
        });
    }

}
