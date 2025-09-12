<?php

namespace App\Http\Controllers;

use App\Http\Requests\Interview\StoreInterviewRequest;
use App\Http\Requests\Interview\UpdateInterviewRequest;
use App\Http\Requests\Resume\UpdateResumeRequest;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;
use App\Services\ResumeService;
use App\Services\CidadeService;


class InterviewController extends Controller
{
    use LogsActivity;

    protected $cidadeService;

    public function __construct(CidadeService $cidadeService)
    {
        $this->cidadeService = $cidadeService;
    }

    public function index(Request $request)
    {

        // Busca entrevistas filtrado por admin e recrutador

        /*
         $user = Auth::user();
 
         if ( $user->role === 'admin'){
             $interviews = Interview::with(['resume.jobs'])->get();            
         } else {
             $interviews = Interview::with(['resume.jobs'])
             ->whereHas('resume.jobs.recruiters', function($query) use ($user){
                 $query->where('recruiter_id', $user->id);
             })
             ->get();            
         }    
          
         */

        // Busca todas as entrevistas
        //$query = Resume::with(['informacoesPessoais', 'contato', 'interview', 'escolaridade']);
        // $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])->whereHas('interview');

        // Abaixo de 23 anos.
        $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])
            ->whereHas('interview')
            ->whereHas('informacoesPessoais', function ($q) {
                $q->whereNotNull('data_nascimento')
                ->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) < 23');
            });

        //$query = Resume::query();

        


        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }


         // Filtro por nome - Busca pelo nome do candidato
         if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });

            //dd($request->nome);
        }


        
        // Filtro Status
        // if ($request->filled('status') && $request->status !== "Todos") {
        //     if ($request->status === "ativo" || $request->status === "inativo") {
        //         $query->where('status', $request->status);
        //     } else {
        //         $query->whereHas('selections', function($q) use ($request) {
        //             $q->where('status_selecao', $request->status);
        //         });
        //     }
        // }

        if ($request->filled('status') && $request->status !== "Todos") {            
                $query->where('status', $request->status);            
        }
        
        
        // if($request->filled('status')){           
        //    $query->where('status', $request->status);            
        // }     
      
       
         // Filtro Candidato entrevistado/nao entrevistado/ todos
        //  if(request()->has('entrevistado')){
        //     if (request()->entrevistado == '1'){
        //         $query->whereHas('interview'); // Apenas candidatos que já foram entrevistados
        //     } elseif (request()->entrevistado == '0'){
        //         $query->whereDoesntHave('interview'); // Apenas candidatos que ainda não foram entrevistados
        //     }
        // }

         // Filtro gênero
        if ($request->filled('sexo') && $request->sexo !== "Todos"){
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('sexo', $request->sexo);
            });
        }        

        // Filtro CNH
        if ($request->filled('cnh') && $request->cnh !== "Todos") {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('cnh', $request->cnh);
            });
        }

        // Filtro Idade
        if ($request->filled('min_age')) {
            $query->whereHas('informacoesPessoais', function ($q) use ($request) {
                $q->whereNotNull('data_nascimento')
                  ->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) >= ?', [$request->min_age]);
            });
        }

        // Filtro Reservista
        if ($request->filled('reservista') && $request->reservista !== "Todos") {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('reservista', $request->reservista);
            });
        }

        //Filtro Já foi jovem aprendiz
        if ($request->filled('foi_jovem_aprendiz') && $request->foi_jovem_aprendiz !== "Todos") {
            $query->where('foi_jovem_aprendiz', $request->foi_jovem_aprendiz);
        }

        // Filtro Informatica
        if ($request->filled('informatica') && $request->informatica !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->where('informatica', $request->informatica);
            });
        }

        // Filtro Informatica
        if ($request->filled('ingles') && $request->ingles !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->where('ingles', $request->ingles);
            });
        }

        // Filtro Formação/Escolaridade
        if ($request->filled('escolaridade') && $request->escolaridade !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->whereJsonContains('escolaridade', $request->escolaridade);
            });
        }   
        //  if ($request->filled('escolaridade') && $request->escolaridade !== "Todos") {
        //     $query->whereHas('escolaridade', function($q) use ($request) {
        //         $q->where('escolaridade', $request->escolaridade);
        //     });
        // }

        // Filtro Vagas Interesse
        if ($request->filled('vagas_interesse')) {
            foreach ($request->vagas_interesse as $vaga) {
                $query->whereJsonContains('resumes.vagas_interesse', $vaga);
            }
        }

        // Filtro Experiência Profissional
        if ($request->filled('experiencia_profissional')) {
            foreach ($request->experiencia_profissional as $exp) {
                $query->whereJsonContains('resumes.experiencia_profissional', $exp);
            }
        }

        // Filtro Cidade
        if ($request->filled('cidade') && $request->cidade !== "Todas") {
            $query->whereHas('contato', function($q) use ($request) {
                $q->where('cidade', 'like', '%'. $request->cidade . '%');
            });
        }

        // Filtro Telefone Celular

        //dd($request->celular);
        if ($request->filled('celular') && strlen($request->celular) >= 4) {
            $ultimosDigitos = substr($request->celular, -4);
            
            $query->whereHas('contato', function($q) use ($ultimosDigitos) {
                $q->where('telefone_celular', 'like', '%' . $ultimosDigitos);
            });
        }
        
        // Filtro Filtro data Resumes

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }

         // Filtro por Data de Cadastro Curriculo (minima)
        if($request->filled('data_min')){
            $query->whereDate('created_at', '>=', $request->data_min);
        }

        if($request->filled('data_max')){
            $query->whereDate('created_at', '<=', $request->data_max);
        }

       //Controller - Filtro PCD
        if ($request->filled('pcd') && $request->pcd !== "Todos") {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                if ($request->pcd === 'Não') {
                    // Se escolheu "Não", excluir os que têm "Sim, com laudo." e "Sim, sem laudo."
                    // Inclui registros com "Não", null, vazio ou outros valores
                    $q->where(function($subQuery) {
                        $subQuery->whereNotIn('pcd', ['Sim, com laudo.', 'Sim, sem laudo.'])
                                ->orWhereNull('pcd')
                                ->orWhere('pcd', '');
                    });
                } else {
                    // Para outras opções, mantém o comportamento original
                    $q->where('pcd', $request->pcd);
                }
            });
        }

        //Filtro Já foi jovem aprendiz
        if ($request->filled('cras') && $request->cras !== "cras") {
            $query->where('cras', $request->cras);
        }
        

        //$interviews = Interview::all();

        // $query->with([
        //     'informacoesPessoais',
        //     'contato',
        //     'interview',
        //     'escolaridade'
        // ]);

        //NOVA FUNCIONALIDADE: Filtro de Ordenação
        $ordem = $request->get('ordem', 'desc'); // Por padrão será 'desc' (mais recente primeiro)
        
        // Validar se a ordem é válida
        if (!in_array($ordem, ['asc', 'desc'])) {
            $ordem = 'desc';
        }

        $query->join('interviews', 'resumes.id', '=', 'interviews.resume_id')
          ->orderBy('interviews.created_at', $ordem)
          ->select('resumes.*');

        $resumes = $query->paginate(50)->appends($request->all());
        // Implementar paginação
        //$resumes = $query->paginate(50); // Ajustar o numero coforme necessário.


        $cidades = $this->cidadeService->getCidades();
        

        return view('interviews.index', compact('resumes', 'form_busca', 'ordem', 'cidades'));    
    }

    public function show($id)
    {
        
        $interview = Interview::findOrFail($id);
        $resume = Resume::findOrFail($interview->resume->id);
        $user = Auth::user();

         $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');

        $jobAprovado = '';
        if( $temSelecaoAprovada ) {
            $selection = $resume->selections->where('status_selecao', 'aprovado')->first();
            $jobAprovado = $selection->job;
        }


        // Obtém vagas com empresas associadas conforme o usuario e status 'aberta'
        
        // $jobsQuery = Job::where('status', 'aberta');

        // if ($user->role !== 'admin') {
        //     $jobsQuery->whereHas('recruiters', function ($query) use ($user){
        //         $query->where('recruiter_id', $user->id);
        //     });
        // }

        // $jobs = $jobsQuery->get();
        $jobs = Job::where('status', 'aberta')->get();

        $jobsAssociados = $resume->jobs;

            
        

        // Vagas associadas ao recrutador
       
        /*
        if($user->role == 'admin'){
            // Administrador vê todas as vagas com empresas associadas
            $jobs = Job::with('company')->get();
        } else {
            // O recrutador vê apenas vagas associadas a ele com as empresas
            $jobs = Job::with('company')                                
            ->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();
        } 
            
        */
        
        return view('interviews.show', compact('interview', 'resume', 'jobs', 'jobsAssociados', 'jobAprovado'));
    }

    public function showDev($id)
    {
        
        $interview = Interview::findOrFail($id);
        $resume = Resume::findOrFail($interview->resume->id);

        // Vagas associadas ao recrutador
        $user = Auth::user();
        
        if($user->role == 'admin'){
            // Administrador vê todas as vagas com empresas associadas
            $jobs = Job::with('company')->get();
        } else {
            // O recrutador vê apenas vagas associadas a ele com as empresas
            $jobs = Job::with('company')->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();
        }

        
        
        
        return view('interviews.showDev', compact('interview', 'resume', 'jobs'));
    }

    // Mostra view com todos curriculos
    public function create(Request $request)
    {
        //$user = Auth::user();

        // Busca apenas as vagas associadas ao recrutador
        //$jobs = Job::whereHas('recruiters', function($query) use ($user){
        //    $query->where('recruiter_id', $user->id);
        //})->get();

        //$resumes = Resume::all();        
        //$resumes = Resume::whereDoesntHave('interview')->get();

        // Busca todas as entrevistas
        $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])
            ->whereDoesntHave('interview');

        //$query = Resume::query();

        


        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }


         // Filtro por nome - Busca pelo nome do candidato
         if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });

            //dd($request->nome);
        }


        //dd($query);
        // Filtro Status
        // if($request->filled('status')){           
        //    $query->where('status', $request->status);            
        // }   
        
        if($request->filled('status') && $request->status !== "Todos") {            
            $query->where('status', $request->status);            
        }
      
       
         // Filtro Candidato entrevistado/nao entrevistado/ todos
         if(request()->has('entrevistado')){
            if (request()->entrevistado == '1'){
                $query->whereHas('interview'); // Apenas candidatos que já foram entrevistados
            } elseif (request()->entrevistado == '0'){
                $query->whereDoesntHave('interview'); // Apenas candidatos que ainda não foram entrevistados
            }
        }
        
        // Filtro Filtro data Resumes

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }
        

        $interviews = Interview::all();

        // $query->with([
        //     'informacoesPessoais',
        //     'contato',
        //     'interview',
        //     'escolaridade'
        // ]);

        $resumes = $query->paginate(50);
        // Implementar paginação
        //$resumes = $query->paginate(50); // Ajustar o numero coforme necessário.

        return view('interviews.create', compact('interviews', 'resumes', 'form_busca'));    



        
        //return view('interviews.create', compact('resumes'));
    }

    // Mostra view com os dados do curriculo, pronta para entrevista
    public function interviewResume($id)
    {        

        
        $resume = Resume::find($id);

        return view('interviews.interviewResume', compact('resume'));
       
    }

    /*
    public function interviewResume(Request $request)
    {        
        $resume = Resume::find($request->input('resume_id'));

        return view('interviews.interviewResume', compact('resume'));
       
    }
    */

    
    public function store(StoreInterviewRequest $request, UpdateResumeRequest $requestResume, ResumeService $service)
    {

        $dataResumes = [
            'vagas_interesse' => $requestResume['vagas_interesse'] ?? '',
            'experiencia_profissional' => $requestResume['experiencia_profissional'] ?? '',
            'experiencia_profissional_outro' => $requestResume['experiencia_profissional_outro'] ?? '',
            'participou_selecao' => '', // cliente pediu para retirar
            'participou_selecao_outro' => '', // cliente pediu para retirar
            'foi_jovem_aprendiz' => $requestResume['foi_jovem_aprendiz'] ?? '',
            'curriculo_doc' => $requestResume['curriculo_doc'] ?? '',
            'cras' => $requestResume['cras'] ?? '',
            'fonte' => $requestResume['fonte'] ?? '',
            'nome' => $requestResume['nome'] ?? '',
            'data_nascimento' => $requestResume['data_nascimento'] ?? '',
            'estado_civil' => $requestResume['estado_civil'] ?? '',
            'possui_filhos' => $requestResume['possui_filhos'] ?? '',
            'filhos_sim' => $requestResume['filhos_sim'] ?? '', // idades
            'filhos_qtd' => $requestResume['filhos_qtd'] ?? '',
            'sexo' => $requestResume['sexo'] ?? '',
            'sexo_outro' => $requestResume['sexo_outro'] ?? '',
            'reservista' => $requestResume['reservista'] ?? '',
            'reservista_outro' => '',
            'cnh' => $requestResume['cnh'] ?? '',
            'tipo_cnh' => $requestResume['tipo_cnh'] ?? '',
            //'rg' => $requestResume['rg'],
            'cpf' => $requestResume['cpf'] ?? '',
            'instagram' => $requestResume['instagram'] ?? '',
            'linkedin' => $requestResume['linkedin'] ?? '',
            //'tamanho_uniforme' => $requestResume['tamanho_uniforme'],
            'foto_candidato' => $requestResume['foto_candidato'] ?? '',
            'pcd' => $requestResume['pcd'] ?? '',
            'pcd_sim' => $requestResume['pcd_sim'] ?? '',
            'nacionalidade' => $requestResume['nacionalidade'] ?? '',
            'escolaridade' => $requestResume['escolaridade'] ?? '', // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
            'escolaridade_outro' => $requestResume['escolaridade_outro'] ?? '', // Qual curso Outro
            'semestre' => $requestResume['semestre'] ?? '', // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
            'instituicao' => $requestResume['instituicao'] ?? '', // Quando Outro
            'outro_periodo' => $requestResume['outro_periodo'] ?? '', //Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.
            'informatica' => $requestResume['informatica'] ?? '',
            'obs_informatica' => $requestResume['obs_informatica'] ?? '',
            'ingles' => $requestResume['ingles'] ?? '',
            'obs_ingles' => $requestResume['obs_ingles'] ?? '',
            'fundamental_periodo' => $requestResume['fundamental_periodo'] ?? '',
            'fundamental_modalidade' => $requestResume['fundamental_modalidade'] ?? '',
            'medio_periodo' => $requestResume['medio_periodo'] ?? '',
            'medio_modalidade' => $requestResume['medio_modalidade'] ?? '',
            'tecnico_periodo' => $requestResume['tecnico_periodo'] ?? '',
            'tecnico_modalidade' => $requestResume['tecnico_modalidade'] ?? '',
            'tecnico_curso' => $requestResume['tecnico_curso'] ?? '',
            'superior_curso' => $requestResume['superior_curso'] ?? '', // Curso
            'superior_instituicao' => $requestResume['superior_instituicao'] ?? '',
            'superior_semestre' => $requestResume['superior_semestre'] ?? '', // Modalidade
            'superior_periodo' => $requestResume['superior_periodo'] ?? '', // Periodo de estudo: Manhã, Tarde, Noite, Integral. Quando cursando qq curso.
            'email' => $requestResume['email'] ?? '',
            'telefone_residencial' => $requestResume['telefone_residencial'] ?? '', //Telefone contato
            'nome_contato' => $requestResume['nome_contato'] ?? '',
            'telefone_celular' => $requestResume['telefone_celular'] ?? '',
            'logradouro' => $requestResume['logradouro'] ?? '',
            'numero' => $requestResume['numero'] ?? '',
            'complemento' => $requestResume['complemento'] ?? '',
            'bairro' => $requestResume['bairro'] ?? '',
            'cidade' => $requestResume['cidade'] ?? '',
            'uf' => $requestResume['uf'] ?? '',
            'cep' => $requestResume['cep'] ?? '',

        ];
        
        $data = $request->validated();     
          //dd($request->all());
        $resume = Resume::find($request->resume_id);
        $resume = $service->updateResume($requestResume->validated(), $resume);

        //dd($resume->informacoesPessoais);
        

        $interview =  Interview::create([
            'outros_idiomas' => $data['outros_idiomas'], 
            'apresentacao_pessoal' => $data['apresentacao_pessoal'], 
            'saude_candidato' => $data['saude_candidato'],
            'qual_formadora' => $data['qual_formadora'], 
            'vacina_covid' => $data['vacina_covid'],
            'experiencia_profissional' => $data['experiencia_profissional'], 
            'qual_motivo_demissao' => $data['qual_motivo_demissao'], 
            'caracteristicas_positivas' => $data['caracteristicas_positivas'], 
            'habilidades' => $data['habilidades'], 
            'pontos_melhoria' => $data['pontos_melhoria'], 
            'rotina_candidato' => $data['rotina_candidato'], 
            'disponibilidade_horario' => $data['disponibilidade_horario'], 
            'familia' => $data['familia'], 
            'renda_familiar' => $data['renda_familiar'],
            'familia_cras' => $data['familia_cras'],
            'tipo_beneficio' => $data['tipo_beneficio'] ?? null,
            'objetivo_longo_prazo' => $data['objetivo_longo_prazo'], 
            'porque_ser_jovem_aprendiz' => $data['porque_ser_jovem_aprendiz'], 
            'fonte_curriculo' => $data['fonte_curriculo'],
            'perfil_santa_casa' => $data['perfil_santa_casa'],
            'classificacao' => $data['classificacao'],
            'parecer_recrutador' => $data['parecer_recrutador'], 
            'observacoes' => $data['observacoes'], 
            'obs_rh' => $data['obs_rh'],
            'resume_id' => $data['resume_id'],
            'recruiter_id' => Auth::id(),            
            //'perfil' => $data['perfil'],
            //'curso_extracurricular' => $data['curso_extracurricular'], 
            //'pretencao_candidato' => $data['pretencao_candidato'], 
            //'sugestao_empresa' => $data['sugestao_empresa'], 
            //'sobre_candidato' => $data['sobre_candidato'], 
            //'pontuacao' => $data['pontuacao'],                      
        ]);


        // Salvando Log de criação
        $this->logAction('create', 'interviews', $interview->id, 'Entrevista cadastrado com sucesso.');

        return redirect()->route('interviews.show', $interview->id)->with('success', 'Entrevista cadastrada com sucesso e dados atualizados!');
        // return redirect()->back()->with('success', 'Entrevista cadastrada com sucesso e dados atualizados!');
    }

   

    public function update(UpdateInterviewRequest $request, Interview $interview, UpdateResumeRequest $requestResume, ResumeService $service)
    {
             
        $data = $request->validated();
        $resume = Resume::find($request->resume_id);
        $resume = $service->updateResume($requestResume->validated(), $resume);
      
        
       //dd($data);

        $interview->update($data);

        // Salvando Log de criação
        $this->logAction('create', 'interviews', $interview->id, 'Entrevista cadastrado com sucesso.');

        //return redirect()->route('interviews.index')->with('success', 'Entrevista cadastrada com sucesso!');
        return redirect()->back()->with('success', 'Entrevista atualizada com sucesso!');
    }

    // Andamento
    public function associarVaga(Request $request)
    {
       //dd($request->all());

        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',            
            'resume_id' => 'required|exists:resumes,id',            
           
        ]);
        
        //dd($data);

        
        $job = Job::findOrFail($request->job_id);
        $resume = Resume::findOrFail($request->resume_id);
        
        
        //dd($resume->jobs()->exists());
        // if($resume->jobs()->exists()){
        //     return redirect()->back()->with('danger', 'Candidato já está associado a uma vaga!');
        // }

        
        if(!$job->data_inicio_contratacao){
            return redirect()->back()->with('danger', 'Processo de contratação ainda não foi iniciado!');    
        }
        
        
        $job->resumes()->attach($request->resume_id);

        // Confirma se agora está associado
        if ($resume->jobs()->where('jobs.id', $job->id)->exists()) {
            // Aqui você pode mudar o status ou fazer outras ações
            $resume->status = 'processo'; // exemplo
            $resume->save();
        }


        // Salvando Log de criação
        $this->logAction('associate', 'job_resume', $job->id, 'Candidato associado a vaga.');

        return redirect()->back()->with('success', 'Candidato associado a vaga com sucesso!');
    }

    public function desassociarVaga(Request $request)
    {
        $data = $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'resume_id' => 'required|exists:resumes,id',
        ]);
        
        $job = Job::findOrFail($data['job_id']);
        $resume = Resume::findOrFail($data['resume_id']);
        
        // Verifica se está associado antes de remover
        if ($resume->jobs()->where('jobs.id', $job->id)->exists()) {
            
            $job->resumes()->detach($resume->id);

            // (Opcional) Atualiza o status do currículo
            $resume->status = 'ativo'; // ou outro status
            $resume->save();

            // Log de desassociação
            $this->logAction('detach', 'job_resume', $job->id, 'Candidato desassociado da vaga.');

            return redirect()->back()->with('success', 'Candidato desassociado com sucesso!');
        }

        return redirect()->back()->with('danger', 'Candidato não estava associado a esta vaga.');
    }

    public function destroy(Interview $interview)
    {
        if( $interview->recruiter_id !== Auth::id()){
            abort(403, 'Acesso negado');
        }

        $interview->delete();

        // Salvando Log de criação
        $this->logAction('delete', 'interviews', $interview->id, 'Entrevista excluída.');

        return redirect()->route('interviews.index')->with('success', 'Entrevista excluída com sucesso!');
    }

    public function updateStatus(Request $request, $jobId, $resumeId)
    {

       
        // Valida o campo status
        $request->validate([
            'status' => 'required|in:em análise,entrevistado,aprovado,lista de espera,reprovado',            
        ]);

       
        // Busca o currículo (Resume) e a vaga associada
        $job = Job::findOrFail($jobId);
        $resume = Resume::findOrFail($resumeId);

        // Busca ou cria o relacionamento na tabela intermediaria

        if($job->resumes()->wherePivot('resume_id', $resume->id)->exists()){
            // Se existe, atualiza o status
            $job->resumes()->updateExistingPivot($resume->id,[
                'status' => $request->input('status'),
                'updated_at' => now(),
            ]);            
        } else {
            // Se não existe, cria o relacionamento com o status inical
            $job->resumes()->attach($resume->id,[
                'status' => $request->input('status'),
            ]);
        }




        // Verifica vagas preenchidas
        if($request->input('status') === 'aprovado'){
            if ($job->filled_positions < $job->quantidade ){
                $job->increment('filled_positions');
            } else {
                // Se vagas esgotadas, move para lista de espera
                $job->resumes()->updateExistingPivot($resume->id, [
                    'status' => 'lista de espera',
                    'updated_at' => now(),
                ]);
            }
        } elseif ($request->input('status') === 'reprovado'){
            if ($job->filled_positions > 0){
                $job->decrement('filled_positions');
            }
        }


        // Reprocessar a lista de espera

        $this->allocateFromWaitlist($job);

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }

    private function allocateFromWaitlist($job)
    {
        // Calcula o número de vagas disponíveis
        $vagas_disponiveis = $job->quantidade - $job->filled_positions;

        if ($vagas_disponiveis > 0) {
            //Busca currículo na fila de espera
            $candidatos = $job->resumes()
                ->wherePivot('status', 'lista de espera')
                ->take($vagas_disponiveis)
                ->get();

            // Aprova candidatos da fila de espera
            foreach( $candidatos as $candidato ){
                $candidato->updateExistingPivot($candidato->id, ['status' => 'aprovado']);
                $job->increment('filled_positions');
            }
        }
    }
}
