<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;
use Carbon\Carbon;

class ResumeImportController extends Controller
{
    /** Curriculos com entrevistas. */
    public function importar($filename)
    {        
        //dd("Importar arquivo: {$filename}");
        $path = "imports/{$filename}";        
        
        if (!Storage::exists($path)) {
            return response()->json(['erro' => 'Arquivo não encontrado.'], 404);
        }

        $handle = Storage::readStream($path);
        if(!$handle) {
            return response()->json(['erro' => 'Erro ao abrir o arquivo.'], 500);
        }

        $linhas = LazyCollection::make(function () use ($handle)  {
            while (!feof($handle)) {
                $linha = fgets($handle);

                if ($linha !== false) {
                    yield $linha;
                }
            };
        });


        $importados = 0;
        $erros = [];

        foreach ($linhas as $index => $linha) {
            $item = json_decode($linha, true);

            if (!is_array($item)) {
                $erros[] = [
                    'linha' => $index + 1,                    
                    'erro' => 'JSON inválido ou linha em branco.' . $item['nome_do_candidato_'],
                ];
                continue;
            }            
            // Limpa e padroniza as chaves
            $item = $this->limparChaves($item);

            //dd($item);


            /************* Tratando dos dados CURRICULO */

            // Jovem aprendiz
            $ja_foi_jovem_aprendiz = trim($item['j_foi_jovem_aprendiz_']);
            $qual_formadora = null;
            if($ja_foi_jovem_aprendiz !== 'NÃO') {
                $qual_formadora = trim($item['se_afirmativo_qual_formadora']); // Pertence a entrevisata
            }
           
        
            // createad_at

            // $data_raw = trim($item['carimbo_de_datahora'] ?? '');
            // $created_at = null;

            // if (!empty($data_raw)) {
            //     try {
            //         // Converte de "02/04/25 14:24" → "2025-04-02 14:24:00"
            //         $created_at = \Carbon\Carbon::createFromFormat('d/m/y H:i', $data_raw)->format('Y-m-d H:i:s');
            //     } catch (\Exception $e) {
            //         //$this->warn("Data inválida: '{$data_raw}' - " . $e->getMessage());
            //     }
            // }

            $data_raw = trim($item['carimbo_de_datahora'] ?? '');
            $created_at = null;

            if (!empty($data_raw)) {
                $formatos = [
                    'n/j/Y G:i:s',    // 6/13/2025 10:17:53
                    'm/d/Y H:i:s',    // 06/13/2025 10:17:53
                    'n/j/Y G:i',      // 6/13/2025 10:17
                    'm/d/Y H:i',      // 06/13/2025 10:17
                ];
                
                foreach ($formatos as $formato) {
                    try {
                        $created_at = \Carbon\Carbon::createFromFormat($formato, $data_raw)->format('Y-m-d H:i:s');
                        break; // Se conseguiu converter, para o loop
                    } catch (\Exception $e) {
                        continue; // Tenta o próximo formato
                    }
                }
                
                if (!$created_at) {
                    //\Log::warning("Data inválida: '{$data_raw}' - Nenhum formato reconhecido");
                }
            }else{
                $created_at = Carbon::now()->format('Y-m-d H:i:s');
            }
           

            // "reservista" => "não se aplica"
            $reservista = trim($item['reservista']) ?? '';
            if($reservista !== 'Sim') {
                $reservista = 'Não';
            }

            $cpf_formatado = $this->formatarCPF($item['cpf'] ?? '');
            //$rg_formatado = $this->formatarRG($item['r_g'] ?? '');

            // Telefones
            $telefones_info = $this->reorganizarTelefones($item['telefone__'] ?? '');
            $tel_celular = $this->formatarTelefone($telefones_info['celular_candidato'] ?? '');
            $tel_residencial = $this->formatarTelefone($telefones_info['numero_recado'] ?? '');
            $obs_telefone = $telefones_info['obs'] ?? '';

                      

            $formacao = $this->organizarEscolaridade(trim($item['_escolaridade_']), trim($item['se_graduao_qual_curso']));

            $escolaridade = $formacao['escolaridade'];                     
            $escolaridade_outro = $formacao['escolaridade_outro'];


            

            // Data de nascimento segura
            $data_nascimento_raw = trim($item['data_nascimento'] ?? '');
            $data_nascimento = null;

            if (!empty($data_nascimento_raw)) {
                try {
                    // Converte "11/10/04" → "2004-10-11"
                    $data_nascimento = \Carbon\Carbon::createFromFormat('d/m/Y', $data_nascimento_raw)->format('Y-m-d');
                } catch (\Exception $e) {
                    //$this->warn("Data de nascimento inválida: '{$data_nascimento_raw}' - " . $e->getMessage());
                }
            }



             // convertendo para array vagas_interesse
            // $vagas_interesse = [];
            // if (!empty($item['em_quais_vagas_voc_est_interessado'])) {
            //     $vagas_interesse = array_map('trim', explode(',', $item['em_quais_vagas_voc_est_interessado']));
            // }
            // //$vagas_interesse = explode(', ', trim($row['vagas_interesse']));

            // $experiencia_profissional= [];
            // // convertendo para array experiencia
            // if (!empty($item['j_possui_alguma_experincia_profissional'])) {
            //     $experiencia_profissional = array_map('trim', explode(',', $item['j_possui_alguma_experincia_profissional']));    
            // }


             $status = trim($item['status']);
            if($status === 'ATIVO') {
                $status = 'ativo';
            } else if($status === 'INATIVO') {
                $status = 'inativo';
            } else if($status === 'EFETIVADO') {
                $status = 'contratado';
            } else {
                $status = 'ativo';
            }


            $cnh = trim($item['cnh']);
            if($cnh !== 'Sim') {
                $cnh = 'Não';
            } 

            // Genero
            $sexo = trim($item['sexo']);
            $sexo_outro = null;
            if($sexo === 'FEMININO'){
                $sexo = 'Mulher';
            } else if($sexo === 'MASCULINO') {
                $sexo = 'Homem';            
            } else {
                $sexo = 'Outro';
                $sexo_outro = $sexo; // Pertence a entrevisata
            }

            //$recruiter_id = intval($item['entrevistador']);


            // Tratamento do created_at da entrevista
            //$data_da_entrevista_raw = trim($item['_data_da_entrevista_'] ?? '');
            //$hora_da_entrevista_raw = trim($item['hora_da_entrevista'] ?? '');
            //$created_at_entrevista = null;

            // if (!empty($data_da_entrevista_raw)) {
            //     try {
            //         // Converte a data "24/04/25" para Carbon
            //         $data_carbon = Carbon::createFromFormat('d/m/y', $data_da_entrevista_raw);

            //         // Trata a hora
            //         if (is_numeric($hora_da_entrevista_raw)) {
            //             $hora_formatada = $this->excelFloatToTime((float) $hora_da_entrevista_raw);
            //         } elseif (preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', $hora_da_entrevista_raw)) {
            //             // Já está no formato "HH:mm" ou "HH:mm:ss"
            //             $hora_formatada = strlen($hora_da_entrevista_raw) === 5
            //                 ? $hora_da_entrevista_raw . ':00'
            //                 : $hora_da_entrevista_raw;
            //         } else {
            //             // Hora ausente ou inválida
            //             $hora_formatada = '00:00:00';
            //         }

            //         // Junta a data e a hora
            //         $created_at_entrevista = Carbon::createFromFormat('Y-m-d H:i:s', $data_carbon->format('Y-m-d') . ' ' . $hora_formatada);
            //     } catch (\Exception $e) {
            //         //$this->warn("Erro ao processar created_at da entrevista: {$data_da_entrevista_raw} {$hora_da_entrevista_raw} - " . $e->getMessage());
            //     }
            // }

            // Fammila cras

            $tipo_beneficio = $item['sua_famlia__atendida_no_cras'] ?? '';
            if($tipo_beneficio) {
                $familia_cras = 'Sim';
            } else {
                $familia_cras = 'Não';
            }

            // observações

            $observacao = $item['entrevistas']."\n";
            $observacao .= $item['observaes'] ?? 'N/A';



            /** Gravando ou Atualizando no banco */

            $resume = Resume::whereHas('informacoesPessoais', function ($query) use ($item){
                $query->where('nome', trim($item['nome_do_candidato_']));
            })->first();

            //dd($resume);

            if($resume){
               
                //dd($resume->interview);
                // Resume - Update
                
                
                $resume->update([
                    'foi_jovem_aprendiz' => $ja_foi_jovem_aprendiz,
                    'status' => $status,
                    'curriculo_externo' => $item['anexar_currculo'] ?? '',            
                    'created_at' => $created_at,
                    //'vagas_interesse' => $vagas_interesse ?? null,
                    //'experiencia_profissional' => $experiencia_profissional ?? null,                        
                    //'codigo_unico' => trim($item['cdigo_nico']) ?? '',        
                ]);

                $resume->informacoesPessoais()->update([
                    'nome' => trim($item['nome_do_candidato_']) ?? 'N/A',
                    'data_nascimento' =>  $data_nascimento,
                    'sexo' => $sexo,
                    'sexo_outro' =>  $sexo_outro,
                    //'rg' => $rg_formatado,
                    'cpf' => $cpf_formatado,
                    'reservista' => $reservista,
                    'foto_candidato_externa' => $item['foto'] ?? '',
                    'created_at' =>$created_at,
                    //'estado_civil' => $item['estado_civil'],
                    //'possui_filhos' => $item['possui_filhos'],
                    'cnh' => $cnh,
                    //'reservista_outro' => '',
                    //'instagram' => $data['instagram'],
                    //'linkedin' => $data['linkedin'],
                    //'tamanho_uniforme' => trim($row['tamanho_uniforme']) ?? 'N/A',
        
                ]);

                $resume->escolaridade()->update([
                    'informatica' => $this->organizarCurso($item['informtica_']),
                    'ingles' => $this->organizarCurso($item['ingls_']),
                    'escolaridade' => $escolaridade, // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
                    'escolaridade_outro' => $escolaridade_outro,                                                
                    'created_at' => $created_at,
        
                ]);
        
                $resume->contato()->update([
                    'telefone_residencial' => $tel_residencial, // Telefone de contato
                    'nome_contato' =>  $obs_telefone,
                    'telefone_celular' => $tel_celular,
                    'logradouro' => trim($item['endereo']) ?? '',
                    'bairro' => trim($item['bairro']) ?? '',
                    'cidade' => trim($item['cidade']) ?? '',
                    'created_at' => $created_at,
                    //'email' => $item['email'],
                    //'numero' => 'N/A',
                    //'complemento' => null,
                    //'uf' => 'N/A',
                    //'cep' => 'N/A',
        
                ]);

                //Interview - Update

                $resume->interview()->update(                
                    [
                        'saude_candidato' => trim($item['sade']),
                        'vacina_covid' => trim($item['vacina_covid']),
                        //'perfil' => trim($row['perfil'])  ?? 'N/A',
                        'perfil_santa_casa' => trim($item['santa_casa']) ?? '',
                        'classificacao'  => trim($item['classificao__']) ?? '',
                        'qual_formadora' => $qual_formadora, 
                        'parecer_recrutador' => trim($item['parecer_do_entrevistador']) ?? '', 
                        'curso_extracurricular' => trim($item['curso_extracurricular']) ?? '', 
                        'apresentacao_pessoal' => trim($item['apresentao_pessoal']) ?? '', 
                        'experiencia_profissional' => trim($item['experincia_profissional_tempo_de_empresamotivo_da_sada']) ?? '', 
                        'caracteristicas_positivas' => trim($item['caractersticas_positivas']) ?? '', 
                        'habilidades' => trim($item['habilidades']) ?? '', 
                        'porque_ser_jovem_aprendiz' => trim($item['por_que_gostaria_de_ser_jovem_aprendiz_']) ?? '', 
                        'qual_motivo_demissao' => trim($item['por_qual_motivo_voc_pediria_demisso']), 
                        'pretencao_candidato' => trim($item['pretenes_do_candidato_']) ?? '', 
                        'objetivo_longo_prazo' => trim($item['pretenes_do_candidato_']) ?? '', 
                        'pontos_melhoria' => trim($item['pontos_de_melhoria']) ?? '', 
                        'familia' => trim($item['familia']) ?? '', 
                        'disponibilidade_horario' => trim($item['disponibilidade_de_horrio']) ?? '', 
                        'sobre_candidato' => trim($item['fale_um_pouco_mais_sobre_voc']) ?? '', 
                        'rotina_candidato' => trim($item['qual_a_sua_rotina']) ?? '', 
                        'familia_cras' => $familia_cras,
                        'outros_idiomas' => $item['outros_idiomas'] ?? '', 
                        'fonte_curriculo' => $item['fonte_de_captao_do_currculo__'],
                        'renda_familiar' => $item['qual_a_renda_familiar_da_sua_casa_'] ?? '',
                        'tipo_beneficio' => $tipo_beneficio,
                        'sugestao_empresa' => $item['sugesto__empresas_'] ?? '', 
                        'observacoes' => $observacao  ?? 'N/A', 
                        //'pontuacao' => $item['santa_casa'],                      
                        'resume_id' => $resume->id,
                        'recruiter_id' => $this->buscarIDRecrutador($item['entrevistador']), 
                        'created_at' => $created_at,
                    ]
                );
            } else  {
                //dd($resume);

                // Resume - Create
                
                $resume = Resume::create([
                    'foi_jovem_aprendiz' => $ja_foi_jovem_aprendiz,
                    'status' => $status,
                    'curriculo_externo' => $item['anexar_currculo'] ?? '',            
                    'created_at' => $created_at,
                    //'vagas_interesse' => $vagas_interesse ?? null,
                    //'experiencia_profissional' => $experiencia_profissional ?? null,                        
                    //'cdigo_nico' => trim($item['cdigo_nico']) ?? '',        
                ]);

                $resume->informacoesPessoais()->create([
                    'nome' => trim($item['nome_do_candidato_']) ?? 'N/A',
                    'data_nascimento' =>  $data_nascimento,
                    'sexo' => $sexo,
                    'sexo_outro' =>  $sexo_outro,
                    //'rg' => $rg_formatado,
                    'cpf' => $cpf_formatado,
                    'reservista' => $reservista,
                    'foto_candidato_externa' => $item['foto'] ?? '',
                    'created_at' =>$created_at,
                    //'estado_civil' => $item['estado_civil'],
                    //'possui_filhos' => $item['possui_filhos'],
                    'cnh' => $cnh,
                    //'reservista_outro' => '',
                    //'instagram' => $data['instagram'],
                    //'linkedin' => $data['linkedin'],
                    //'tamanho_uniforme' => trim($row['tamanho_uniforme']) ?? 'N/A',
        
                ]);

                $resume->escolaridade()->create([
                    'informatica' => $this->organizarCurso($item['informtica_']),
                    'ingles' => $this->organizarCurso($item['ingls_']),
                    'escolaridade' => $escolaridade, // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
                    'escolaridade_outro' => $escolaridade_outro,                                                
                    'created_at' => $created_at,
        
                ]);
        
                $resume->contato()->create([
                    'telefone_residencial' => $tel_residencial, // Telefone de contato
                    'nome_contato' =>  $obs_telefone,
                    'telefone_celular' => $tel_celular,
                    'logradouro' => trim($item['endereo']) ?? '',
                    'bairro' => trim($item['bairro']) ?? '',
                    'cidade' => trim($item['cidade']) ?? '',
                    'created_at' => $created_at,
                    //'email' => $item['email'],
                    //'numero' => 'N/A',
                    //'complemento' => null,
                    //'uf' => 'N/A',
                    //'cep' => 'N/A',
        
                ]);

                //Interview - Create

                $resume->interview()->create(                
                    [
                        'saude_candidato' => trim($item['sade']),
                        'vacina_covid' => trim($item['vacina_covid']),
                        //'perfil' => trim($row['perfil'])  ?? 'N/A',
                        'perfil_santa_casa' => trim($item['santa_casa']) ?? '',
                        'classificacao'  => trim($item['classificao__']) ?? '',
                        'qual_formadora' => $qual_formadora, 
                        'parecer_recrutador' => trim($item['parecer_do_entrevistador']) ?? '', 
                        'curso_extracurricular' => trim($item['curso_extracurricular']) ?? '', 
                        'apresentacao_pessoal' => trim($item['apresentao_pessoal']) ?? '', 
                        'experiencia_profissional' => trim($item['experincia_profissional_tempo_de_empresamotivo_da_sada']) ?? '', 
                        'caracteristicas_positivas' => trim($item['caractersticas_positivas']) ?? '', 
                        'habilidades' => trim($item['habilidades']) ?? '', 
                        'porque_ser_jovem_aprendiz' => trim($item['por_que_gostaria_de_ser_jovem_aprendiz_']) ?? '', 
                        'qual_motivo_demissao' => trim($item['por_qual_motivo_voc_pediria_demisso']), 
                        'pretencao_candidato' => trim($item['pretenes_do_candidato_']) ?? '', 
                        'objetivo_longo_prazo' => trim($item['pretenes_do_candidato_']) ?? '', 
                        'pontos_melhoria' => trim($item['pontos_de_melhoria']) ?? '', 
                        'familia' => trim($item['familia']) ?? '', 
                        'disponibilidade_horario' => trim($item['disponibilidade_de_horrio']) ?? '', 
                        'sobre_candidato' => trim($item['fale_um_pouco_mais_sobre_voc']) ?? '', 
                        'rotina_candidato' => trim($item['qual_a_sua_rotina']) ?? '', 
                        'familia_cras' => $familia_cras,
                        'outros_idiomas' => $item['outros_idiomas'] ?? '', 
                        'fonte_curriculo' => $item['fonte_de_captao_do_currculo__'],
                        'renda_familiar' => $item['qual_a_renda_familiar_da_sua_casa_'] ?? '',
                        'tipo_beneficio' => $tipo_beneficio,
                        'sugestao_empresa' => $item['sugesto__empresas_'] ?? '', 
                        'observacoes' => $observacao  ?? 'N/A', 
                        //'pontuacao' => $item['santa_casa'],                      
                        'resume_id' => $resume->id,
                        'recruiter_id' => $this->buscarIDRecrutador($item['entrevistador']), 
                        'created_at' => $created_at,
                    ]
                );



            }

             

            

            $importados++;
        }

        fclose($handle);

        return response()->json([
            'mensagem' => 'Importação concluída.',
            'importados' => $importados,
            'falhas' => $erros,
        ]);

        //dd($item);

    }


     // 🔧 Função para limpar e padronizar chaves
    private function limparChaves(array $registro): array
    {
        $limpo = [];
        foreach ($registro as $chave => $valor) {
            $novaChave = preg_replace('/[^a-zA-Z0-9_ ]/', '', $chave); // remove : (dois-pontos), acentos etc.
            $novaChave = str_replace(' ', '_', $novaChave); // espaço para _
            $novaChave = strtolower($novaChave); // opcional: todas minúsculas
            $limpo[$novaChave] = $valor;
        }
        return $limpo;
    }

    // Organiza os telefones
    private function reorganizarTelefones($telefones) {
        // Remove os espaços e normaliza a string
        $telefones = trim(preg_replace('/\s+/', ' ', $telefones));

        // Regex para capturar números de telefone em vários formatos:
        // (XX) XXXX-XXXX, XX XXXX-XXXX, XXXXXXXXXX, (XX) XXXXX-XXXX, etc.
        $phoneRegex = '/(?:\(?\d{2}\)?[\s\-\.]*\d{4,5}[\s\-\.]*\d{4})/';

        // Encontra todos os números de telefones
        preg_match_all($phoneRegex, $telefones, $matches);
        $phones = $matches[0];

        // Remove os números de telefone para extrair as observações restantes
        $obs = trim(preg_replace($phoneRegex, '', $telefones));

        // Limpa a observação (remove caracteres desnecessários no início/fim)
        $obs = preg_replace('/^[\s\/\:\,]+|[\s\/\:\,]+$/', '', $obs);
        $obs = preg_replace('/\s+/', ' ', $obs); // Normaliza espaços

        // Formata os números de telefone
        $celular_candidato = isset($phones[0]) ? $this->formatarTelefone($phones[0]) : '';
        $numero_recado = isset($phones[1]) ? $this->formatarTelefone($phones[1]) : '';

        return [
            'celular_candidato' => $celular_candidato,
            'numero_recado' => $numero_recado,
            'obs' => $obs
        ];
    }

    // private function formatarTelefone($phone) {
    //     // Remove tudo que não for dígito
    //     $phone = preg_replace('/[^\d]/', '', $phone);
        
    //     // Formata como (XX) XXXXX-XXXX (celular) ou (XX) XXXX-XXXX (fixo)
    //     if (strlen($phone) === 11) {
    //         return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $phone);
    //     } elseif (strlen($phone) === 10) {
    //         return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
    //     }
        
    //     return $phone; // Retorna sem formatação se não for 10 ou 11 dígitos
    // }

    private function organizarEscolaridade($escolaridade, $curso)
    {
        
        // Escolaridade
        $escolaridade;
        $escolaridade_outro = null;

        
        //$lista_escolaridade = ['Ensino médio completo', 'Ensino médio cursando', 'Ensino técnico completo', 'Ensino técnico cursando', 'Graduação completa', 'Graduação cursando', 'Outro', 'Tecnologo cursando'];
        
        switch($escolaridade) {
            case ('Ensino médio completo'):
                $escolaridade = array('Ensino Médio Completo');
                break;
            case ('Ensino técnico completo'):
                $escolaridade = array('Ensino Técnico Completo');
                break;
            case ('Graduação completa'):
                $escolaridade = array('Superior Completo');
                break;
            case ('Ensino médio cursando'):
                $escolaridade = array('Ensino Médio Cursando');                
                break;
            case ('Ensino técnico cursando'):
                $escolaridade = array('Ensino Técnico Cursando');                
                break;
            case ('Graduação cursando'):
                $escolaridade = array('Superior Cursando');                
                break;
            case ('Outro'):
                $escolaridade = array('Outro');                
                break;
            default:
                $escolaridade = array('Outro');
                $escolaridade_outro = $curso;
                break;
        };

        return [
            'escolaridade' => $escolaridade,            
            'escolaridade_outro' =>  $escolaridade_outro,
        ];

    }

    private function formatarCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) !== 11) return null;

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }

    private function formatarRG($rg)
    {
        $rg = preg_replace('/[^0-9]/', '', $rg);
        if (strlen($rg) < 7 || strlen($rg) > 9) return null;

        return preg_replace('/(\d{1,2})(\d{3})(\d{3})(\d?)/', '$1.$2.$3-$4', str_pad($rg, 9, '0', STR_PAD_LEFT));
    }

    private function formatarTelefone($telefone)
    {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);

        // Sem DDD (8 ou 9 dígitos)
        if (strlen($telefone) === 8) {
            return preg_replace('/(\d{4})(\d{4})/', '$1-$2', $telefone);
        }

        if (strlen($telefone) === 9) {
            return preg_replace('/(\d{5})(\d{4})/', '$1-$2', $telefone);
        }

        // Com DDD fixo
        if (strlen($telefone) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
        }

        // Com DDD celular
        if (strlen($telefone) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
        }

        // Qualquer outro caso
        return $telefone;
    }

    private function excelFloatToTime($excelFloat)
    {
        $totalSegundos = round($excelFloat * 86400); // 86400 segundos em 1 dia
        $horas = floor($totalSegundos / 3600);
        $minutos = floor(($totalSegundos % 3600) / 60);
        $segundos = $totalSegundos % 60;

        return sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
    }

    private function organizarCurso($curso)
    {
        $curso = trim($curso);
        switch ($curso){
            case 'BÁSICO':
                return 'Básico';
            case 'INTERMEDIÁRIO':
                return 'Intermediário';
            case 'AVANÇADO':
                return 'Avançado';
            case 'NENHUM':
                return 'Nenhum';
            default:
                return '';
        }
    }

    private function buscarIDRecrutador($nome)
    {
        $nome = strtoupper(trim($nome));
        switch ($nome) {
            case 'caroline':
                $id = 18;
                break;
            case 'marina':
                $id = 36;
                break;
            case 'danielle':
                $id = 35;
                break;
            case 'marcel':
                $id = 34;
                break;
            case 'tânia':
                $id = 28;
                break;
            case 'surya':
                $id = 27;
                break;
            case 'mônica':
                $id = 24;
                break;
            case 'marina':
                $id = 22;
                break;
            case 'hevelyn':
                $id = 20;
                break;
            case 'luciana':
                $id = 13;
                break;
            case 'fernanda':
                $id = 12;
                break;
            case 'nayara':
                $id = 11;
                break;

            default:
                $id = 18; // Recrutador não encontrado
        }

        return $id;
    }

   

}
