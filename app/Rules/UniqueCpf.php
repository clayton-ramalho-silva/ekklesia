<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueCpf implements Rule
{
    protected $table;
    protected $ignoreId;

    public function __construct($table, $ignoreId = null)
    {
        $this->table = $table;
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value)
    {
        // Remove formatação do CPF informado
        $cleanCpf = preg_replace('/[^0-9]/', '', $value);
        
        // Adiciona formatação
        $formattedCpf = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cleanCpf);
        
        // Verifica se existe nos dois formatos
        $query = DB::table($this->table)
            ->whereNull('deleted_at') // Ignora registros soft deleted
            ->where(function($q) use ($cleanCpf, $formattedCpf) {
                $q->where('cpf', $cleanCpf)
                ->orWhere('cpf', $formattedCpf);
            });
            
        // Ignora o registro atual em updates
        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }
        
        return $query->count() === 0;
    }

    public function message()
    {
        return 'Este CPF já está cadastrado.';
    }
}