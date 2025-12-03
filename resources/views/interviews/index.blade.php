@extends('layouts.app')

@section('content')
<section class="cabecario">

    <h1>Entrevistas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroEntrevistas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-interviews" method="GET" action="{{route('interviews.index')}}" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroInterview">

                <div class="row d-flex container-filtros">

                    <div class="col-12 mb-3">
                        <label for="nome" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Nome do Candidato</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}" placeholder="Buscar por nome...">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="celular" class="form-label">4 últimos dígitos do Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control" value="{{ request('celular') }}" placeholder="Ex: 9999">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="telefone_contato" class="form-label">4 últimos dígitos do Tel. Contato</label>
                        <input type="text" name="telefone_contato" id="telefone_contato" class="form-control" value="{{ request('telefone_contato') }}" placeholder="Ex: 9999">
                    </div>
                     <div class="col col-6 mb-4">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"  value="{{ request('cpf') }}" placeholder="000.000.000-00" maxlength="14">
                            @error('cpf') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col col-6 mb-4">
                        <div class="form-group">
                            <label class="form-label">Ordenação:</label>
                            <select name="ordem" class="form-select select2" onchange="this.form.submit()">
                                <option value="desc" {{ $ordem == 'desc' ? 'selected' : '' }}>Mais Recente</option>
                                <option value="asc" {{ $ordem == 'asc' ? 'selected' : '' }}>Mais Antigo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-6 mb-4">
                        <label for="min_age" class="form-label">Idade mínima:</label>
                        <input type="number" name="min_age" id="min_age" class="form-control" value="{{ request('min_age')}}" >
                    </div>
                    <div class="col col-6 mb-4">
                        <label for="max_age" class="form-label">Idade máxima:</label>
                        <input type="number" name="max_age" id="max_age" class="form-control" value="{{ request('max_age')}}" >
                    </div>

                    <div class="col-6">
                        <label for="vagas_interesse" class="form-label">Vagas de Interesse</label>
                        <select name="vagas_interesse[]" id="vagas_interesse" class="form-select" multiple>
                            @foreach (  
                                        ['Administrativo', 'Copa & Cozinha', 'Camareiro(a) de Hotel', 
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
                                        ['Nenhuma por enquanto', 'Administrativo','Copa & Cozinha', 'Camareiro(a) de Hotel', 
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
                        <select name="status" id="status" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }} > Disponível</option>
                            <option value="processo" {{ request('status') == 'processo' ? 'selected' : '' }}> Em processo</option>
                            <option value="contratado" {{ request('status') == 'contratado' ? 'selected' : '' }} > Contratado</option>
                            <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}> Inativo</option>
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
                        <select name="sexo" id="sexo" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Homem" {{ request('sexo') == 'Homem' ? 'selected' : '' }}> Homem</option>
                            <option value="Mulher" {{ request('sexo') == 'Mulher' ? 'selected' : '' }}> Mulher</option>
                            <option value="Prefiro não dizer" {{ request('sexo') == 'Prefiro não dizer' ? 'selected' : '' }}> Prefiro não dizer</option>
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

                    {{-- <div class="col-6">
                        <label for="cnh" class="form-label">Possui CNH?</label>
                        <select name="cnh" id="cnh" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim"  {{ request('cnh') == 'Sim' ? 'selected' : '' }}> Sim</option>
                            <option value="Não"  {{ request('cnh') == 'Não' ? 'selected' : '' }}> Não</option>
                            <option value="Em andamento"  {{ request('cnh') == 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                        </select>
                    </div> --}}

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

                    
                    {{-- <div class="col-6">
                        <label for="reservista" class="form-label">Possui Reservista?</label>
                        <select name="reservista" id="reservista" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" {{ request('reservista') == 'Sim' ? 'selected' : '' }}> Sim</option>
                            <option value="Não" {{ request('reservista') == 'Não' ? 'selected' : '' }}> Não</option>
                            <option value="Em andamento" {{ request('reservista') == 'Em andamento' ? 'selected' : '' }}> Em andamento</option>
                        </select>
                    </div> --}}

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

                    {{-- <div class="col-6">
                        <label for="foi_jovem_aprendiz" class="form-label">Já foi Jovem Aprendiz?</label>
                        <select name="foi_jovem_aprendiz" id="foi_jovem_aprendiz" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim, da ASPPE"  {{ request('foi_jovem_aprendiz') == 'Sim, da ASPPE' ? 'selected' : '' }}> Sim, da ASPPE</option>
                            <option value="Sim, de Outra Qualificadora"  {{ request('foi_jovem_aprendiz') == 'Sim, de Outra Qualificadora' ? 'selected' : '' }}> Sim, de Outra Qualificadora</option>
                            <option value="Não"  {{ request('foi_jovem_aprendiz') == 'Não' ? 'selected' : '' }}> Não</option>
                        </select>
                    </div> --}}

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
                     <div class="col-6">
                        <label for="perfil" class="form-label">Perfil?</label>
                        <div class="form-check">
                            @foreach (['ADMINISTRATIVO', 'OPERACIONAL','ADM / OPERACIONAL'] as $option)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="perfil[]" 
                                        id="perfil{{ $loop->index }}" value="{{ $option }}"
                                        {{ in_array($option, request('perfil', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="perfil{{ $loop->index }}">
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
                        <select name="escolaridade" id="escolaridade" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Ensino Fundamental Completo" {{ request('escolaridade') == 'Ensino Fundamental Completo' ? 'selected' : '' }}> Ensino Fundamental Completo</option>
                            <option value="Ensino Fundamental Cursando" {{ request('escolaridade') == 'Ensino Fundamental Cursando' ? 'selected' : '' }}> Ensino Fundamental Cursando</option>
                            <option value="Ensino Médio Completo" {{ request('escolaridade') == 'Ensino Médio Completo' ? 'selected' : '' }}> Ensino Médio Completo</option>
                            <option value="Ensino Médio Incompleto" {{ request('escolaridade') == 'Ensino Médio Incompleto' ? 'selected' : '' }}>  Ensino Médio Cursando</option>
                            <option value="Ensino Técnico Completo" {{ request('escolaridade') == 'Ensino Técnico Completo' ? 'selected' : '' }}> Ensino Técnico Completo</option>
                            <option value="Ensino Técnico Cursando" {{ request('escolaridade') == 'Ensino Técnico Cursando' ? 'selected' : '' }}> Ensino Técnico Cursando</option>
                            <option value="Superior Completo" {{ request('escolaridade') == 'Superior Completo' ? 'selected' : '' }}> Superior Completo</option>
                            <option value="Superior Cursando" {{ request('escolaridade') == 'Superior Cursando' ? 'selected' : '' }}> Superior Cursando</option>
                            <option value="Outro" {{ request('escolaridade') == 'Outro' ? 'selected' : '' }}> Outro</option>
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

                    {{-- <div class="col-6">
                        <label for="informatica" class="form-label">Possui conhecimento no pacote Office (Excel/Word)?</label>
                        <select name="informatica" id="informatica" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" {{ request('informatica') == 'Básico' ? 'selected' : '' }}> Básico</option>
                            <option value="Intermediário" {{ request('informatica') == 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                            <option value="Avançado" {{ request('informatica') == 'Avançado' ? 'selected' : '' }}> Avançado</option>
                            <option value="Nenhum" {{ request('informatica') == 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                        </select>
                    </div> --}}

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

                    {{-- <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Básico" {{ request('ingles') == 'Básico' ? 'selected' : '' }}> Básico</option>
                            <option value="Intermediário" {{ request('ingles') == 'Intermediário' ? 'selected' : '' }}> Intermediário</option>
                            <option value="Avançado" {{ request('ingles') == 'Avançado' ? 'selected' : '' }}> Avançado</option>
                            <option value="Nenhum" {{ request('ingles') == 'Nenhum' ? 'selected' : '' }}> Nenhum</option>
                        </select>
                    </div> --}}

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

                    <!-- <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade[]" class="form-select select2" multiple>
                            {{-- <option>Todas</option> --}}
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade }}" 
                                    {{ is_array(request('cidade')) && in_array( $cidade, request('cidade')) ? 'selected' : '' }}>
                                    {{ $cidade }}
                                </option>
                            @endforeach
                            @php
                            //echo get_cidades($resumes, 3);
                            @endphp
                        </select>
                    </div> -->

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

                    {{-- <div class="col-6 mb-4">
                        <label for="ingles" class="form-label">PCD</label>
                        <select name="pcd" id="pcd" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim, com laudo." {{ request('pcd') == 'Sim, com laudo.' ? 'selected' : '' }}> Sim, com laudo.</option>
                            <option value="Sim, sem laudo." {{ request('pcd') == 'Sim, sem laudo.' ? 'selected' : '' }}> Sim, sem laudo.</option>
                            <option value="Não" {{ request('pcd') == 'Não' ? 'selected' : '' }}> Não</option>                            
                        </select>
                    </div> --}}

                    <div class="col-6 mb-4">
                        <label for="ingles" class="form-label">Sua família é atendida por algum equipamento do governo?</label>
                        <select name="cras" id="cras" class="form-select select2">
                            <option value="">Todos</option>
                            <option value="Sim" {{ request('cras') == 'Sim' ? 'selected' : '' }}> Sim</option>                            
                            <option value="Não" {{ request('cras') == 'Não' ? 'selected' : '' }}> Não</option>                            
                        </select>
                    </div>

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
                    <hr>
                    {{-- Parecer entrevistador --}}
                    <div class="col-12 mb-3">
                        <label for="parecer_recrutador" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Parecer do entrevistador</label>
                        <input type="text" name="parecer_recrutador" id="parecer_recrutador" class="form-control" value="{{ request('parecer_recrutador') }}" placeholder="Palavras chaves..">
                    </div>

                    {{-- Habilidades --}}
                    <div class="col-12 mb-3">
                        <label for="habilidades" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Habilidades</label>
                        <input type="text" name="habilidades" id="habilidades" class="form-control" value="{{ request('habilidades') }}" placeholder="Palavras chaves..">
                    </div>

                    {{-- Apresentação Pessoal --}}
                    <div class="col-12 mb-3">
                        <label for="apresentacao_pessoal" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Apresentação Pessoal</label>
                        <input type="text" name="apresentacao_pessoal" id="apresentacao_pessoal" class="form-control" value="{{ request('apresentacao_pessoal') }}" placeholder="Palavras chaves..">
                    </div>

                    {{-- Caracteristicas positivas --}}
                    <div class="col-12 mb-3">
                        <label for="caracteristicas_positivas" class="form-label" style="font-weight: 700; color:#333; padding-bottom: 7px;">Características Positivas</label>
                        <input type="text" name="caracteristicas_positivas" id="caracteristicas_positivas" class="form-control" value="{{ request('caracteristicas_positivas') }}" placeholder="Palavras chaves..">
                    </div>

                    
                    {{-- <div class="col">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">Todos</option>
                            <option value="ativo"  {{ request('status') == 'ativo' ? 'selected' : '' }}> Disponível</option>
                            <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}> Inativo</option>
                            <option value="processo" {{ request('status') == 'processo' ? 'selected' : '' }}> Em processo</option>
                            <option value="contratado" {{ request('status') == 'contratado' ? 'selected' : '' }}> Contratado</option>
                        </select>
                    </div> --}}

                    {{-- <div class="col">
                        <label for="entrevistado" class="form-label">Entrevistado</label>
                        <select name="entrevistado" id="entrevistado" class="form-select">
                            <option>Todos</option>
                            <option value="1" {{ request('entrevistado') == '1' ? 'selected' : '' }}>Já entrevistado</option>
                            <option value="0" {{ request('entrevistado') == '0' ? 'selected' : '' }}>Não entrevistado</option>
                        </select>
                    </div> --}}

                    {{-- <div class="col mb-4">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>                            
                            <option value="7" {{ request('filtro_data') == '7' ? 'selected' : '' }}>Últimos 7 dias</option>
                            <option value="15" {{ request('filtro_data') == '15' ? 'selected' : '' }}>Últimos 15 dias</option>
                            <option value="30" {{ request('filtro_data') == '30' ? 'selected' : '' }}>Últimos 30 dias</option>
                            <option value="90" {{ request('filtro_data') == '90' ? 'selected' : '' }}>Últimos 90 dias</option>
                        </select>
                    </div> --}}
                    

                    <div class="col-12 mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>
                        <a href="{{ route('interviews.index') }}" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
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

        <h4>Últimos currículos</h4>

        <div class="table-container lista-entrevistas">

            <ul class="tit-lista">
                {{-- Campos Currículo --}}
                <li class="col-entrevista sortable" data-column="entrevista" data-type="date">Entrevista</li> 
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
                {{-- <li class="col-jovem-aprendiz">Já foi jovem aprendiz?</li> --}}
                <li class="col-informatica sortable" data-column="informatica" data-type="text">Possui conhecimento no pacote Office (Excel/Word)?</li>
                <li class="col-ingles sortable" data-column="ingles" data-type="text">Inglês</li>
                <li class="col-cras sortable" data-column="cras" data-type="text">Família atendida por algum equipamento Público?</li>
                <li class="col-tamanho_uniforme sortable" data-column="tamanho_uniforme" data-type="text">Fonte Currículo</li>                                             
                {{-- <li class="col-rg">RG</li> --}}

                {{-- Campos Entrevista--}}
                <li class="col-idiomas sortable" data-column="idiomas" data-type="text">Outros idiomas?</li>
                <li class="col-apresentacao-pessoal sortable" data-column="apresentacao-pessoal" data-type="text">Apresentação Pessoal</li>
                <li class="col-saude sortable" data-column="saude" data-type="text">Saúde</li>
                <li class="col-vacina sortable" data-column="vacina" data-type="text">Vacina COVID</li>
                <li class="col-jovem-aprendiz sortable" data-column="jovem-aprendiz" data-type="text">Já foi jovem aprendiz?</li>
                <li class="col-formadora sortable" data-column="formadora" data-type="text">Formadora</li>
                <li class="col-experiencia-profissional sortable" data-column="experiencia-profissional" data-type="text">Expreriência Profissional</li>
                <li class="col-demissao sortable" data-column="demissao" data-type="text">Por qual motivo pediria demissão?</li>
                <li class="col-caracteristicas-positivas sortable" data-column="caracteristicas-positivas" data-type="text">Características Positivas</li>
                <li class="col-habilidades sortable" data-column="habilidades" data-type="text">Habilidades</li>
                <li class="col-pontos-melhoria sortable" data-column="pontos-melhoria" data-type="text">Pontos de Melhoria</li>
                <li class="col-rotina sortable" data-column="rotina" data-type="text">Qual sua rotina?</li>
                <li class="col-disponibilidade-horario sortable" data-column="disponibilidade-horario" data-type="text">Disponibilidade de Horário</li>
                <li class="col-familia sortable" data-column="familia" data-type="text">Família</li>
                <li class="col-renda_familiar sortable" data-column="renda_familiar" data-type="text">Renda Familiar</li>
                <li class="col-cras sortable" data-column="cras" data-type="text">Família recebe benefício?</li>
                <li class="col-objetivo-longo-prazo sortable" data-column="objetivo-longo-prazo" data-type="text">Objetivos longo prazo</li>
                <li class="col-porque-gostaria-jovem-aprendiz sortable" data-column="porque-gostaria-jovem-aprendiz" data-type="text">Por que ser Jovem Aprendiz?</li>
                <li class="col-fonte-curriculo sortable" data-column="fonte-curriculo" data-type="text">Fonte Captação Currículo</li>
                <li class="col-perfil-stacasa sortable" data-column="perfil-stacasa" data-type="text">Perfil Sta. Casa</li>
                <li class="col-classificacao sortable" data-column="classificacao" data-type="text">Perfil</li>
                <li class="col-status sortable" data-column="status" data-type="text">Status</li>
                <li class="col-entrevistado sortable" data-column="entrevistado" data-type="text">Entrevistado?</li>                
                <li class="col-parecer sortable" data-column="parecer" data-type="text">Parecer do RH</li>
                <li class="col-obs-entrevista sortable" data-column="obs-entrevista" data-type="text">Entrevistas</li>
                <li class="col-obs_rh sortable" data-column="obs_rh" data-type="text">Observações RH</li>


                {{-- <li class="col-obs">Obs.</li>
                <li class="col-perfil">Perfil</li>
                <li class="col-curso-extracurriculares">Cursos Extracurriculares</li>                        
                <li class="col-pretencoes-candidato">Pretenções do candidato</li>                
                <li class="col-fale-um-pouco">Fale um pouco sobre você</li>                
                <li class="col-sugestao-empresa">Sugestão Empresa</li>
                <li class="col-pontuacao">Pontuação</li> --}}

                
            </ul>

            @if ($resumes->count() > 0)

                @foreach ($resumes as $resume) 
                
                <ul class="row-list" onclick="window.open('{{ route('interviews.show', $resume->interview->id) }}', '_blank')" title="Ver ou Editar Entrevista">               
                {{-- <ul onclick="window.location='{{ $resume->interview ? route('interviews.show', $resume->interview->id) : route('interviews.interviewResume', $resume)    }}'" title="Ver ou Editar Entrevista"> --}}
                   {{-- Campos Currículo --}}
                    @php                       

                        $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                        $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                        $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';

                        //Verifica se a idade é maior que 22 anos e 7 meses
                        $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                        $limiteEmMeses = (22 * 12) + 7;
                        // dd($resume->interview->created_at->format('d/m/Y'));
                    @endphp
                    <li class="col-entrevista">
                        <div class="col-icon">
                            {{-- <b>Nome</b> --}}
                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
    
                        </div>
                        {{ $resume->interview && $resume->interview->created_at ? $resume->interview->created_at->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}
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
                    <li class="col-cnh">                       
                        {{ $resume->informacoesPessoais->cnh ?? '' }}
                    </li>
                    <li class="col-tipo_cnh">{{ $resume->informacoesPessoais->tipo_cnh ?? 'N/A' }}</li>
                     <li class="col-data_nascimento">                        
                        {{ $resume->informacoesPessoais->data_nascimento->format('d/m/Y') ?? '' }}
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
                    </li>
                    <li class="col-genero_outro">{{ $resume->informacoesPessoais->sexo_outro ?? ''}}</li>
                    
                    <li class="col-pcd">{{ $resume->informacoesPessoais->pcd ?? '' }}</li>
                    <li class="col-pcd_sim">{{ $resume->informacoesPessoais->pcd_sim ?? '' }}</li>
                    <li class="col-reservista">{{ $resume->informacoesPessoais->reservista ?? ''}}</li>
                    <li class="col-endereco">{{$resume->contato->logradouro}} , {{ $resume->contato->numero }} - {{ $resume->contato->bairro }}</li>
                    <li class="col-cidade">{{ $resume->contato->cidade }}</li>
                    <li class="col-uf">{{ $resume->contato->uf}}</li>
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
                        @if ($resume->escolaridade->escolaridade && is_array($resume->escolaridade->escolaridade))
                            @foreach ($resume->escolaridade->escolaridade as $formacao)
                                <p>{{$formacao}}</p>
                            @endforeach                            
                        @else
                            Nenhuma formação informada.
                        @endif
                    </li>
                    <li class="col-formacao_complemento">
                        @if ($resume->escolaridade->escolaridade_outro)
                            <p><strong>Curso: </strong>{{$resume->escolaridade->escolaridade_outro}}</p>
                            @if ($resume->escolaridade->semestre) <p><strong>Semestre: </strong>{{$resume->escolaridade->semestre}}</p> @endif
                            @if($resume->escolaridade->instituicao) <p><strong>Instituição: </strong>{{$resume->escolaridade->instituicao}}</p> @endif
                        @endif
                    </li>
                    <li class="col-superior_periodo">{{ $resume->escolaridade->superior_periodo ?? ''}}</li>
                     {{-- <li class="col-jovem-aprendiz">{{ $resume->foi_jovem_aprendiz ?? ''}}</li> --}}
                      <li class="col-informatica">
                        <b>Informática</b>
                        {{ $resume->escolaridade->informatica ?? '' }}
                    </li>
                    <li class="col-ingles">
                        <b>Inglês</b>
                        {{ $resume->escolaridade->ingles ?? '' }}
                    </li>
                    <li class="col-cras">{{ $resume->cras ?? '' }}</li>
                    <li class="col-tamanho_uniforme">
                        <b>Fonte Curriculo</b>
                        {{ $resume->fonte ?? '' }}
                    </li>
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
                    </li>
                     --}}
                    
                    
                    {{-- Campos Entrevista --}}
                    <li class="col-idiomas">{{ $resume->interview->outros_idiomas }}</li>
                    <li class="col-apresentacao-pessoal">{{ $resume->interview->apresentacao_pessoal }}</li>
                    <li class="col-saude">{{ $resume->interview->saude_candidato }}</li>
                    <li class="col-vacina">{{ $resume->interview->vacina_covid }}</li>
                    <li class="col-jovem-aprendiz">{{ $resume->foi_jovem_aprendiz ?? ''}}</li>
                    <li class="col-formadora">{{ $resume->interview->qual_formadora }}</li>
                    <li class="col-experiencia-profissional">{{ $resume->interview->experiencia_profissional }}</li>
                    <li class="col-demissao">{{ $resume->interview->qual_motivo_demissao }}</li>
                    <li class="col-caracteristicas-positivas">{{ $resume->interview->caracteristicas_positivas }}</li>
                    <li class="col-habilidades">{{ $resume->interview->habilidades }}</li>
                    <li class="col-pontos-melhoria">{{ $resume->interview->pontos_melhoria }}</li>
                    <li class="col-rotina">{{ $resume->interview->rotina_candidato }}</li>
                    <li class="col-disponibilidade-horario">{{ $resume->interview->disponibilidade_horario }}</li>
                    <li class="col-familia">{{ $resume->interview->familia }}</li>
                    <li class="col-renda_familiar">{{ $resume->interview->renda_familiar }}</li>
                    <li class="col-cras">{{ $resume->interview->familia_cras }}</li>
                    <li class="col-objetivo-longo-prazo">{{ $resume->interview->objetivo_longo_prazo }}</li>
                    <li class="col-porque-gostaria-jovem-aprendiz">{{ $resume->interview->porque_ser_jovem_aprendiz }}</li>
                    <li class="col-fonte-curriculo">{{ $resume->interview->fonte_curriculo }}</li>
                    <li class="col-perfil-stacasa">{{ $resume->interview->perfil_santa_casa}}</li>
                     <li class="col-classificacao">{{ $resume->interview->perfil }}</li>
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
                    <li class="col-entrevistado">
                        <b>Entrevistado</b>
                        @if ($resume->interview)
                            <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        @else
                            <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        @endif
                    </li>         
                    <li class="col-parecer">{{ $resume->interview->parecer_recrutador }}</li>   
                    <li class="col-obs-entrevista">{{ $resume->interview->observacoes }}</li>  
                    <li class="col-obs_rh">{{ $resume->interview->obs_rh }}</li>     
                    
                    
                    
                    
                    
                    {{-- <li class="col-obs">
                        <b>Obs.</b>                       
                        @if ($resume->observacoes->isNotEmpty())
                            @php
                                $observacao_recente = $resume->observacoes->sortByDesc('created_at')->first();
                            @endphp                            
                                <p class="card-text"><b>{{$observacao_recente->created_at->format('d/m/y')}}</b> - {{$observacao_recente->observacao}} </p>
                            
                        @else
                            Nenhuma observação.
                        @endif
                        
                    </li>
                    <li class="col-perfil">{{ $resume->interview->perfil}}</li>
                    <li class="col-curso-extracurriculares">{{ $resume->interview->curso_extracurricular }}</li>
                    <li class="col-pretencoes-candidato">{{ $resume->interview->pretencao_candidato }}</li>
                    <li class="col-fale-um-pouco">{{ $resume->interview->sobre_candidato }}</li>
                    <li class="col-sugestao-empresa">{{ $resume->interview->sugestao_empresa }}</li>
                    <li class="col-pontuacao">{{ $resume->interview->pontuacao }}</li> --}}
                    
                    
                    

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
        <a href="{{ route('interviews.create') }}" class="btInt btCadastrar">Entrevistar <small>Realize uma entrevista</small></a>
        @if (Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com')
            <a href="{{ route('reports.export.interviews') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>            
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
    

    //  $('#cidade').select2({
    //     placeholder: 'Selecione as cidades',
    //     allowClear: true,
    //     closeOnSelect: false // Mantém o dropdown aberto após seleção
    // });

    $('#cidade').select2({
        //placeholder: 'Todas as cidades (selecione para filtrar)',        
        width: '100%',
        closeOnSelect: true,
        allowClear: true
    });

    $('#cpf').mask('000.000.000-00');
    

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
    const sorter = new TableSorter('.lista-entrevistas');
    
    console.log('Sistema de ordenação inicializado!');
});

// Função auxiliar para reinicializar após mudanças AJAX (se necessário)
window.reinitTableSorter = function() {
    new TableSorter('.lista-entrevistas');
};


// Script para gerenciar a coluna fixa com efeitos visuais
document.addEventListener('DOMContentLoaded', function() {
    const tableContainer = document.querySelector('.table-container.lista-entrevistas');
    
    if (!tableContainer) return;
    
    // Função para controlar a sombra baseada na posição do scroll
    function handleScroll() {
        const scrollLeft = tableContainer.scrollLeft;
        
        // Remove ou adiciona a classe 'no-shadow' baseado na posição
        if (scrollLeft <= 5) {
            tableContainer.classList.add('no-shadow');
        } else {
            tableContainer.classList.remove('no-shadow');
        }
    }
    
    // Adiciona o listener de scroll
    tableContainer.addEventListener('scroll', handleScroll);
    
    // Verifica a posição inicial
    handleScroll();
    
    // Opcional: Ajusta a largura da coluna nome dinamicamente
    function adjustColumnWidth() {
        const nomeColumns = document.querySelectorAll('.col-nome');
        let maxWidth = 0;
        
        nomeColumns.forEach(col => {
            const width = col.scrollWidth;
            if (width > maxWidth) {
                maxWidth = width;
            }
        });
        
        // Define uma largura mínima e máxima
        const finalWidth = Math.max(200, Math.min(maxWidth + 20, 400));
        
        nomeColumns.forEach(col => {
            col.style.minWidth = finalWidth + 'px';
        });
    }
    
    // Ajusta na carga da página
    adjustColumnWidth();
    
    // Reajusta ao redimensionar a janela
    window.addEventListener('resize', adjustColumnWidth);
});

// Função alternativa: Se quiser fixar múltiplas colunas
function setupMultipleFrozenColumns(columns = ['col-inscricao', 'col-nome']) {
    let cumulativeLeft = 0;
    
    columns.forEach((columnClass, index) => {
        const columnElements = document.querySelectorAll(`.${columnClass}`);
        
        columnElements.forEach(el => {
            el.style.position = 'sticky';
            el.style.left = cumulativeLeft + 'px';
            el.style.zIndex = 20 - index;
            el.style.backgroundColor = '#fff';
        });
        
        // Calcula a largura da coluna para a próxima
        if (columnElements.length > 0) {
            cumulativeLeft += columnElements[0].offsetWidth;
        }
    });
}


</script>
@endpush

@push('css-custom')
<style>

/* Estilo para o container da tabela */
.table-container {
    position: relative;
    overflow-x: auto;
    overflow-y: auto;
    max-height: calc(100vh - 200px); /* Ajuste conforme necessário */
}

/* Cabeçalho (tit-lista) - Fixo no topo */
.tit-lista {
    position: sticky !important;
    top: 0;
    z-index: 50 !important;
    background-color: #f8f9fa; /* Ajuste conforme a cor do seu cabeçalho */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Estilo para as listas (linhas) */
.lista-curriculos ul {
    display: flex;
    position: relative;
    min-width: max-content;
}

/* Coluna Nome - Fixa */
.col-nome {
    position: sticky;
    left: 0;
    z-index: 10;
    background-color: #fff;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}

/* Coluna Nome no cabeçalho - z-index maior para ficar acima de tudo */
.tit-lista .col-nome {
    z-index: 40;
    background-color: #fff; /* Ajuste conforme a cor do seu cabeçalho */
    font-weight: bold;
}

/* Remove a sombra quando estiver no início do scroll */
.table-container.no-shadow .col-nome {
    box-shadow: none;
    background-color: transparent;
}

/* Opcional: Adicionar uma transição suave na sombra */
.col-nome {
    transition: box-shadow 0.3s ease;
}

/* Garante que o conteúdo da coluna nome não quebre */
.col-nome {
    white-space: nowrap;
    min-width: 200px; /* Ajuste conforme necessário */
}

/* Ajuste para a coluna de ícone também ficar fixa (opcional) */
.col-inscricao {
    position: sticky;
    left: 0;
    z-index: 9;
    /* background-color: #fff; */
}

.tit-lista .col-inscricao {
    /* z-index: 39;
    background-color: #f8f9fa; */
}

/* Se quiser fixar ambas (inscricao e nome), ajuste as posições */
.col-nome.with-inscricao {
    left: 150px; /* Largura da col-inscricao + margem */
}




/* Fim */


    td,tr{
        font-size: 12px;
    }
    .btInt{
    flex-wrap: nowrap;
}

.lista-entrevistas{
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

.link-entrevista{
    transition: all ease-in-out 0.25s;
}
.link-entrevista:hover{
    text-decoration: underline;
}

.table-container.lista-entrevistas .col5{
    justify-content: center;
    flex-direction: column;
    font-weight: 700;
    font-size: 11px;
    color: #244f77;
    text-align: center;
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
    transition: 0.2s;
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
    padding: 8px 30px;
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



.table-container.lista-entrevistas {
    width: 100%;
    overflow-x: auto; /* Habilita scroll horizontal quando necessário */
    overflow-y: auto; /* Mantém o scroll vertical */
    white-space: nowrap; /* Impede que o conteúdo quebre em várias linhas */
    -webkit-overflow-scrolling: touch; /* Melhora o scroll em dispositivos móveis */
}

.tit-lista, .lista-entrevistas > ul {
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


.lista-entrevistas > ul {
    display: flex;
}



.tit-lista {
    display: flex;
    flex-wrap: nowrap; /* Isso é essencial! */
}

.tit-lista li {
    flex-shrink: 0; /* Impede que os itens encolham */    
}

.lista-entrevistas > ul {
    display: flex;
    flex-wrap: nowrap;
}

.lista-entrevistas > ul > li {
    flex-shrink: 0;
    margin-right: 10px;
   
}

.table-container.lista-entrevistas ul{
    width: fit-content;
}

/* coluna data inscricao */
.col-icon{
margin-right: 10px;
}

.col-entrevista{
    min-width: 185px !important;
    
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
    max-width: 350px !important;

}

.col-data_nascimento{
    min-width: 190px !important;
    max-width: 190px !important;
}

.col-rg{
    width: 160px;
}
.col-cpf{
    min-width: 160px !important;
    max-width: 160px !important;
}

.col-estado_civil{
    min-width: 160px !important;
    max-width: 160px !important;
}
.col-possui_filhos{
    min-width: 160px !important;
    max-width: 160px !important;
}

.col-filhos_sim{
    min-width: 180px !important;
    max-width: 180px !important;
}

.col-instagram{
   min-width: 160px !important;
    max-width: 160px !important;
}
.col-linkedin{
   min-width: 160px !important;
    max-width: 160px !important;
}
.col-telefone_celular{
    min-width: 200px !important;
    max-width: 200px !important;
}
.col-telefone_recado{
    min-width: 200px !important;
    max-width: 200px !important;
}
.col-nome_recado{
    min-width: 200px !important;
    max-width: 200px !important;
}

.col-endereco{
    min-width: 300px !important;
    max-width: 300px !important;
    white-space: pre-wrap;
}
.col-cidade{
    min-width: 150px !important;
    max-width: 150px !important;
    white-space: pre-wrap;
}
.col-uf{
    min-width: 50px !important;
    max-width: 50px !important;
    white-space: pre-wrap;
}



/* coluna vaga */
.col-vaga{
    max-width: 350px !important;
    min-width: 350px !important;
    overflow: hidden;
}

.col-vaga p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-experiencia_profissional{
    min-width: 350px !important;
    max-width: 350px !important;
    overflow: hidden;
}

.col-experiencia_profissional p{
    white-space: pre-wrap;
    margin-bottom: 5px;
}

.col-tamanho_uniforme{
    min-width: 200px !important;
    max-width: 200px !important;
}


/* coluna cnh */
.col-cnh{
    min-width: 100px !important;
    max-width: 100px !important;
    
}

.col-tipo_cnh{
    min-width: 100px !important;
    max-width: 100px !important;
    
}
.col-nacionalidade{
    min-width: 160px !important;
    max-width: 160px !important;
    
}
/* coluna genero */
.col-genero{
    min-width: 100px !important;
    max-width: 100px !important;
}

.col-genero_outro{
    min-width: 180px !important;
    max-width: 180px !important;
}


.col-pcd{
    min-width: 100px !important;
    max-width: 100px !important;
}
.col-pcd_sim{
    min-width: 180px !important;
    max-width: 180px !important;
}


/* coluna reservista */
.col-reservista{
    min-width: 120px !important;
    max-width: 120px !important;
}

.col-jovem-aprendiz{
    min-width: 350px !important;
    max-width: 350px !important;
    white-space: pre-wrap;
}

.col-formacao{
    min-width: 350px !important;
    max-width: 350px !important;
    white-space: pre-wrap;
}

.col-formacao_complemento{
    min-width: 350px !important;
    max-width: 350px !important;
    white-space: pre-wrap;
}
.col-informatica{
    min-width: 350px !important;
    max-width: 350px !important;
    white-space: pre-wrap;
}
.col-ingles{
    min-width: 350px !important;
    max-width: 350px !important;
    white-space: pre-wrap;

}





/* coluna entrevistado */

/* coluna genero */
.col-obs{
    min-width: 175px !important;
    max-width: 175px !important;
    white-space: pre-wrap;
}

/* coluna reservista */
.col-saude{
    min-width: 120px !important;
    max-width: 120px !important;
    overflow: hidden;
    white-space: pre-wrap;
}

.col-vacina{
    min-width: 120px !important;
    max-width: 120px !important;
    white-space: pre-wrap;
}

.col-perfil{
    min-width: 175px !important;
    max-width: 175px !important;
}
.col-perfil-stacasa{
    min-width: 150px !important;
    max-width: 150px !important;
}
.col-classificacao{
    min-width: 150px !important;
    max-width: 150px !important;
}
.col-entrevistado{
    min-width: 150px !important;
    max-width: 150px !important;
    display: flex;
    justify-content: center;
}

.col-entrevistado a{
    width: auto;
    padding: 5px;
}


.col-formadora{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}

.col-parecer{
    min-width: 400px !important;
    max-width: 400px !important;
    white-space: pre-wrap;
}
.col-curso-extracurriculares{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-apresentacao-pessoal{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-experiencia-profissional{
    min-width: 400px !important;
    max-width: 400px !important;
    white-space: pre-wrap;
}

.col-caracteristicas-positivas{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-habilidades{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-porque-gostaria-jovem-aprendiz{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-demissao{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-pretencoes-candidato{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-objetivo-longo-prazo{
    min-width: 220px !important;
    max-width: 220px !important;
    white-space: pre-wrap;
}
.col-pontos-melhoria{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-familia{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-disponibilidade-horario{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-fale-um-pouco{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}

.col-rotina{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-idiomas{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-cras{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-fonte-curriculo{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}
.col-sugestao-empresa{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}

.col-obs-entrevista{
    min-width: 400px !important;
    max-width: 400px !important;
    white-space: pre-wrap;
}
.col-pontuacao{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}

.col-status{
    min-width: 125px !important;
    max-width: 125px !important;
}

.col-status i{
    margin-right: 10px;
}

.col-filhos_sim, .col-genero_outro, 
.col-pcd, .col-pcd_sim, .col-superior_periodo, .col-cras{
    min-width: 200px !important;
    max-width: 200px !important;
    white-space: pre-wrap;
}

.col-nacionalidade, .col-renda_familiar, .col-obs_rh{
    min-width: 150px !important;
    max-width: 150px !important;
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


.bloco-filtros .col-12{
    width: 100%;
    margin: 0 !important;
    
    padding-bottom: 7px;
    
}

.bloco-filtros .col-12 .form-label{
    font-weight: 700;
    font-size: 13px;
    color: #333333;
}   
/*filtro*/
.container-filtros{
    height: 500px;
    overflow-y: auto
}
</style>

@endpush
