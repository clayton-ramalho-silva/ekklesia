<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContactCompany extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'telefone',
        'ramal',
        'email',
        'nome_contato',
        'whatsapp'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
