<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'igreja_id', 'nome', 'apelido', 'data_nascimento', 'sexo', 'estado_civil',
        'cpf', 'rg', 'titulo_eleitor', 'telefone', 'email', 'whatsapp_ativo',
        'endereco', 'bairro', 'cidade', 'uf', 'cep',
        'data_conversao', 'data_batismo', 'data_entrada_igreja',
        'status', 'observacoes', 'foto_url',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_conversao' => 'date',
        'data_batismo' => 'date',
        'data_entrada_igreja' => 'date',
        'whatsapp_ativo' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    // Relacionamentos
    public function igreja()
    {
        return $this->belongsTo(Igreja::class);
    }
}
