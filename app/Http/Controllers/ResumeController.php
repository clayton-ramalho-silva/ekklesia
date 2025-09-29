<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resume\StoreResumeRequest;
use App\Http\Requests\Resume\UpdateResumeRequest;
use App\Models\ContactResume;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use App\Models\Selection;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\ResumeService;
use App\Services\CidadeService;

class ResumeController extends Controller
{
    use LogsActivity;

    protected $cidadeService;

    public function __construct(CidadeService $cidadeService)
    {
        $this->cidadeService = $cidadeService;
    }

    public function index(Request $request)
    {

        

        /**
         * Filtros: gênero, cnh, cidade, idade, entrevistado
         */

        /** Todas as idades */
        // $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])->whereDoesntHave('interview');
        
        //Abaixo de 23 anos.
        $query = Resume::with(['informacoesPessoais', 'contato', 'escolaridade'])
            ->whereDoesntHave('interview')
            ->whereHas('informacoesPessoais', function ($q) {
                $q->whereNotNull('data_nascimento')
                ->whereRaw('TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()) < 23');
            });

        // Forumulario Busca - nome candidato
        $form_busca = '';
        if($request->filled('form_busca')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }

        // Aplica os filtros somente quando fornecidos
        // Filtro por nome - Busca pelo nome do candidato
        if($request->filled('nome')) {
            $query->whereHas('informacoesPessoais', function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%');
            });
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

         // Filtro Status

        if ($request->filled('status') && $request->status !== "Todos") {            
                $query->where('status', $request->status);            
        }
       

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

        // Filtro Idade considerando idade minima e máxima por meses - EM DESENVOLVIMENTO
        // if ($request->filled('min_age') || $request->filled('max_age')) {
        //     $query->whereHas('informacoesPessoais', function ($q) use ($request) {
        //         $q->whereNotNull('data_nascimento');

        //         if ($request->filled('min_age')) {
        //             $q->whereRaw('TIMESTAMPDIFF(MONTH, data_nascimento, CURDATE()) >= ?', [$request->min_age]);
        //         }

        //         if ($request->filled('max_age')) {
        //             $q->whereRaw('TIMESTAMPDIFF(MONTH, data_nascimento, CURDATE()) <= ?', [$request->max_age]);
        //         }
        //     });
        // }


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

        // Filtro Informatica - múltiplas seleções
        if ($request->filled('informatica') && is_array($request->informatica)) {
            $opcoesInformatica = array_filter($request->informatica); // Remove valores vazios
            
            if (!empty($opcoesInformatica)) {
                $query->whereHas('escolaridade', function($q) use ($opcoesInformatica) {
                    $q->where(function($subQuery) use ($opcoesInformatica) {
                        foreach ($opcoesInformatica as $informatica) {
                            $subQuery->orWhere('informatica', 'like', '%' . $informatica . '%');
                        }
                    });
                });
            }
        }

        // Filtro Informatica - múltiplas seleções
        if ($request->filled('ingles') && is_array($request->ingles)) {
            $opcoesIngles = array_filter($request->ingles); // Remove valores vazios
            
            if (!empty($opcoesIngles)) {
                $query->whereHas('escolaridade', function($q) use ($opcoesIngles) {
                    $q->where(function($subQuery) use ($opcoesIngles) {
                        foreach ($opcoesIngles as $ingles) {
                            $subQuery->orWhere('ingles', 'like', '%' . $ingles . '%');
                        }
                    });
                });
            }
        }


        // No controller, ANTES de processar os filtros
        // $opcoesIngles = ['Básico', 'Intermediário', 'Avançado', 'Nenhum'];

        // if ($request->filled('ingles') && is_array($request->ingles)) {
        //     $opcoesIngles = array_filter($request->ingles); // Remove valores vazios
            
        //     if (!empty($opcoesIngles)) {
        //         $query->whereHas('escolaridade', function($q) use ($opcoesIngles) {
        //             $q->where(function($subQuery) use ($opcoesIngles) {
        //                 foreach ($opcoesIngles as $opcao) {
        //                     $subQuery->orWhere('ingles', $opcao );
        //                 }
        //             });
        //         });
        //     }
        // }





         // Filtro Formação/Escolaridade
         if ($request->filled('escolaridade') && $request->escolaridade !== "Todos") {
            $query->whereHas('escolaridade', function($q) use ($request) {
                $q->whereJsonContains('escolaridade', $request->escolaridade);
            });
        }    

        // Filtro Vagas Interesse
        if ($request->filled('vagas_interesse')) {
            foreach ($request->vagas_interesse as $vaga) {
                $query->whereJsonContains('vagas_interesse', $vaga);
            }
        }

        // Filtro Experiência Profissional
        if ($request->filled('experiencia_profissional')) {
            foreach ($request->experiencia_profissional as $exp) {
                $query->whereJsonContains('experiencia_profissional', $exp);
            }
        }

      
        // Filtro Cidade - múltiplas seleções
        if ($request->filled('cidade') && is_array($request->cidade)) {
            $cidades = array_filter($request->cidade); // Remove valores vazios
            
            if (!empty($cidades)) {
                $query->whereHas('contato', function($q) use ($cidades) {
                    $q->where(function($subQuery) use ($cidades) {
                        foreach ($cidades as $cidade) {
                            $subQuery->orWhere('cidade', 'like', '%' . $cidade . '%');
                        }
                    });
                });
            }
        }

        // Filtro Telefone Celular

        //dd($request->celular);
        if ($request->filled('celular') && strlen($request->celular) >= 4) {
            $ultimosDigitos = substr($request->celular, -4);
            
            $query->whereHas('contato', function($q) use ($ultimosDigitos) {
                $q->where('telefone_celular', 'like', '%' . $ultimosDigitos);
            });
        }

        // Filtro Candidato entrevistado/nao entrevistado/ todos
        // if ($request->has('entrevistado') && $request->entrevistado !== "Todos") {
        //     if ($request->entrevistado == '1') {
        //         $query->whereHas('interview');
        //     } elseif ($request->entrevistado == '0') {
        //         $query->whereDoesntHave('interview');
        //     }
        // }

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
        // Carregue as relações apenas após aplicar todos os filtros
        // $query->with([
        //     'informacoesPessoais',
        //     'contato',
        //     'interview',
        //     'escolaridade'
        // ]);

        //dd($query->toRawSql());

        //NOVA FUNCIONALIDADE: Filtro de Ordenação
        $ordem = $request->get('ordem', 'desc'); // Por padrão será 'desc' (mais recente primeiro)
        
        // Validar se a ordem é válida
        if (!in_array($ordem, ['asc', 'desc'])) {
            $ordem = 'desc';
        }

        $query->orderBy('created_at', $ordem);

        
         

        



            // Implementar paginação
        $resumes = $query->paginate(50)->appends($request->all()); // Ajustar o numero coforme necessário.  
        
        $cidades = $this->cidadeService->getCidades();
        //$cidades = $this->getCidadesFromContact();
        //dd($cidades);
            
        return view('resumes.index', compact('resumes', 'form_busca','ordem', 'cidades'));
            
    }

    public function show(Resume $resume)
    {
        $user = Auth::user();


        // Obtém vagas com empresas associadas conforme o usuário e status 'aberta'
        $jobsQuery = Job::where('status', 'aberta');

        if ($user->role !== 'admin') {
            $jobsQuery->whereHas('recruiters', function ($query) use ($user) {
                $query->where('recruiter_id', $user->id);
            });
        }

        $jobs = $jobsQuery->get();

        dd($jobs);





        // if($user->role == 'admin'){
        //     // Administrador vê todas as vagas com empresas associadas
        //     $jobs = Job::with('company')->get();
        // } else {
        //     // O recrutador vê apenas vagas associadas a ele com as empresas
        //     $jobs = Job::with('company')->whereHas('recruiters', function($query) use($user){
        //         $query->where('recruiter_id', $user->id);
        //     })->get();
        // }

        return view('resumes.show', compact('resume', 'jobs'));
    }

    public function create()
    {
        return view('resumes.create');
    }

    public function store(StoreResumeRequest $request)
    {
        

        //dd($request->all());

        $data = $request->validated();

       // dd($data);

         // Salvando foto do candidato no banco e movendo arquivo para pasta.
            if($request->hasFile('foto_candidato') && $request->file('foto_candidato')->isValid()){

                $file = $request->file('foto_candidato');

                $extension = $file->getClientOriginalExtension();

                $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

                $file->move(public_path('documents/resumes/fotos'), $fileName);

                $data['foto_candidato'] = $fileName;

            } else {

                $data['foto_candidato'] = '';

            }

        // Salvando curriculo no banco e movendo arquivo para pasta.
        if($request->hasFile('curriculo_doc') && $request->file('curriculo_doc')->isValid()){

            $file = $request->file('curriculo_doc');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/resumes/curriculos'), $fileName);

            $data['curriculo_doc'] = $fileName;

        } else {

            $data['curriculo_doc'] = '';

        }

        $resume = Resume::create([
            'vagas_interesse' => $data['vagas_interesse'] ?? '',
            'experiencia_profissional' => $data['experiencia_profissional'] ?? '',
            'experiencia_profissional_outro' => $data['experiencia_profissional_outro'] ?? '',
            'participou_selecao' => '', // Cliente pediu para retirar
            'participou_selecao_outro' => '', // Cliente pediu para retirar
            'foi_jovem_aprendiz' => $data['foi_jovem_aprendiz'] ?? '',
            'curriculo_doc' => $data['curriculo_doc'] ?? '',
            'cras' => $data['cras'] ?? '',
            'fonte' => $data['fonte'] ?? '',

        ]);

        $resume->informacoesPessoais()->create([
            'nome' => $data['nome'] ?? '',
            'data_nascimento' => $data['data_nascimento'] ?? '',
            'estado_civil' => $data['estado_civil'] ?? '',
            'possui_filhos' => $data['possui_filhos'] ?? '',
            'filhos_sim' => $data['filhos_sim'] ?? '', // idade
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
            'tamanho_uniforme' => $data['tamanho_uniforme'] ?? '',
            'foto_candidato' => $data['foto_candidato'] ?? '',
            'pcd' => $data['pcd'] ?? '',
            'pcd_sim' => $data['pcd_sim'] ?? '',
            'nacionalidade' => $data['nacionalidade'] ?? '',

        ]);

        $resume->escolaridade()->create([
            'escolaridade' => $data['escolaridade'] ?? '', // Fundamental completo, Fundamental cursando, Medio completo, Medio cursando, Tecnico completo, Tecnico cursando, Superior Completo Superior Cursando ou Outro
            'escolaridade_outro' => $data['escolaridade_outro'] ?? '', // Qual curso Outro
            'semestre' => $data['semestre'] ?? '', // Modalidade: Presencial, EAD, Hibrido, Outro. Quando cursando qq curso.
            'instituicao' => $data['instituicao'] ?? '', // Quando for Superior Incompleto ou Outro
            'outro_periodo' => $data['outro_periodo'] ?? '',
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

        $resume->contato()->create([
            'email' => $data['email'] ?? '',
            'telefone_residencial' => $data['telefone_residencial'] ?? '', // Telefone de contato
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

        // Salvando Log de criação
        $this->logAction('create', 'jobs', $resume->id, 'Resume cadastrado com sucesso.');

        return redirect()->route('resumes.index')->with('success', 'Currículo cadastrado com sucesso!');
    }

    public function edit(Resume $resume)
    {

        $user = Auth::user();
        $resume->load(['jobs', 'selections']);

        // $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');

        // $jobAprovado = '';
        // if( $temSelecaoAprovada ) {
        //     $selection = $resume->selections->where('status_selecao', 'aprovado')->first();
        //     $jobAprovado = $selection->job;
        // }

        //dd($jobAprovado);
        // Obtém vagas com empresas associadas conforme o usuário e status 'aberta'
        //$jobsQuery = Job::where('status', 'aberta');

        // if ($user->role !== 'admin') {
        //     $jobsQuery->whereHas('recruiters', function ($query) use ($user) {
        //         $query->where('recruiter_id', $user->id);
        //     });
        // }

        // $jobs = $jobsQuery->get();   
        $jobs = Job::where('status', 'aberta')->get();

        $jobsAssociados = $resume->jobs;


        //dd($jobs);

        return view('resumes.edit', compact('resume', 'jobs'));
    }

    public function update(UpdateResumeRequest $request, Resume $resume, ResumeService $service)
    {

        $resume = $service->updateResume($request->validated(), $resume);

        // Salvando Log de criação
        $this->logAction('update', 'jobs', $resume->id, 'Resume atualizado com sucesso.');
        return redirect()->back()->with('success', 'Currículo atualizado com sucesso!');

        //return redirect()->route('resumes.index')->with('success', 'Currículo atualizado com sucesso!');
    }

    public function destroy(Resume $resume)
    {
        //dd($resume);
        
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('danger', 'Permissão negada! Entre em contato com Adminstrador.');
        }
        //dd($resume);

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

        // Excluindo informaçõe pessoais
        if($resume->informacoesPessoais){
            $resume->informacoesPessoais->delete();
        }

        // Excluindo informações academicas
        if($resume->escolaridade){
            $resume->escolaridade->delete();
        }

        // Excluindo informações contato
        if($resume->contato){
            $resume->contato->delete();
        }

        // Excluindo informações entrevista
        if($resume->interview){
            $resume->interview->delete();
        }

        // Excluindo Seleções
        if($resume->selections->count() > 0){
            foreach ($resume->selections as $selection){
                $selection->delete();
            }
        }

        // Excluindo observações
        if($resume->observacoes->count() > 0){
            foreach($resume->observacoes as $observacoes){
                $observacoes->delete();
            }
        }

        // Removendo associaç~eos com jobs
        $resume->jobs()->detach();
    
        $resume->delete();

        // Salvando Log de criação
        $this->logAction('delete', 'jobs', $resume->id, 'Resume excluído.');

        return redirect()->route('resumes.index')->with('success', 'Currículo excluído com sucesso!');
    }

    // Cadastro de currículos vindos de formulário externo ao sistema.
    /**
     * Rota está a api.php, vou usar o recurso de token secreto.
     * Vou deixar um formulário de amostra na raiz
     */
    public function storeExternalResume(Request $request)
    {
        // Verifica a origem da requisição
        $token = $request->header('X-External-Token');
        $allowedToken = config('services.external_resume.token'); // Salve o token no arquivo .env

        if ($token !== $allowedToken){
            return response()->json(['error' => 'Token inválido.'], 403);
        }

        // Validar o dados recebidos
        $validator = Validator::make($request->all(),[
            'nome_candidato' => 'required|string|max:255',
            'idade' => 'required|integer|min:1',
            'experiencia' => 'nullable|string',
            'email' => 'required|email|unique:resumes,email',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Salva os dados no banco

        $resume = Resume::create([
            'nome_candidato' => $request->input('nome_candidato'),
            'idade' => $request->input('idade'),
            'experiencia' => $request->input('experiencia'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'endereco' => $request->input('endereco'),
        ]);

        // Retorna a resposta
        return response()->json(['message' => 'Currículo enviado com sucesso!', 'resume' => $resume], 201);

    }


    // Cadastro de observações sobre o candidato. Parecido com de Vagas.
    public function storeHistory(Request $request, $resumeId)
    {
        //dd($resumeId);
        $data = $request->validate([
            'observacao' => 'required|string',
        ]);

        $resume = Resume::find($resumeId);

        $resume->observacoes()->create([
            'observacao' => $data['observacao'],
        ]);

        return redirect()->back()->with('success', 'Observação cadastrada com sucesso!');
    }

    public function updateStatus(Request $request, $id) 
    {
        //dd($request->all());
        $resume = Resume::findOrfail($id);
        $oldStatus = $resume->status;
        $newStatus = $request->status;// == 'ativo' ? 'ativo' : 'inativo';

        $resume->status = $newStatus;
        $resume->save();

        // Se o status for alterado para inativo, desassocia de toda as vagas
        if( $oldStatus !== 'inativo' && $newStatus == 'inativo') {
            $resume->jobs()->detach();

             // Salvando Log de criação
            $this->logAction('update', 'jobs', $resume->id, 'Curriculo foi inativado e desassociado de todas as vagas.');
            return redirect()->back()->with('success', 'Status alterado para Inativo. O currículo foi desassociado de todas as vagas.');

        }

        return redirect()->back()->with('success', 'Status alterado com sucesso para ' . ucfirst($newStatus) . '.');
    }


     /**
     * Opção 3: Direto da tabela ContactResume (mais simples ainda)
     */
    public function getCidadesFromContact()
    {        
        $cidades = ContactResume::whereNotNull('cidade')
            ->where('cidade', '!=', '')
            ->distinct()
            ->pluck('cidade')
            ->map(function($cidade) {
                return $this->normalizarCidade($cidade);
            })
            ->unique()
            ->sort()
            ->values();

        return $cidades;
    }
    /*
     * Método auxiliar para normalizar nomes das cidades
     */
    private function normalizarCidade($cidade)
    {
        if (!$cidade) return null;
        
        // Remove espaços extras e quebras de linha
        $cidade = trim($cidade);
        
        if (empty($cidade)) return null;
        
        // Separa por espaços
        $parts = explode(' ', $cidade);
        $normalized = [];
        
        foreach ($parts as $part) {
            $part = trim($part);
            if (!empty($part)) {
                $normalized[] = ucfirst(strtolower($part));
            }
        }
        
        return implode(' ', $normalized);
    }


}
