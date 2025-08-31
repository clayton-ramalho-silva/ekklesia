<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AcademicInfoResume extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'escolaridade', // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
    //     'informatica', 
    //     'obs_informatica',
    //     'ingles',
    //     'obs_ingles',
    //     'created_at',
    //     'fundamental_periodo',
    //     'fundamental_modalidade',
    //     'medio_periodo',
    //     'medio_modalidade',
    //     'tecnico_periodo',
    //     'tecnico_modalidade',
    //     'tecnico_curso',
    //     'superior_curso',
    //     'superior_instituicao',
    //     'superior_periodo', // Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.
    //     'superior_semestre', // Superior Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
    //     'escolaridade_outro', // Qual curso? Quando for Outro
    //     'instituicao', // Quando for Superior Incompleto ou Outro. 
    //     'semestre', // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
    //     'outro_periodo',
    //     'escolaridade_outro'
    // ];
    protected $guarded = [];

    protected $casts = [
        'escolaridade' => 'array',                     
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    // public function getEscolaridadeArrayAttribute()
    // {
    //     if(empty($this->escolaridade)){
    //         return [];
    //     }

    //     if (is_string($this->escolaridade)){
    //         return json_decode($this->escolaridade, true) ? : [$this->escolaridade];
    //     }

    //     return (array) $this->escolaridade;
    // }
}
