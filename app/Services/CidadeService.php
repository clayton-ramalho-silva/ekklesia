<?php

namespace App\Services;

use App\Models\ContactResume;

class CidadeService
{
    /**
     * Busca todas as cidades únicas dos contatos
     * 
     * @return \Illuminate\Support\Collection
     */
    public function getCidades()
    {        
        
        return ContactResume::whereNotNull('cidade')
            ->where('cidade', '!=', '')
            ->distinct()
            ->pluck('cidade')
            ->map(function($cidade){
                return $this->normalizarCidade($cidade);
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();
    }

    /**
     * Normaliza o nome de cidade
     * @param string|null $cidade
     * @return string|null
     */
    private function normalizarCidade($cidade)
    {
        if(!$cidade) return null;

        // Remove espaços extras e quebras de linha
        $cidade = trim($cidade);

        if (empty($cidade)) return null;

        // Separa por espaços
        $parts = explode(' ', $cidade);
        $normalized = [];

        foreach ($parts as $part) {
            $part = trim($part);
            if(!empty($part)){
                $normalized[] = ucfirst(strtolower($part));
            }            
        }

        return implode(' ', $normalized);

    }
}