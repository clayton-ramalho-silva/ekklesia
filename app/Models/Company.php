<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'logotipo',
        'status',
        'observacao',
    ];

    protected $casts = [
        'logotipo' => 'string'
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function location()
    {
        return $this->hasOne(LocationCompany::class);
    }

    public function contacts()
    {
        return $this->hasOne(ContactCompany::class);
    }

    
}
