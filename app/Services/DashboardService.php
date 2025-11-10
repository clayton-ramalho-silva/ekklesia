<?php
namespace App\Services;

use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use App\Models\User;



class DashboardService
{  

    private function obterCurriculos()
    {
        return Resume::with(['informacoesPessoais', 'contato', 'escolaridade', 'interview']);
    }

    public function obterTotalVagas()
    {
        $totalVagas = Job::select('qtd_vagas')->sum('qtd_vagas');        
        return $totalVagas;
    }


    public function obterTotalVagasPreenchidas()
    {        
        $totalVagasPreenchidas = Job::select('filled_positions')->sum('filled_positions');
        return $totalVagasPreenchidas;
    }


    public function obterTotalVagasAbertas()
    {        
        $totalVagasAbertas = Job::where('status', 'aberta')->sum('status');
        return $totalVagasAbertas;
    }

    public function obterTotalVagasFechadas()
    {
        $totalVagasFechadas = Job::where('status', 'fechada')->sum('status');
        return $totalVagasFechadas;
    }

    public function obterToralEmpresasAtivas()
    {
        $totalEmpresasAtivas = Company::where('status', 'ativo')->count();
        return $totalEmpresasAtivas;
    }

    public function obterTotalEmpresasInativas()
    {
        $totalEmpresasInativas = Company::where('status', 'inativo')->count();
        return $totalEmpresasInativas;
    }

    /**
     * Filtros: idade entre 18 e 23 anos, ativos,
     */ 
    public function obterTotalCurriculosAtivos()
    {
        $query = $this->obterCurriculos();        
        //17440
        //dd($query->count());
      
        
       // Filtro Idade
       $query->whereHas('informacoesPessoais', function ($q) {
            $q->whereNotNull('data_nascimento')
                ->where('data_nascimento', '<=', now()->subYears(18)->toDateString())
                ->where('data_nascimento', '>=', now()->subYears(22)->subMonths(8)->toDateString());
            // $q->whereIn('reservista', ['Sim', 'Em andamento']);
        });


        $query->where('status', 'ativo');   
        //dd($query->count());  
       
      

        $curriculosAtivos = $query->count();

        
        return $curriculosAtivos;        
    }

     /**
     * Filtros: idade entre 18 e 23 anos, inativos,
     */ 
    public function obterTotalCurriculosInativos()
    {
        $query = $this->obterCurriculos();        
        //17440
        //dd($query->count());
      
        
       // Filtro Idade
       $query->whereHas('informacoesPessoais', function ($q) {
            $q->whereNotNull('data_nascimento')
                ->where('data_nascimento', '<=', now()->subYears(18)->toDateString())
                ->where('data_nascimento', '>=', now()->subYears(23)->toDateString());
            // $q->whereIn('reservista', ['Sim', 'Em andamento']);
        });


        $query->where('status', 'inativo');   
        //dd($query->count());  
       
      

        $curriculosInativos = $query->count();

        
        return $curriculosInativos;        
    }

    /**
     * Obter curriculos com status de 'processo'
     * 
     */
    public function obterTotalCurriculosProcesso()
    {
        $query = $this->obterCurriculos();

        $query->where('status', 'processo');

        $totalCurriculosProcesso = $query->count();

        return $totalCurriculosProcesso;
    }



}