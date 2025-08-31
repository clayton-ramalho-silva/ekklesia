<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PersonalInfoResume extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'reservista_outro' => 'array',
        'data_nascimento' => 'date'         
    ];

    // protected $fillable = [
    //     'nome', 'data_nascimento','estado_civil', 
    //     'possui_filhos', 'sexo', 'reservista', 
    //     'reservista_outro','cnh', 'rg', 'cpf','instagram', 
    //     'linkedin', 'tamanho_uniforme','created_at',
    //     'foto_candidato', 'foto_candidato_externa',
    //     'filhos_sim', 'sexo_outro', 'tipo_cnh', 'pcd', 'pcd_sim',
    //     'nacionalidade', 'filhos_qtd'
    // ];

    protected $guarded = [];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

   
}
