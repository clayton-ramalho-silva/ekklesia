<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'departamento',        
        'descricao'
    ];

   public function lideres()
    {
        return $this->belongsToMany(
            Membros::class,
            'lider_ministerios',
            'ministerio_id',
            'membro_id'
        )
        ->withPivot('data_inicio', 'data_fim')
        ->withTimestamps();
    }

    public function lideresAtivos()
    {
        return $this->lideres()->whereNull('lider_ministerios.data_fim');
    }


    public function participantes()
    {
       return $this->belongsToMany(
            Membros::class,
            'membro_ministerios',
            'ministerio_id',
            'membro_id'
        )
        ->withTimestamps()
          ->withPivot('data_entrada', 'data_saida');
    }

    // ✅ Substitua por:
    public function getTodosMembrosAttribute()
    {
        return $this->lideres->merge($this->participantes)->unique('id');
    }
   
}
