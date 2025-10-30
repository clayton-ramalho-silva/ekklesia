<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Resume;
use App\Models\Interview;
use Illuminate\Support\Facades\DB;

class DeleteResumesFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resumes:delete-from-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete resumes and their associations from a JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonPath = storage_path('app/imports/deletar-resumes.json');
        
        if (!file_exists($jsonPath)) {
            $this->error("Arquivo não encontrado: {$jsonPath}");
            return Command::FAILURE;
        }

        $jsonContent = file_get_contents($jsonPath);
        $resumesData = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Erro ao decodificar o JSON: ' . json_last_error_msg());
            return Command::FAILURE;
        }

        if (empty($resumesData)) {
            $this->error('O arquivo JSON está vazio ou possui estrutura inválida.');
            return Command::FAILURE;
        }

        $resumeIds = array_column($resumesData, 'resume_id');
        
        $this->info("Encontrados " . count($resumeIds) . " resumes para deletar.");
        $this->info("IDs: " . implode(', ', $resumeIds));

        if (!$this->confirm('Tem certeza que deseja deletar estes resumes e todas as suas associações?')) {
            $this->info('Operação cancelada.');
            return Command::SUCCESS;
        }

        $deletedCount = 0;

        try {
            DB::transaction(function () use ($resumeIds, &$deletedCount) {
                foreach ($resumeIds as $resumeId) {
                    $resume = Resume::find($resumeId);
                    
                    if (!$resume) {
                        $this->warn("Resume ID {$resumeId} não encontrado. Pulando...");
                        continue;
                    }

                    // Excluindo arquivo fisico curriculo
                    if($resume->foto_candidato){
                        $foto_candidato_path = public_path('documents/resumes/fotos/'. $resume->informacoesPessoais->foto_candidato);
                        if(file_exists($foto_candidato_path)){
                            unlink($foto_candidato_path);
                        }
                    }

                    // Excluindo arquivo fisico curriculo
                    if($resume->curriculo_doc){
                        $curriculo_path = public_path('documents/resumes/curriculos/'. $resume->curriculo_doc);
                        if(file_exists($curriculo_path)){
                            unlink($curriculo_path);
                        }
                    }

                    // Deleta as associações
                    $resume->jobs()->detach();
                    $resume->informacoesPessoais()->delete();
                    $resume->escolaridade()->delete();
                    $resume->contato()->delete();
                    
                    // Deleta TODAS as entrevistas usando o modelo Interview diretamente
                    $interviewCount = Interview::where('resume_id', $resumeId)->delete();
                    $this->info("{$interviewCount} entrevista(s) deletada(s) para o Resume ID {$resumeId}");
                    
                    $resume->selections()->delete();
                    $resume->observacoes()->delete();

                    // Deleta o resume
                    $resume->delete();
                    
                    $deletedCount++;
                    $this->info("Resume ID {$resumeId} e todas as suas associações deletados com sucesso.");
                }
            });

            $this->info("\nOperação concluída! {$deletedCount} resumes foram deletados.");

        } catch (\Exception $e) {
            $this->error("Erro durante a deleção: " . $e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}