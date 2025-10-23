<?php

namespace App\Services;

use App\Models\Job;
use Carbon\Carbon;

class JobService
{

    // Inicia contratação
    public function startContraction($jobId): void
    {
        $job = Job::findOrFail($jobId);
        
        $job->update([
            'data_inicio_contratacao' => Carbon::now(),
        ]);
    }

    // Fim contratação
    public function endContraction($jobId): void
    {
        $job = Job::findOrFail($jobId);

        $job->update([
            'data_fim_contratacao' => Carbon::now(),
            'status' => 'fechada'
        ]);
    }

    private function authorizeJobAction(Job $job): void
    {
        // Se futuramente precisar restaurar a autorização
        // if(!$job->isEditableBy(Auth::user())) {
        //     throw new \Exception('Sem permissão para esta ação');
        // }
    }

}