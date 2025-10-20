<?php
namespace App\Services;

use App\Models\Job;
use App\Models\Resume;
use Illuminate\Http\UploadedFile;

class ResumeService 
{
    public function updateResume(array $data, Resume $resume): Resume
    {
        // Salvando foto do candidato no banco e movendo arquivo para pasta.
            $foto_candidato_atual = $resume->informacoesPessoais->foto_candidato;
            
            if(isset($data['foto_candidato']) && $data['foto_candidato'] instanceof UploadedFile){
                $file = $data['foto_candidato'];

                $extension = $file->getClientOriginalExtension();

                $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

                $file->move(public_path('documents/resumes/fotos'), $fileName);

                $data['foto_candidato'] = $fileName;

                if($foto_candidato_atual){
                    unlink(public_path('documents/resumes/fotos/'. $foto_candidato_atual));
                }
            } else {
                $data['foto_candidato'] = $foto_candidato_atual;
            }

        // Salvando curriculo no banco e movendo arquivo para pasta.
        $curriculo_atual = $resume->curriculo_doc;
         
         if(isset($data['curriculo_doc']) && $data['curriculo_doc'] instanceof UploadedFile){
            $file = $data['curriculo_doc'];

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/resumes/curriculos'), $fileName);

            $data['curriculo_doc'] = $fileName;

            if($curriculo_atual){
                unlink(public_path('documents/resumes/curriculos/'. $curriculo_atual));
            }
        } else {
            $data['curriculo_doc'] = $curriculo_atual;
        }


        $resume->update([
            'vagas_interesse' => $data['vagas_interesse'] ?? '',
            'experiencia_profissional' => $data['experiencia_profissional'] ?? '',
            'experiencia_profissional_outro' => $data['experiencia_profissional_outro'] ?? '',
            'participou_selecao' => '', // cliente pediu para retirar
            'participou_selecao_outro' => '', // cliente pediu para retirar
            'foi_jovem_aprendiz' => $data['foi_jovem_aprendiz'] ?? '',
            'curriculo_doc' => $data['curriculo_doc'] ?? '',
            'cras' => $data['cras'] ?? '',
            'fonte' => $data['fonte'] ?? '',

        ]);

        $resume->informacoesPessoais()->update([
            'nome' => $data['nome'] ?? '',
            'data_nascimento' => $data['data_nascimento'] ?? '',
            'estado_civil' => $data['estado_civil'] ?? '',
            'possui_filhos' => $data['possui_filhos'] ?? '',
            'filhos_sim' => $data['filhos_sim'] ?? '', // idades
            'filhos_qtd' => $data['filhos_qtd'] ?? '',
            'sexo' => $data['sexo'] ?? '',
            'sexo_outro' => $data['sexo_outro'] ?? '',
            'reservista' => $data['reservista'] ?? '',
            'reservista_outro' => '',
            'cnh' => $data['cnh'] ?? '',
            'tipo_cnh' => $data['tipo_cnh'] ?? '',
            'rg' => $data['rg'] ?? '',
            'cpf' => $data['cpf'] ?? '',
            'instagram' => $data['instagram'] ?? '',
            'linkedin' => $data['linkedin'] ?? '',
            //'tamanho_uniforme' => $data['tamanho_uniforme'],
            'foto_candidato' => $data['foto_candidato'] ?? '',
            'pcd' => $data['pcd'] ?? '',
            'pcd_sim' => $data['pcd_sim'] ?? '',
            'nacionalidade' => $data['nacionalidade'] ?? '',

        ]);

        $resume->escolaridade()->update([
            'escolaridade' => $data['escolaridade'] ?? '', // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
            'escolaridade_outro' => $data['escolaridade_outro'] ?? '', // Qual curso Outro
            'semestre' => $data['semestre'] ?? '', // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
            'instituicao' => $data['instituicao'] ?? '', // Quando Outro
            'outro_periodo' => $data['outro_periodo'] ?? '', //Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.
            'informatica' => $data['informatica'] ?? '',
            'obs_informatica' => $data['obs_informatica'] ?? '',
            'ingles' => $data['ingles'] ?? '',
            'obs_ingles' => $data['obs_ingles'] ?? '',
            'fundamental_periodo' => $data['fundamental_periodo'] ?? '',
            'fundamental_modalidade' => $data['fundamental_modalidade'] ?? '',
            'medio_periodo' => $data['medio_periodo'] ?? '',
            'medio_modalidade' => $data['medio_modalidade'] ?? '',
            'tecnico_periodo' => $data['tecnico_periodo'] ?? '',
            'tecnico_modalidade' => $data['tecnico_modalidade'] ?? '',
            'tecnico_curso' => $data['tecnico_curso'] ?? '',
            'superior_curso' => $data['superior_curso'] ?? '', // Curso
            'superior_instituicao' => $data['superior_instituicao'] ?? '',
            'superior_semestre' => $data['superior_semestre'] ?? '', // Modalidade
            'superior_periodo' => $data['superior_periodo'] ?? '', // Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.

        ]);

        $resume->contato()->update([
            'email' => $data['email'] ?? '',
            'telefone_residencial' => $data['telefone_residencial'] ?? '', //Telefone contato
            'nome_contato' => $data['nome_contato'] ?? '',
            'telefone_celular' => $data['telefone_celular'] ?? '',
            'logradouro' => $data['logradouro'] ?? '',
            'numero' => $data['numero'] ?? '',
            'complemento' => $data['complemento'] ?? '',
            'bairro' => $data['bairro'] ?? '',
            'cidade' => $data['cidade'] ?? '',
            'uf' => $data['uf'] ?? '',
            'cep' => $data['cep'] ?? '',

        ]);

        return $resume;
    }

    public function associarVaga(Resume $resume, Job $job)
    {
        
        if($resume->jobs()->exists()){
            return redirect()->back()->with('danger', 'Candidato já está associado a uma vaga!');
        }
        
        
        if(!$job->data_inicio_contratacao){
            return redirect()->back()->with('danger', 'Processo de contratação ainda não foi iniciado!');    
        }
        
        
        $job->resumes()->attach($resume->id);
        //dd($resume->jobs()->exists());

        // Confirma se agora está associado
        if ($resume->jobs()->where('jobs.id', $job->id)->exists()) {
            // Aqui você pode mudar o status ou fazer outras ações
            $resume->status = 'processo'; // exemplo
            $resume->save();
        }

        return $resume;

    }

    /**
     * Função para desassociar o currriculo de todas as vagas atraves
     * da relação jobs()
     */
    public function desassociarVagas(Resume $resume)
    {

        // Verifica se o resume possui alguma associação
        if(!$resume->jobs()->exists()){
            return redirect()->back()->with('danger', 'Currículo não está associado a nenhuma vaga!');
        }

        // Desassocia o candidato de todas as vagas.
        $resume->jobs()->detach();

        return $resume;

    }
}
