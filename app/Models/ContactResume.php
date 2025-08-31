<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactResume extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'email', 'telefone_residencial', 'nome_contato','telefone_celular', 
    //     'logradouro', 'numero', 'complemento', 
    //     'bairro', 'cidade', 'uf', 'cep', 'created_at'
    // ];

    protected $guarded = [];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
