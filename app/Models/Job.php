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
        'setor', // campo área no formulário, texto livre 
        'cargo', // campo setor no formulário, select
        'cbo', 'descricao', 'genero',
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
        return $this->belongsToMany(Resume::class, 'job_resume', 'job_id', 'resume_id')
            ->withTimestamps();

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

    // Exibir o CBO completo a partir do código
    public function exibirCBO()
    {
        switch ($this->cbo) {
            case '4110-10':
                return '4110-10 / Assistente Administrativo';
            case '4122-05':
                return '4122-05 / Contínuo';
            case '4211-25':
                return '4211-25 / Operador de Caixa';
            case '4221-05':
                return '4221-05 / Recepcionista Geral';
            case '5133-15':
                return '5133-15 / Camareiro de Hotel';
            case '5134-05':
                return '5134-05 / Garçom';
            case '5134-25':
                return '5134-15 / Cumim';
            case '4211-25':
                return '5134-25 / Copeiro';
            case '5134-35':
                return '5134-35 / Atendente de lanchonete';
            case '5135-05':
                return '5135-05 / Aux. nos Serviços de Alimentação';
            case '5142-25':
                return '5142-25 / Trabalhador de serviços de limpeza e conservação';
            case '5143-25':
                return '5143-25 / Trabalhador na Manutenção de Edificações';
            case '5211-25':
                return '5211-25 / Repositor de Mercadorias';
            case '5211-35':
                return '5211-35 / Frentista';
            case '5211-40':
                return '5211-40 / Atendente de lojas e mercados';
            default:
                return $this->cbo; // Retorna o código original se não encontrar
        }
    }

}
