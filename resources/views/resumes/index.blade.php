@extends('layouts.app')

@section('content')
<section class="cabecario">
    <h1>Currículos</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltro"  data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>
            
            <form id="filter-form" method="GET" action="{{ route('resumes.index') }}" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltro">

                <div class="row d-flex container-filtros">
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome do Candidato</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}" placeholder="Buscar por nome...">                        
                    </div>

                    <div class="col-6 mb-4">
                        <label for="celular" class="form-label">4 últimos dígitos do Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control" value="{{ request('celular') }}" placeholder="Ex: 9999">
                    </div>
                    <div class="col-6 mb-4">
                        <label for="telefone_contato" class="form-label">4 últimos dígitos do Tel. Contato</label>
                        <input type="text" name="telefone_contato" id="telefone_contato" class="form-control" value="{{ request('celular') }}" placeholder="Ex: 9999">
                    </div>
                     <div class="col col-5 mb-4">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"  value="{{ request('cpf') }}" placeholder="000.000.000-00" maxlength="14">
                            @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col col-4 mb-4">
                        <div class="form-group">
                            <label class="form-label">Ordenação:</label>
                            <select name="ordem" class="form-select select2" onchange="this.form.submit()">
                                <option value="desc" {{ $ordem == 'desc' ? 'selected' : '' }}>Mais Recente</option>
                                <option value="asc" {{ $ordem == 'asc' ? 'selected' : '' }}>Mais Antigo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col col-3">
                        <label for="min_age" class="form-label">Idade mín.:</label>
                        <input type="number" name="min_age" id="min_age" class="form-control" value="{{ request('min_age')}}" >
                    </div>

                    <div class="col-6">
                        <label for="vagas_interesse" class="form-label">Vagas de Interesse</label>
                        <select name="vagas_interesse[]" id="vagas_interesse" class="form-select" multiple>
                            @foreach (  
                                        ['Copa & Cozinha', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)',
                                        'Construção e Reparos', 'Conservação e Limpeza'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('vagas_interesse', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                           
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="experiencia_profissional" class="form-label">Experiência Profissional</label>
                        <select name="experiencia_profissional[]" id="experiencia_profissional" class="form-select" multiple>
                            @foreach (  
                                        ['Nenhuma por enquanto', 'Copa & Cozinha', 'Camareiro(a) de Hotel', 
                                        'Recepcionista', 'Atendente de Lojas e Mercados (Comércio & Varejo)', 'TI (Tecnologia da Informação',
                                        'Construção e Reparos', 'Conservação e Limpeza'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('experiencia_profissional', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                            
                        </select>
                    </div>

                    {{-- <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status[]" id="status" class="form-select" multiple>
                            @foreach (  
                                    ['ativo', 'processo', 'contratado', 'inativo'] as $option)
                            <option value="{{ $option }}" {{ in_array($option, request('status', []))? 'selected' : ''}}>
                                @switch($option)
                                    @case('ativo')
                                        Disponivel
                                        @break
                                    @case('processo')
                                        Em processo
                                        @break
                                    @case('contratado')
                                        Contratado
                                        @break
                                    @case('inativo')
                                        Inativo                                        
                                        @break
                                    @default
                                        {{ $option }}
                                    
                                        
                                @endswitch
                               
                            </option>
                            @endforeach 
                            
                        </select>
                    </div> --}}

                    <div class="col-6">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            @foreach (['ativo', 'processo', 'contratado', 'inativo'] as $option)
                                @php
                                    $label = match($option) {
                                        'ativo' => 'Disponivel',
                                        'processo' => 'Em processo',
                                        'contratado' => 'Contratado',
                                        'inativo' => 'Inativo',
                                        default => $option
                                    };
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="status[]" 
                                        id="status_{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('status', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_{{ $loop->index }}">
                                        {{ $label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                   {{-- <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo[]" id="sexo" class="form-select" multiple>                            
                            @foreach (  
                                        ['Homem', 'Mulher', 'Prefiro não dizer'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('sexo', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                            
                            
                        </select>
                    </div> --}}

                    <div class="col-6">
                        <label class="form-label">Gênero</label>
                        <div class="form-check">
                            @foreach (['Homem', 'Mulher', 'Prefiro não dizer', 'Outro'] as $option)
                                @php
                                    $label = match($option) {
                                        'Homem' => 'Masculino',
                                        'Mulher' => 'Feminino',                                        
                                        default => $option
                                    };
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sexo[]" 
                                        id="sexo_{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('sexo', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="sexo_{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="cnh" class="form-label">Possui CNH?</label>
                        <div class="form-check">
                            @foreach (['Sim', 'Não', 'Em andamento'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cnh[]" 
                                        id="cnh{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('cnh', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cnh{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <!--<select name="cnh[]" id="cnh" class="form-select" multiple>
                            {{-- <option value="">Todos</option> --}}
                            {{-- @foreach (  
                                        ['Sim', 'Não', 'Em andamento'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('reservista', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach  --}}
                            {{-- <option value="Sim"  {{ request('cnh') == 'Sim' ? 'selected' : '' }}> Sim</option>
                            <option value="Não"  {{ request('cnh') == 'Não' ? 'selected' : '' }}> Não</option>
                            <option value="Em andamento"  {{ request('cnh') == 'Em andamento' ? 'selected' : '' }}> Em andamento</option> --}}
                        </select>-->
                    </div>

                    

                    <div class="col-6">
                        <label for="reservista" class="form-label">Possui Reservista?</label>
                        <div class="form-check">
                            @foreach (['Sim', 'Não', 'Em andamento'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="reservista[]" 
                                        id="reservista{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('reservista', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="reservista{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <select name="reservista[]" id="reservista" class="form-select" multiple>
                          
                            @foreach (  
                                        ['Sim', 'Não', 'Em andamento'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('reservista', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach 
                          
                        </select> --}}
                    </div>

                    <div class="col-6">
                        <label for="foi_jovem_aprendiz" class="form-label">Já foi Jovem Aprendiz?</label>
                        <div class="form-check">
                            @foreach (['Sim, da ASPPE', 'Sim, de Outra Qualificadora', 'Não'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="foi_jovem_aprendiz[]" 
                                        id="foi_jovem_aprendiz{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('foi_jovem_aprendiz', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="foi_jovem_aprendiz{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <select name="foi_jovem_aprendiz[]" id="foi_jovem_aprendiz" class="form-select" multiple>                            
                             @foreach (  
                                        ['Sim, da ASPPE', 'Sim, de Outra Qualificadora', 'Não'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('foi_jovem_aprendiz', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                             
                        </select> --}}
                    </div>

                    {{-- <div class="col-6">
                        <label for="escolaridade" class="form-label">Formação/Escolaridade</label>
                        <select name="escolaridade[]" id="escolaridade" class="form-select" multiple>                            
                            @foreach ( ['Ensino Fundamental Completo', 'Ensino Fundamental Cursando', 'Ensino Médio Completo', 
                                        'Ensino Médio Incompleto','Ensino Técnico Completo','Ensino Técnico Cursando', 
                                        'Superior Completo', 'Superior Cursando', 'Outro'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, (array) request('escolaridade', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                             
                        </select>
                    </div> --}}
                    <div class="col-12">
                        <label class="form-label">Formação/Escolaridade</label>
                        <div class="form-check d-flex flex-wrap">
                            @foreach ( ['Ensino Fundamental Completo', 'Ensino Fundamental Cursando', 'Ensino Médio Completo', 
                                        'Ensino Médio Incompleto','Ensino Técnico Completo','Ensino Técnico Cursando', 
                                        'Superior Completo', 'Superior Cursando', 'Outro'] as $option)
                                <div class="form-check w-50">
                                    <input class="form-check-input" type="checkbox" name="escolaridade[]" 
                                        id="escolaridade_{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, (array) request('escolaridade', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="escolaridade_{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="informatica" class="form-label">Possui conhecimento no pacote Office (Excel/Word)?</label>
                        <div class="form-check">
                            @foreach (['Básico', 'Intermediário', 'Avançado','Nenhum'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="informatica[]" 
                                        id="informatica{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('informatica', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="informatica{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <select name="informatica[]" id="informatica" class="form-select" multiple>
                            <option value="">Todos</option>
                            @foreach (  
                                        ['Básico', 'Intermediário', 'Avançado', 'Nenhum'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('informatica', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                             
                        </select> --}}
                    </div>

                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <div class="form-check">
                            @foreach (['Básico', 'Intermediário', 'Avançado','Nenhum'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ingles[]" 
                                        id="ingles{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('ingles', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ingles{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <select name="ingles[]" id="ingles" class="form-select" multiple>
                            <option value="">Todos</option>
                            @foreach (  
                                        ['Básico', 'Intermediário', 'Avançado', 'Nenhum'] as $option)
                                <option value="{{ $option }}" {{ in_array($option, request('ingles', []))? 'selected' : ''}}>
                                    {{ $option }}
                                </option>
                            @endforeach                            
                        </select> --}}
                    </div>

                                  
                    
                    <div class="col-12">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade[]" class="" multiple="multiple">
                            {{-- <option>Todas</option> --}}
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade }}" 
                                    {{ is_array(request('cidade')) && in_array($cidade, request('cidade')) ? 'selected' : '' }}>
                                    {{ $cidade }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                

                    {{-- <div class="col-6 mb-4">
                        <label for="entrevistado" class="form-label">Entrevistado</label>
                        <select name="entrevistado" id="entrevistado" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="1" {{ request('entrevistado') == '1' ? 'selected' : '' }}>Já entrevistado</option>
                            <option value="0" {{ request('entrevistado') == '0' ? 'selected' : '' }}>Não entrevistado</option>
                        </select>
                    </div> --}}
                    <div class="col-6 mb-4">
                        <label for="data_min" class="form-label">Data Cadastro (de):</label>
                        <input type="date" name="data_min" id="data_min" class="form-control" value="{{ request('data_min') }}">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="data_max" class="form-label">Data Cadastro (até):</label>
                        <input type="date" name="data_max" id="data_max" class="form-control" value="{{ request('data_max') }}">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select select2">
                            <option value="">Todas</option>
                            <option value="7" {{ request('filtro_data') == '7' ? 'selected' : '' }}>Últimos 7 dias</option>
                            <option value="15" {{ request('filtro_data') == '15' ? 'selected' : '' }}>Últimos 15 dias</option>
                            <option value="30" {{ request('filtro_data') == '30' ? 'selected' : '' }}>Últimos 30 dias</option>
                            <option value="90" {{ request('filtro_data') == '90' ? 'selected' : '' }}>Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="ingles" class="form-label">Sua família é atendida por algum equipamento do governo?</label>
                        <select name="cras" id="cras" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" {{ request('cras') == 'Sim' ? 'selected' : '' }}> Sim</option>                            
                            <option value="Não" {{ request('cras') == 'Não' ? 'selected' : '' }}> Não</option>                            
                        </select>
                    </div>

                     {{-- <div class="col-6 mb-4">
                        <label for="pcd" class="form-label">PCD</label>
                        <div class="form-check">
                            @foreach (['Sim, com laudo.', 'Sim, sem laudo.', 'Não'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pcd[]" 
                                        id="pcd{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('pcd', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pcd{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div> --}}
                        {{-- <select name="pcd[]" id="pcd" class="form-select" multiple>
                            
                            @foreach (  
                                    ['Sim, com laudo.', 'Sim, sem laudo.', 'Não'] as $option)
                            <option value="{{ $option }}" {{ in_array($option, request('pcd', []))? 'selected' : ''}}>
                                {{ $option }}
                            </option>
                            @endforeach 
                            
                        </select> --}}
                    {{-- </div> --}}

                    <div class="col-6 mb-4">
                        <label for="pcd" class="form-label">PCD</label>
                        <div>
                            @foreach (['Sim, com laudo.', 'Sim, sem laudo.', 'Não'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pcd[]" 
                                        id="pcd_{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, (array) request('pcd', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="pcd_{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    

                    


                    <div class="col-12 mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>                        
                        <a href="{{ route('resumes.index') }}" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

<div class="bloco-filtros-ativos">
    Filtros ativos <span></span>
</div>


<section class="sessao">

    <article class="f-interna">

        <h4>Currículos em Destaque</h4>               
        <div class="table-container lista-curriculos">
            
            <ul class="tit-lista">
                <li class="col-inscricao sortable" data-column="inscricao" data-type="date">Inscrição</li> 
                <li class="col-nome sortable" data-column="nome" data-type="text">Nome</li> 
                <li class="col-cpf sortable" data-column="cpf" data-type="text">CPF</li>
                <li class="col-cnh sortable" data-column="cnh" data-type="text">CNH</li>
                <li class="col-tipo_cnh sortable" data-column="tipo_cnh" data-type="text">Tipo CNH</li>
                <li class="col-data_nascimento sortable" data-column="data_nascimento" data-type="text">Data de Nascimento</li>
                <li class="col-nacionalidade sortable" data-column="nacionalidade" data-type="text">Nacionalidade</li>
                <li class="col-estado_civil sortable" data-column="estado_civil" data-type="text">Estado Civil</li>
                <li class="col-possui_filhos sortable" data-column="possui_filhos" data-type="text">Possui filhos?</li>
                <li class="col-filhos_sim sortable" data-column="filhos_sim" data-type="text">Qual idade deles?</li>
                <li class="col-genero sortable" data-column="genero" data-type="text">Gênero</li>
                <li class="col-genero_outro sortable" data-column="genero_outro" data-type="text">Qual seu gênero?</li>
                <li class="col-pcd sortable" data-column="pcd" data-type="text">PCD</li>
                <li class="col-pcd_sim sortable" data-column="pcd_sim" data-type="text">Número CID</li>
                <li class="col-reservista sortable" data-column="reservista" data-type="text">Reservista</li>
                <li class="col-endereco sortable" data-column="endereco" data-type="text">Endereço</li>
                <li class="col-cidade sortable" data-column="cidade" data-type="text">Cidade</li>
                <li class="col-uf sortable" data-column="uf" data-type="text">UF</li>
                <li class="col-email sortable" data-column="email" data-type="text">E-mail</li>
                <li class="col-telefone_celular sortable" data-column="telefone_celular" data-type="text">Telefone Celular</li>
                <li class="col-telefone_recado sortable" data-column="telefone_recado" data-type="text">Telefone Recado</li>
                <li class="col-nome_recado sortable" data-column="nome_recado" data-type="text">Nome Recado</li>
                <li class="col-instagram sortable" data-column="instagram" data-type="text">Instagram</li>
                <li class="col-linkedin sortable" data-column="linkedin" data-type="text">Linkedin</li>
                <li class="col-vaga sortable" data-column="vaga" data-type="text">Tipo de vaga</li>
                <li class="col-experiencia_profissional sortable" data-column="experiencia_profissional" data-type="text">Experiencia Profissional</li>
                <li class="col-formacao sortable" data-column="formacao" data-type="text">Formação</li>
                <li class="col-formacao_complemento sortable" data-column="formacao_complemento" data-type="text">Formação Complemento</li>
                <li class="col-superior_periodo sortable" data-column="superior_periodo" data-type="text">Qual o Período?</li>
                <li class="col-jovem-aprendiz sortable" data-column="jovem-aprendiz" data-type="text">Já foi jovem aprendiz?</li>
                <li class="col-informatica sortable" data-column="informatica" data-type="text">Possui conhecimento no pacote Office (Excel/Word)?</li>
                <li class="col-ingles sortable" data-column="ingles" data-type="text">Inglês</li>
                <li class="col-cras sortable" data-column="cras" data-type="text">Família atendida por algum equipamento Público?</li>
                <li class="col-tamanho_uniforme sortable" data-column="tamanho_uniforme" data-type="text">Fonte Currículo</li>
                <li class="col-entrevistado sortable" data-column="entrevistado" data-type="text">Entrevistado</li>
                <li class="col-status sortable" data-column="status" data-type="text">Status</li>
            </ul>

            @if ($resumes->count() > 0)

                

                @foreach ($resumes as $resume)
                {{-- <ul onclick="window.location='{{ route('resumes.edit', $resume) }}'" > --}}
                <ul onclick="window.open('{{ route('resumes.edit', $resume) }}', '_blank')" >
                    @php                       

                        $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                        $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                        $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';

                        //Verifica se a idade é maior que 22 anos e 8 meses
                        $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                        $limiteEmMeses = (22 * 12) + 8;

                        // dd($resume->created_at->format('d/m/Y'));
                    @endphp
                    <li class="col-inscricao">
                        <div class="col-icon">
                            {{-- <b>Nome</b> --}}
                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
    
                        </div>
                        {{$resume->created_at ? $resume->created_at->format('d/m/Y'): 'N/Infor.'}}
                    </li>
                    <li class="col-nome">
                        <div class="col-info">
                            <span class="info-nome">
                                <strong>{{ $resume->informacoesPessoais->nome ?? '' }}</strong>
                            </span>
                            @if ($idadeEmMeses > $limiteEmMeses)
                                <p class="badge bg-danger">{{ $idadeFormatada }}</p>
                            @else
                                <p class="badge bg-light text-dark">{{ $idadeFormatada }}</p>
                            @endif

                             @switch($resume->status)
                                    @case('ativo')
                                        <p class="badge-status badge-ativo">Disponível</p>
                                        @break
                                    @case('inativo')
                                        <p class="badge-status badge-inativo" >Inativo</p>
                                        @break
                                    @case('processo')
                                        <p class="badge-status badge-processo" >Em processo</p>
                                        @break
                                    @case('contratado')
                                        <p class="badge-status badge-contratado">Contratado</p>
                                        @break                           
                                        
                                @endswitch 

                        </div>

                    </li>
                    <li class="col-cpf">
                        @php
                            $cpf = $resume->informacoesPessoais->cpf ?? '';
                            if ($cpf) {
                                $cpf = preg_replace('/\D/', '', $cpf);
                                if (strlen($cpf) === 11) {
                                    $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
                                }
                            }
                        @endphp
                        {{ $cpf }}
                    </li>
                    <li class="col-cnh">{{ $resume->informacoesPessoais->cnh ?? '' }}</li>
                    <li class="col-tipo_cnh">{{ $resume->informacoesPessoais->tipo_cnh ?? '' }}</li>
                    <li class="col-data_nascimento">                        
                        {{ isset($resume->informacoesPessoais->data_nascimento) ? $resume->informacoesPessoais->data_nascimento->format('d/m/Y') : '' }}
                    </li>
                    <li class="col-nacionalidade">{{ $resume->informacoesPessoais->nacionalidade ?? '' }}</li>
                    <li class="col-estado_civil">{{ $resume->informacoesPessoais->estado_civil ?? '' }}</li>
                    <li class="col-possui_filhos">{{ $resume->informacoesPessoais->possui_filhos ?? '' }}</li>
                    <li class="col-filhos_sim">{{ $resume->informacoesPessoais->filhos_sim ?? '' }}</li>
                    <li class="col-genero">                        
                        @switch($resume->informacoesPessoais->sexo)
                            @case('Mulher')
                                Feminino
                                @break
                            @case('Homem')
                                Masculino
                                @break                            
                            @default
                                Outro
                                
                        @endswitch                       

                    <li class="col-genero_outro">{{ $resume->informacoesPessoais->sexo_outro ?? ''}}</li>
                    
                    <li class="col-pcd">{{ $resume->informacoesPessoais->pcd ?? '' }}</li>
                    <li class="col-pcd_sim">{{ $resume->informacoesPessoais->pcd_sim ?? '' }}</li>
                    <li class="col-reservista">{{ $resume->informacoesPessoais->reservista ?? ''}}</li>
                    <li class="col-endereco">{{isset($resume->contato->logradouro) ? $resume->contato->logradouro : ''}} , {{ isset($resume->contato->numero) ? $resume->contato->numero : '' }} - {{ isset($resume->contato->bairro) ? $resume->contato->bairro : '' }}</li>
                    <li class="col-cidade">{{ isset($resume->contato->cidade) ? $resume->contato->cidade : '' }}</li>
                    <li class="col-uf">{{ isset($resume->contato->uf) ? $resume->contato->uf : ''}}</li>
                    <li class="col-email">                        
                        {{ $resume->contato->email ?? '' }}
                    </li>
                    <li class="col-telefone_celular">
                        @php
                            $celular = $resume->contato->telefone_celular ?? '';
                            if ($celular) {
                                $celular = preg_replace('/\D/', '', $celular);
                                if (strlen($celular) === 11) {
                                    // Formato: (11) 99999-9999
                                    $celular = '(' . substr($celular, 0, 2) . ') ' . substr($celular, 2, 5) . '-' . substr($celular, 7, 4);
                                } elseif (strlen($celular) === 10) {
                                    // Formato: (11) 9999-9999 (celular antigo)
                                    $celular = '(' . substr($celular, 0, 2) . ') ' . substr($celular, 2, 4) . '-' . substr($celular, 6, 4);
                                }
                            }
                        @endphp
                        {{ $celular }}
                    </li>
                    <li class="col-telefone_recado">
                        @php
                            $residencial = $resume->contato->telefone_residencial ?? '';
                            if ($residencial) {
                                $residencial = preg_replace('/\D/', '', $residencial);
                                if (strlen($residencial) === 10) {
                                    // Formato: (11) 3333-4444
                                    $residencial = '(' . substr($residencial, 0, 2) . ') ' . substr($residencial, 2, 4) . '-' . substr($residencial, 6, 4);
                                } elseif (strlen($residencial) === 11) {
                                    // Caso tenha 11 dígitos (com 9 na frente)
                                    $residencial = '(' . substr($residencial, 0, 2) . ') ' . substr($residencial, 2, 5) . '-' . substr($residencial, 7, 4);
                                }
                            }
                        @endphp
                        {{ $residencial }}
                    </li>
                    <li class="col-nome_recado">{{ $resume->contato->nome_contato ?? ''}}</li>
                    <li class="col-instagram">{{ $resume->informacoesPessoais->instagram ?? ''}}</li>
                    <li class="col-linkedin">{{ $resume->informacoesPessoais->linkedin ?? ''}}</li>
                    <li class="col-vaga">
                        <b>Tipo de Vaga</b>
                        
                        @if ($resume->vagas_interesse && is_array($resume->vagas_interesse))
                            @foreach ($resume->vagas_interesse as $vaga)
                                <p>{{$vaga}}</p>
                            @endforeach                            
                        @else
                            Nenhuma vaga de interesse informada.
                        @endif
                        
                    </li>
                    <li class="col-experiencia_profissional">
                        <b>Experiência Profissional</b>
                        
                        @if ($resume->experiencia_profissional && is_array($resume->experiencia_profissional))
                            @foreach ($resume->experiencia_profissional as $experiencia)
                                <p>{{$experiencia}}</p>
                            @endforeach                            
                        @else
                            Nenhuma vaga de interesse informada.
                        @endif
                        
                    </li>
                    <li class="col-formacao">
                        @if (isset($resume->escolaridade->escolaridade) && is_array($resume->escolaridade->escolaridade))
                            @foreach ($resume->escolaridade->escolaridade as $formacao)
                                <p>{{$formacao}}</p>
                            @endforeach                            
                        @else
                            Nenhuma formação informada.
                        @endif
                    </li>
                    <li class="col-formacao_complemento">
                        @if (isset($resume->escolaridade->escolaridade_outro))
                            <p><strong>Curso: </strong>{{$resume->escolaridade->escolaridade_outro}}</p>
                            @if ($resume->escolaridade->semestre) <p><strong>Semestre: </strong>{{$resume->escolaridade->semestre}}</p> @endif
                            @if($resume->escolaridade->instituicao) <p><strong>Instituição: </strong>{{$resume->escolaridade->instituicao}}</p> @endif
                        @endif
                    </li>
                    <li class="col-superior_periodo">{{ $resume->escolaridade->superior_periodo ?? ''}}</li>
                    <li class="col-jovem-aprendiz">{{ $resume->foi_jovem_aprendiz ?? ''}}</li>
                     <li class="col-informatica">
                        <b>Informática</b>
                        {{ $resume->escolaridade->informatica ?? '' }}
                    </li>
                    <li class="col-ingles">
                        <b>Inglês</b>
                        {{ $resume->escolaridade->ingles ?? '' }}
                    </li>
                    <li class="col-cras">{{ $resume->cras ?? '' }}</li>
                    <li class="col-cras">{{ $resume->fonte ?? '' }}</li>
 
                    {{-- <li class="col-rg">
                        @php
                            $rg = $resume->informacoesPessoais->rg ?? '';
                            if ($rg) {
                                $rg = preg_replace('/\D/', '', $rg);
                                if (strlen($rg) === 9) {
                                    $rg = substr($rg, 0, 2) . '.' . substr($rg, 2, 3) . '.' . substr($rg, 5, 3) . '-' . substr($rg, 8, 1);
                                }
                            }
                        @endphp
                        {{ $rg }}
                    </li> --}}
                    
                    {{-- <li class="col-tamanho_uniforme">
                        <b>Informática</b>
                        {{ $resume->informacoesPessoais->tamanho_uniforme ?? '' }}
                    </li> --}}
                   
                    
                    <li class="col-entrevistado">
                        <b>Entrevista</b>
                        @if ($resume->interview)
                            <a href="{{ route('interviews.show', $resume->interview->id) }}#form-interview" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        @else
                            <a href="{{ route('interviews.interviewResume', $resume) }}#form-interview"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        @endif
                    </li>
                    <li class="col-status">
                        <b>Status</b>                    

                        
                        @switch($resume->status)
                            @case('ativo')
                                <i class="status-ativo" title="Disponível"></i>Disponível
                                @break
                            @case('inativo')
                                <i class="status-inativo" title="Inativo"></i>Inativo
                                @break
                            @case('processo')
                                <i class="status-em-processo" title="Em processo"></i>Em processo
                                @break
                            @case('contratado')
                                <i class="status-contratado" title="Contratado"></i>Contratado
                                @break                           
                                
                        @endswitch
                        
                    </li>

                </ul>
                @endforeach

            @else
            <span class="sem-resultado">Nenhum currículo encontrado</span>
            @endif

            
        </div>
        <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper">
            {{ $resumes->appends(request()->query())->links('vendor.pagination.custom') }}
            <p class="pagination-info mt-3">Mostrando {{ $resumes->firstItem() }} a {{ $resumes->lastItem() }} de {{ $resumes->total() }} currículos</p>
        </div>

    </article>

    

    <article class="f4 bts-interna">
        <a href="{{ route('resumes.create') }}" class="btInt btCadastrar">Cadastrar <small>Criar um novo currículo</small></a>
        @if (Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com')
            <a href="{{ route('reports.export.resumes') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        @endif
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>
</section>
@endsection


@push('scripts-custom')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>

$(document).ready(function(){
    // Inicializa o Select2
    $('.bloco-filtros .select2').select2({
        placeholder: "Selecione",
    });

    $('#cidade').select2({
        //placeholder: 'Todas as cidades (selecione para filtrar)',        
        width: '100%',
        closeOnSelect: true,
        allowClear: true
    });

    $('#cpf').mask('000.000.000-00');
    // $('cidade').select2();

    // $('cidade').on('select2:opening select2:closing', function( event ) {
    //     var $searchfield = $(this).parent().find('.select2-search__field');
    //     $searchfield.prop('disabled', true);
    // });

    // Botão limpar - redireciona para URL sem parâmetros
    $('button[name="limpar"]').on('click', function(e){
        e.preventDefault();
        window.location.href = "{{ route('resumes.index') }}";
    });

    // Atualiza filtros ativos quando a página carrega
    updateActiveFilters();
});

// Função para mostrar filtros ativos
function updateActiveFilters(){
    let params = new URLSearchParams(window.location.search);
    let activeFilters = [];
    let filtersContainer = $('.bloco-filtros-ativos span');
    filtersContainer.empty(); // Limpa os filtros anteriores

    params.forEach((value, key) => {
        // Ignora parâmetros de paginação e vazios
        if( key !== 'page' && value && value !== 'Todos' && value !== 'Todas'){
            // Para arrays (selects múltiplos)
            if (key.endsWith('[]')){
                //activeFilters.push(createFilterBadge(key.replace('[]', ''), value));
                activeFilters.push(createFilterBadge(key, value));
            } else {
                activeFilters.push(createFilterBadge(key, value));
            }
        }
    });

    if(activeFilters.length > 0) {
        filtersContainer.append(activeFilters);
        $('.bloco-filtros-ativos').slideDown(150);
    } else {
        $('.bloco-filtros-ativos').slideUp(150);
    }
}

// Cria um badge para cada filtro com botão de remover
function createFilterBadge(key, value) {
    // Cria um elemento span para o badge
    let badge = $('<span class="filter-badge"></span>');

    // Adiciona o valor do filtro
    badge.append(document.createTextNode(value));

    // Adciona o botão de remover (x)
    let removeBtn = $('<button class="remove-filter" data-key="'+key+'" data-value="'+value+'">x</button>');
    badge.append(removeBtn);

    return badge;
}

// Remove um filtro especifico e recarrega a pagina
$(document).on('click', '.remove-filter', function(){
    let key = $(this).data('key');
    let value = $(this).data('value');
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);

    // Para filtros multiplos (array)
    if (key.endsWith('[]')){
        let currentValues = params.getAll(key);
        let newValues = currentValues.filter(v => v !== value);

        // Remove o parametro completamente se não houver mais valores
        params.delete(key);
        newValues.forEach(v => params.append(key, v));
    }
    // Para filtro simples
    else {
        params.delete(key);
    }

    // Remove também a página para voltar a primeira
    params.delete('paga');

    // Atualiza a URL e recarrega
    window.location.href = url.pathname + '?' + params.toString();

});

//////////
class TableSorter {
    constructor(containerSelector) {
        this.container = document.querySelector(containerSelector);
        this.headerRow = this.container.querySelector('.tit-lista');
        this.dataRows = Array.from(this.container.querySelectorAll('ul:not(.tit-lista)'));
        this.currentSort = { column: null, direction: null };
        
        this.init();
    }
    
    init() {
        // Adicionar event listeners para cada coluna ordenável
        const sortableHeaders = this.headerRow.querySelectorAll('.sortable');
        
        sortableHeaders.forEach(header => {
            header.addEventListener('click', (e) => {
                this.handleSort(e.target);
            });
        });
    }
    
    handleSort(clickedHeader) {
        const column = clickedHeader.dataset.column;
        const dataType = clickedHeader.dataset.type || 'text';
        
        // Determinar direção da ordenação
        let direction = 'asc';
        if (this.currentSort.column === column) {
            direction = this.currentSort.direction === 'asc' ? 'desc' : 'asc';
        }
        
        // Remover classes de ordenação de todos os headers
        this.headerRow.querySelectorAll('.sortable').forEach(h => {
            h.classList.remove('asc', 'desc');
        });
        
        // Adicionar classe ao header atual
        clickedHeader.classList.add(direction);
        
        // Realizar a ordenação
        this.sortData(column, direction, dataType);
        
        // Atualizar estado atual
        this.currentSort = { column, direction };
    }
    
    sortData(column, direction, dataType) {
        // Adicionar classe visual durante ordenação
        this.container.classList.add('sorting');
        
        const columnIndex = this.getColumnIndex(column);
        
        // Ordenar os dados
        this.dataRows.sort((a, b) => {
            const aValue = this.getCellValue(a, columnIndex);
            const bValue = this.getCellValue(b, columnIndex);
            
            let comparison = this.compareValues(aValue, bValue, dataType);
            
            return direction === 'desc' ? -comparison : comparison;
        });
        
        // Reordenar os elementos no DOM
        setTimeout(() => {
            this.dataRows.forEach(row => {
                this.container.appendChild(row);
            });
            
            // Remover classe visual
            this.container.classList.remove('sorting');
        }, 100);
    }
    
    getColumnIndex(column) {
        const headers = Array.from(this.headerRow.children);
        return headers.findIndex(header => header.dataset.column === column);
    }
    
    getCellValue(row, columnIndex) {
        const cell = row.children[columnIndex];
        if (!cell) return '';
        
        // Para colunas com estrutura complexa (como nome com badge)
        if (cell.querySelector('.info-nome strong')) {
            return cell.querySelector('.info-nome strong').textContent.trim();
        }
        
        // Para colunas com ícones de status
        if (cell.textContent.includes('Disponível')) return 'Disponível';
        if (cell.textContent.includes('Em processo')) return 'Em processo';
        if (cell.textContent.includes('Contratado')) return 'Contratado';
        if (cell.textContent.includes('Inativo')) return 'Inativo';
        
        return cell.textContent.trim();
    }
    
    compareValues(a, b, dataType) {
        if (a === '' && b === '') return 0;
        if (a === '') return 1;
        if (b === '') return -1;
        
        switch (dataType) {
            case 'date':
                return this.compareDates(a, b);
            case 'number':
                return this.compareNumbers(a, b);
            case 'text':
            default:
                return a.localeCompare(b, 'pt-BR', { 
                    numeric: true, 
                    sensitivity: 'base' 
                });
        }
    }
    
    compareDates(a, b) {
        // Converte datas no formato DD/MM/YYYY para objeto Date
        const parseDate = (dateStr) => {
            if (!dateStr || dateStr === '-') return new Date(0);
            const parts = dateStr.split('/');
            if (parts.length === 3) {
                return new Date(parts[2], parts[1] - 1, parts[0]);
            }
            return new Date(dateStr);
        };
        
        const dateA = parseDate(a);
        const dateB = parseDate(b);
        
        return dateA.getTime() - dateB.getTime();
    }
    
    compareNumbers(a, b) {
        const numA = parseFloat(a.replace(/[^\d.-]/g, '')) || 0;
        const numB = parseFloat(b.replace(/[^\d.-]/g, '')) || 0;
        return numA - numB;
    }
}

// Inicializar o sistema de ordenação quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    const sorter = new TableSorter('.lista-curriculos');
    
    console.log('Sistema de ordenação inicializado!');
});

// Função auxiliar para reinicializar após mudanças AJAX (se necessário)
window.reinitTableSorter = function() {
    new TableSorter('.lista-curriculos');
};




</script>
@endpush



@push('css-custom')
<style>
.subtitulo{
    font-weight: 500;
    font-size: 12px;
    color: #aaa;
}
.btInt{
flex-wrap: nowrap;
}

.lista-curriculos{
    overflow: scroll;
    height: 500px;
}

.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}
.bloco-filtros .col-12{
    margin-bottom: 11px;
}
.bloco-filtros .col-12 .form-label {
    width: 100%;
    margin: 0 !important;
    font-weight: 700;
    padding-bottom: 7px;
    color: #333333;
}

/* Estilo dos badges de filtro*/
.bloco-filtros-ativos {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    font-weight: 700;
    font-size: 12px;
    margin: 10px 0;
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    -ms-border-radius: 20px;
    padding: 3px 14px;
    background-color: #F2F2F2;
    letter-spacing: normal;
}

.filter-badge {
    display: inline-block;
    margin-right: 8px;   
    padding: 5px 10px;
    padding-left: 24px;
    background: #fff;
    border-radius: 15px;
    font-size: 12px;
    position: relative;
}

.remove-filter {
    margin-left: 5px;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0 5px;
    color: #ff0000;
    font-size: 15px;
    position: absolute;
    top: 3px;
    left: 0;
    font-weight: 700;
    font-family: 'Montserrat';
    line-height: 1em;
}

.remove-filter:hover {
    color: #dc3545;
}




/* css paginate */
/* Em seu arquivo CSS */
.pagination-container {
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    display: block;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.2s;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #fff;
    border-color: #ddd;
}

.page-link:hover {
    background-color: #f8f9fa;
}

.btn-cancelar{
    padding: 10px 30px;
}



/* Estilo responsivo */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
    }
    
    .page-item {
        margin-bottom: 5px;
    }
}

.table-container.lista-curriculos {
    width: 100%;
    overflow-x: auto; /* Habilita scroll horizontal quando necessário */
    overflow-y: auto; /* Mantém o scroll vertical */
    white-space: nowrap; /* Impede que o conteúdo quebre em várias linhas */
    -webkit-overflow-scrolling: touch; /* Melhora o scroll em dispositivos móveis */
}

.tit-lista, .lista-curriculos > ul {
    min-width: 100%; /* Garante que a largura mínima seja 100% do container */
    display: inline-block; /* Ou você pode usar display: flex */
}

/* Se estiver usando flexbox (opcional) */
.tit-lista {
    display: flex;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
}



.lista-curriculos > ul {
    display: flex;
}



.tit-lista {
    display: flex;
    flex-wrap: nowrap; /* Isso é essencial! */
}

.tit-lista li {
    flex-shrink: 0; /* Impede que os itens encolham */    
}

.lista-curriculos > ul {
    display: flex;
    flex-wrap: nowrap;
}

.lista-curriculos > ul > li {
    flex-shrink: 0;
    margin-right: 10px;
   
}

.table-container.lista-curriculos ul{
    width: fit-content;
}








/* Tabela nova */
#tabela-curriculo tbody tr:nth-child(even){
    background-color: #FCFCFC;
}

#tabela-curriculo tbody tr{
    border-radius: 50px;
}
#tabela-curriculo tbody tr:hover{
    background-color: #f7f7f7 !important;
}


#tabela-curriculo thead tr,
#tabela-curriculo tbody tr{
    display: flex;
    align-items: center;
}







/* coluna data inscricao */



.col-icon{
margin-right: 10px;
}

.col-inscricao{
    width: 130px;
    
}




/* coluna nome */
.col-nome{
    min-width: 350px !important;
    
}

.col-info{
    position: relative;
    /* margin-left: 15px; */
}

p.badge{
    position: absolute;
    top: -18px;
    right: -30px;
}

/* coluna email */
.col-email{
    min-width: 350px !important;
}

.col-data_nascimento{
    width: 160px;
}

.col-rg{
    width: 160px;
}
.col-cpf{
    width: 160px;
}

.col-estado_civil{
    width: 160px;
}
.col-possui_filhos{
    width: 160px;
}
.col-instagram{
    width: 160px;
}
.col-linkedin{
    width: 200px;
    min-width: 150px !important;
    white-space: pre-wrap;
    overflow: hidden;
}
.col-telefone_celular{
    min-width: 200px !important;
}
.col-telefone_recado{
    min-width: 200px !important;
}
.col-nome_recado{
    min-width: 200px !important;
}

.col-endereco{
    width: 300px;
    min-width: 300px !important;
    white-space: pre-wrap;
}
.col-cidade{
    width: 100px;
}
.col-uf{
    width: 50px;
}


/* coluna vaga */
.col-vaga{
    width: 350px;
    min-width: 350px !important;
    overflow: hidden;
}

.col-vaga p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-experiencia_profissional{
    width: 350px;
    min-width: 350px !important;
    overflow: hidden;
}

.col-experiencia_profissional p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-tamanho_uniforme{
    width: 200px;
}


/* coluna cnh */
.col-cnh{
    width: 100px;
}

/* coluna genero */
.col-genero{
    width: 100px;
}

/* coluna reservista */
.col-reservista{
    width: 115px;
}

.col-jovem-aprendiz{
    min-width: 300px !important;
}

.col-formacao{
    min-width: 350px !important;
    white-space: pre-wrap;
}

.col-formacao_complemento{
    min-width: 350px !important;
    white-space: pre-wrap;
}
.col-informatica{
    min-width: 350px !important;
    white-space: pre-wrap;
}
.col-ingles{
    min-width: 350px !important;
    white-space: pre-wrap;

}
.col-entrevistado{
    width: 115px;
    display: flex;
    justify-content: center;
}

.col-entrevistado a{
    width: auto;
    padding: 5px;
}

.col-status{
    width: 100px;
}

.col-status i{
    margin-right: 10px;
}

.col-filhos_sim, .col-genero_outro, .col-tipo_cnh, 
.col-pcd, .col-pcd_sim, .col-superior_periodo, .col-cras{
    width: 200px;
    white-space: pre-wrap;
}

.col-nacionalidade{
    width: 150px;
    white-space: pre-wrap;
}

/******** CSS Personalizado **********/
        .sortable {
            cursor: pointer;
            position: relative;
            padding-right: 20px;
            user-select: none;
        }
        
        .sortable:hover {
            /* background-color: #f8f9fa; */
        }
        
        .sortable::after {
            content: "↕";
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.5;
            font-size: 20px;
        }
        
        .sortable.asc::after {
            content: "↑";
            opacity: 1;
            color: #007bff;
        }
        
        .sortable.desc::after {
            content: "↓";
            opacity: 1;
            color: #007bff;
        }
        
        /* Animação suave para reordenação */
        .lista-curriculos ul {
            transition: all 0.3s ease;
        }
        
        /* Destaque visual durante ordenação */
        .sorting {
            opacity: 0.7;
        }
        
        /* Estilos base para demonstração */
        /* .table-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow-x: auto;
        } */
        
        .tit-lista {
            /* background-color: #f8f9fa; */
            font-weight: bold;
            /* border-bottom: 2px solid #ddd; */
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
        }
        
        .tit-lista li {
            padding: 10px 8px;
            /* border-right: 1px solid #ddd; */
            flex: 1;
            min-width: 100px;
        }
        
        .lista-curriculos ul:not(.tit-lista) {
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
            /* border-bottom: 1px solid #eee; */
        }
        
        .lista-curriculos ul:not(.tit-lista):hover {
            /* background-color: #f8f9fa; */
        }
        
        .lista-curriculos ul:not(.tit-lista) li {
            padding: 8px;
            /* border-right: 1px solid #eee; */
            flex: 1;
            min-width: 100px;
            /* font-size: 12px; */
        }
        
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .bg-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .bg-light {
            background-color: #f8f9fa;
            color: #212529;
        }
        
        .text-success {
            color: #28a745;
        }
        
        .text-danger {
            color: #dc3545;
        }
        
        .fw-bold {
            font-weight: bold;
        }

        /* .badge-status{
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
            color: white;
            width: fit-content;
            font-weight: 600;            
        }
        .badge-ativo{
            background-color: #6c757d;
        }
        .badge-inativo{
            background-color: #dc3545;
        }
        .badge-processo{
            background-color: yellow;
            color: #333333;
        }

        .badge-contratado{
            background-color: #28a745;
        } */



        /* Indicadores de status */
        /* .status-ativo::before { content: "●"; color: #28a745; margin-right: 5px; }
        .status-inativo::before { content: "●"; color: #6c757d; margin-right: 5px; }
        .status-em-processo::before { content: "●"; color: #ffc107; margin-right: 5px; }
        .status-contratado::before { content: "●"; color: #007bff; margin-right: 5px; } */

/* Css do multiple select */

.select2-container--default .select2-selection--multiple .select2-selection__choice{
    display: flex;
    width: fit-content;
    height: 30px;
    align-items: center;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
    height: 30px;
    display: flex;
    align-items: center;
}

.select2-container--default.select2-container--focus .select2-selection--multiple{
    border: solid #cacaca 1px;
    
}
.select2-container--default .select2-selection--multiple{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
    border: solid #cacaca 1px;
}

.select2-container .select2-selection--multiple .select2-selection__rendered{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
    width: fit-content
}

.select2-container--default .select2-search--inline .select2-search__field{
    height: 30px;
    display: flex;
    box-shadow: none !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__clear{
    display: none;
}

/*filtro*/
.container-filtros{
    height: 500px;
    overflow-y: auto
}



</style>
@endpush