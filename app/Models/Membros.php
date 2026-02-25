<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membros extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'estado_civil',
        'possui_filhos',
        'filhos_qtd',
        'filhos_idade',
        'sexo',
        'cep',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'email',
        'telefone_celular',
        'telefone_residencial',
        'nome_contato',
        'instagram',
        'data_conversao',
        'data_batismo',
        'data_membresia',        
        'foto_membro',
        'status_membro',
        'observacao',
    ];

    // === RELACIONAMENTOS ===

    /**
     * Ministérios onde este membro é LÍDER
     */
    public function ministeriosLiderados()
    {
        return $this->belongsToMany(
            Ministerio::class,
            'lider_ministerios',
            'membro_id',
            'ministerio_id'
        )->withTimestamps()
          ->withPivot('data_inicio', 'data_fim');
    }

    /**
     * Ministérios onde este membro é PARTICIPANTE
     */
    public function ministeriosParticipados()
    {
        return $this->belongsToMany(
            Ministerio::class,
            'membro_ministerios',
            'membro_id',
            'ministerio_id'
        )->withTimestamps()
          ->withPivot('data_entrada', 'data_saida');
    }

    /**
     * Todos os ministérios deste membro (como líder ou participante)
     */
    public function todosMinisterios()
    {
        return $this->ministeriosLiderados->merge($this->ministeriosParticipados)->unique('id');
    }

}
