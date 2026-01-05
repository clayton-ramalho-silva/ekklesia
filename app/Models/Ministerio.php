<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ministerio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'igreja_id',
        'lider_id',
        'nome',
        'slug',
        'descricao',
    ];

    /**
     * Conversões de tipo.
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Relação com a Igreja.
     */
    public function igreja()
    {
        return $this->belongsTo(Igreja::class);
    }

    /**
     * Relação com o Líder (Membro).
     */    
    public function lider()
    {
        return $this->belongsTo(Membro::class, 'lider_id');
    }

    /**
     * Membros participantes deste ministério (relacionamento N:N via pivot).
     */
    public function membros()
    {
        return $this->belongsToMany(
            Membro::class,
            'membro_ministerio', // tabela pivot
            'ministerio_id',
            'membro_id'
        )
        ->withPivot('cargo', 'data_inicio', 'data_fim', 'status')
        ->withTimestamps();
    }

     /*
    |--------------------------------------------------------------------------
    | Acessors & Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope: apenas ministérios ativos (não excluídos logicamente).
     */
    public function scopeAtivos($query)
    {
        return $query->whereNull('deleted_at');
    }

    /**
     * Scope: filtrar por igreja.
     */
    public function scopeDaIgreja($query, $igrejaId)
    {
        return $query->where('igreja_id', $igrejaId);
    }

    /**
     * Acessor: exibe nome do líder, se existir.
     */
    public function getLiderNomeAttribute()
    {
        return $this->lider?->nome ?? '— Sem líder';
    }


}
