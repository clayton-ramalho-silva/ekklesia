@extends('layouts.app')

@section('content')

<section class="cabecario">
    <h1>Vagas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroVagas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-jobs" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltro">

                <div class="row d-flex">

                    <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option>Todos</option>
                            <option value="aberta" {{ request('aberta') == 'aberta' ? 'selected' : ''  }}> Aberta</option>
                            <option value="fechada" {{ request('fechada') == 'fechada' ? 'selected' : ''  }}> Fechada</option>
                            <option value="espera" {{ request('espera') == 'espera' ? 'selected' : ''  }}> Espera</option>
                            <option value="cancelada" {{ request('cancelada') == 'cancelada' ? 'selected' : ''  }}> Cancelada</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7" {{ request('filtro_data') == '7' ? 'selected' : '' }}>Últimos 7 dias</option>
                            <option value="15" {{ request('filtro_data') == '15' ? 'selected' : '' }}>Últimos 15 dias</option>
                            <option value="30" {{ request('filtro_data') == '30' ? 'selected' : '' }}>Últimos 30 dias</option>
                            <option value="90" {{ request('filtro_data') == '90' ? 'selected' : '' }}>Últimos 90 dias</option>
                        </select>
                    </div>
                    <div class="col-6 mb-4">
                        <label for="setor" class="form-label">Área</label>
                        <input type="text" name="setor" id="setor" class="form-control" value="{{ request('setor') }}">
                    </div>

                    <div class="col-6">
                        <label for="cbo" class="form-label">CBO</label>
                        <select name="cbo" id="cbo" class="form-select" >
                            <option>Todos</option>
                            <option value="4110-10" {{ request('cbo') == '4110-10' ? 'selected' : '' }}>4110-10 / Assistente Administrativo</option>
                            <option value="4122-05" {{ request('cbo') == '4122-05' ? 'selected' : '' }}>4122-05 / Contínuo</option>
                            <option value="4211-25" {{ request('cbo') == '4211-25' ? 'selected' : '' }}>4211-25 / Operador de Caixa</option>
                            <option value="4221-05" {{ request('cbo') == '4221-05' ? 'selected' : '' }}>4221-05 / Recepcionista Geral</option>
                            <option value="5133-15" {{ request('cbo') == '5133-15' ? 'selected' : '' }}>5133-15 / Camareiro de Hotel</option>
                            <option value="5134-05" {{ request('cbo') == '5134-05' ? 'selected' : '' }}>5134-05 / Garçom</option>
                            <option value="5134-15" {{ request('cbo') == '5134-15' ? 'selected' : '' }}>5134-15 / Cumim</option>
                            <option value="5134-25" {{ request('cbo') == '5134-25' ? 'selected' : '' }}>5134-25 / Copeiro</option>
                            <option value="5134-35" {{ request('cbo') == '5134-35' ? 'selected' : '' }}>5134-35 / Atendente de lanchonete</option>
                            <option value="5135-05" {{ request('cbo') == '5135-05' ? 'selected' : '' }}>5135-05 / Aux. nos Serviços de Alimentação</option>
                            <option value="5142-25" {{ request('cbo') == '5142-25' ? 'selected' : '' }}>5142-25 / Trabalhador de serviços de limpeza e conservação</option>
                            <option value="5143-25" {{ request('cbo') == '5143-25' ? 'selected' : '' }}>5143-25 / Trabalhador na Manutenção de Edificações</option>
                            <option value="5211-25" {{ request('cbo') == '5211-25' ? 'selected' : '' }}>5211-25 / Repositor de Mercadorias</option>
                            <option value="5211-35" {{ request('cbo') == '5211-35' ? 'selected' : '' }}>5211-35 / Frentista</option>
                            <option value="5211-40" {{ request('cbo') == '5211-40' ? 'selected' : '' }}>5211-40 / Atendente de lojas e mercados</option>  
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="recruiters" class="form-label" >Recrutador</label>
                        <select name="recruiters" id="recruiters" class="form-select">
                            <option>Todos</option>
                            @foreach ($recruiters as $recruiter)
                                <option value="{{ $recruiter->name }}"
                                    {{ is_array(request('recruiters')) && in_array($recruiter->name, request('recruiters')) ? 'selected' : '' }}    
                                > {{ $recruiter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select">
                            <option>Todos</option>
                            <option value="Masculino" {{request('sexo' == 'Masculino' ? 'selected' : '' )}}> Masculino</option>
                            <option value="Feminino" {{request('sexo' == 'Feminino' ? 'selected' : '' )}}> Feminino</option>
                            <option value="Indiferente" {{request('sexo' == 'Indiferente' ? 'selected' : '' )}}> Indiferente</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select">
                            <option>Todas</option>
                            @php
                            echo get_cidades($jobs, 2);
                            @endphp
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">UF:</label>
                        <select name="uf" id="uf" class="form-select">
                            <option>Todos</option>
                            @php
                            echo get_estados();
                            @endphp
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="informatica" class="form-label">Informática</label>
                        <select name="informatica" id="informatica" class="form-select">
                            <option>Todos</option>
                            <option value="Básico" {{ request('informatica') == 'Básico' ? 'selected' : ' '}}> Básico</option>
                            <option value="Intermediário" {{ request('informatica') == 'Intermediário' ? 'selected' : ' '}}> Intermediário</option>
                            <option value="Avançado" {{ request('informatica') == 'Avançado' ? 'selected' : ' '}}> Avançado</option>
                            <option value="Nenhum" {{ request('informatica') == 'Nenhum' ? 'selected' : ' '}}> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select">
                            <option>Todos</option>
                            <option value="Básico" {{ request('ingles') == 'Básico' ? 'selected' : ' '}}> Básico</option>
                            <option value="Intermediário" {{ request('ingles') == 'Básico' ? 'selected' : ' '}}> Intermediário</option>
                            <option value="Avançado" {{ request('ingles') == 'Básico' ? 'selected' : ' '}}> Avançado</option>
                            <option value="Nenhum" {{ request('ingles') == 'Básico' ? 'selected' : ' '}}> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="company" class="form-label">Empresa</label>
                        <select name="company" id="company_id" class="form-select" >
                            <option>Todas</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->nome_fantasia }}" 
                                    {{ is_array(request('company')) && in_array($company->nome_fantasia, request('company')) ? 'selected' : '' }}    
                                > {{ $company->nome_fantasia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="min_salario" class="form-label">Salário (min):</label>
                        <input type="text" name="min_salario" id="min_salario" class="form-control" value="{{ request('min_salario') }}">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="max_salario" class="form-label">Salário (max):</label>
                        <input type="text" name="max_salario" id="max_salario" class="form-control" value="{{ request('max_salario') }}">
                    </div>

                    <div class="col-6 mb4">
                        <label for="data_min" class="form-label">Data Entrevista (de):</label>
                        <input type="date" name="data_min" id="data_min" class="form-control" value="{{ request('data_min')}}">
                    </div>

                    <div class="col-6 mb4">
                        <label for="data_max" class="form-label">Data Entrevista (até):</label>
                        <input type="date" name="data_max" id="data_max" class="form-control" value="{{ request('data_max')}}">
                    </div>

                    <div class="col-12 mt-1 d-flex justify-content-between">
                        {{-- <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button> --}}
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>                        
                        <a href="{{ route('jobs.index') }}" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
                    </div>

                </div>

            </form>

        </div>

        {{-- <div class="btFiltros datas">
            <figure>
                <svg width="18px" height="20px" viewBox="0 0 18 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                    <title>date_range</title>
                    <desc>Created with Sketch.</desc>
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded" transform="translate(-307.000000, -244.000000)">
                            <g id="Action" transform="translate(100.000000, 100.000000)">
                                <g id="-Round-/-Action-/-date_range" transform="translate(204.000000, 142.000000)">
                                    <g>
                                        <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M19,4 L18,4 L18,3 C18,2.45 17.55,2 17,2 C16.45,2 16,2.45 16,3 L16,4 L8,4 L8,3 C8,2.45 7.55,2 7,2 C6.45,2 6,2.45 6,3 L6,4 L5,4 C3.89,4 3.01,4.9 3.01,6 L3,20 C3,21.1 3.89,22 5,22 L19,22 C20.1,22 21,21.1 21,20 L21,6 C21,4.9 20.1,4 19,4 Z M19,19 C19,19.55 18.55,20 18,20 L6,20 C5.45,20 5,19.55 5,19 L5,9 L19,9 L19,19 Z M7,11 L9,11 L9,13 L7,13 L7,11 Z M11,11 L13,11 L13,13 L11,13 L11,11 Z M15,11 L17,11 L17,13 L15,13 L15,11 Z" id="?Icon-Color" fill="#1D1D1D"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </figure>

            <span>Este m&ecirc;s</span>
        </div> --}}

    </div>

</section>

<div class="bloco-filtros-ativos">

    Filtros ativos <span></span>

</div>

<section class="sessao">

    <article class="f-interna">

        <h4>Vagas em Destaque</h4>

        <div class="table-container lista-vagas">
            @php
                $isAdmin = Auth::user()->role == 'admin' ? true : false;                        
            @endphp
            <ul class="tit-lista">
                <li class="col1 sortable" data-column="empresa" data-type="text">Empresa</li>
                <li class="col2 sortable" data-column="area" data-type="text">Área</li>
                <li class="col3 sortable" data-column="titulo" data-type="text">CBO</li>
                <li class="col4 sortable" data-column="vagas" data-type="text">Vagas</li>
                <li class="col5 sortable" data-column="recrutador" data-type="text">Recrutador</li>
                <li class="col6 sortable" data-column="inicio_processo" data-type="date" >Início</li>
                <li class="col7 sortable" data-column="fim_processo" data-type="date" >Fim</li>
                <li class="col8 sortable" data-column="data_entrevista" data-type="date">Data Entrevista Empresa</li>
                <li class="col9 sortable" data-column="status" data-type="text">Status</li>
                 @if ($isAdmin)
                    <li class="col10">Ações</li>                            
                @endif 
            </ul>

            @if ($jobs->count() > 0)

            @foreach ($jobs as $job)
                {{-- <a href="{{ route('jobs.edit', $job) }}"> --}}
                     <ul class="row-list" onclick="window.open('{{ route('jobs.edit', $job) }}', '_blank')" title="Ver vaga"> 
                    {{-- <ul> --}}
                        <li class="col1">
                            @if ($job->company->logotipo)
                                <b>Empresa</b>
                                @if (file_exists(public_path('documents/companies/images/'.$job->company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" alt="{{ $job->company->nome_fantasia }}" title="{{ $job->company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$job->company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $job->company->nome_fantasia }}</strong>
                            </span>
                        </li>
                        {{-- Este campo represnta o Campo Área com texto livre --}}
                         <li class="col2">
                            <b>Área</b>
                            {!! limite($job->setor, 28) !!}
                        </li>
                        {{-- Este campo represnta o Setor select --}}
                        <li class="col3">
                            <b>Título</b>                            
                            {!! limite($job->exibirCBO(), 28) !!} 
                        </li>
                        <li class="col4" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{ $job->filled_positions }} / {{ $job->qtd_vagas }}
                        </li>
                        <li class="col5">
                            <b>Recrutador</b>
                            @if (count($job->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($job->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col6">
                            <b>Início</b>
                            @if (!$job->data_inicio_contratacao)
                                Processo não iniciado
                            @else
                                {{ $job->data_inicio_contratacao->format('d/m/Y') }}

                            @endif
                        </li>
                        <li class="col7">
                            <b>Fim</b>
                            @if ($job->data_fim_contratacao && $job->data_fim_contratacao !== null)
                                {{ $job->data_fim_contratacao->format('d/m/Y') }}

                            @elseif (!$job->data_inicio_contratacao)

                            @else
                                Em andamento
                            @endif
                        </li>
                        <li class="col8">
                            {{$job->data_entrevista_empresa ? $job->data_entrevista_empresa->format('d/m/Y') : '' }}
                        </li>
                        <li class="col9">
                            <b>Status</b>
                            @switch($job->status)
                                @case('aberta')
                                    <i title="Aberta" class="status-aberta"></i>        
                                    @break
                                @case('fechada')
                                    <i title="Fechada" class="status-fechada"></i>              
                                    @break
                                @case('cancelada')
                                    <i title="Cancelada" class="status-cancelada"></i>        
                                    @break
                                @case('espera')
                                    <i title="Espera" class="status-espera"></i>        
                                    @break
                            
                                @default
                                    
                            @endswitch                            
                       
                        </li>
                        @if ($isAdmin) 
                        <li class="col10">
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-deletar-entidades" data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar Vaga" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir esta Vaga? ')){this.closest('form').submit()}">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                   
                                </button>
                            </form>
                        </li>
                        @endif 

                    </ul>
                {{-- </a> --}}
                @endforeach

            @else
            <span class="sem-resultado">Nenhuma vaga encontrada</span>
            @endif

        </div>
        <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper mt-3">
            {{ $jobs->appends(request()->query())->links('vendor.pagination.custom') }}
            <p class="pagination-info">Mostrando {{ $jobs->firstItem() }} a {{ $jobs->lastItem() }} de {{ $jobs->total() }} currículos</p>
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('jobs.create') }}" class="btInt btCadastrar">Cadastrar <small>Crie uma nova vaga</small></a>
        @if (Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com')
            <a href="{{ route('reports.export.jobs') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>            
        @endif
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>
@endsection



@push('scripts-custom')
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
    // var envio   = '',
    //     filtros = [];

$(document).ready(function() {

    $('#min_salario').mask('#.##0,00', {reverse: true});
    $('#max_salario').mask('#.##0,00', {reverse: true});

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#status').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });
    $('#cbo').select2({
        placeholder: "Selecione",
    });
    $('#recruiters').select2({
        placeholder: "Selecione",
    });
    $('#sexo').select2({
        placeholder: "Selecione",
    });
    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#informatica').select2({
        placeholder: "Selecione",
    });
    $('#ingles').select2({
        placeholder: "Selecione",
    });
    $('#company_id').select2({
        placeholder: "Selecione",
    });

    // if(envio === 'limpar'){
    //     $('.bloco-filtros-ativos').slideUp(150);
    //     setTimeout(function(){
    //         $('.bloco-filtros-ativos span').html('');
    //     }, 170);
    // }

    // $('#filter-form-jobs').on('submit', function(e) {

    //     e.preventDefault();
    //     let formData = (envio === 'filtrar') ? $(this).serialize() : '';

    //     get_form_filters($(this).serializeArray());

    //     $.ajax({
    //         url: "{{ route('jobs.index') }}",
    //         type: "GET",
    //         data: formData,
    //         success: function(response) {
    //             $('.table-container').html($(response).find('.table-container').html());
    //             $('.dropdown-menu').removeClass('show');
    //         },
    //         error: function(xhr, status, error) {
    //             console.error("Erro ao buscar dados:", error);
    //         }
    //     });

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



////////// //////// SISTEMA DE ORDENAÇÃO /////////////////
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
    const sorter = new TableSorter('.lista-vagas');
    
    console.log('Sistema de ordenação inicializado!');
});

// Função auxiliar para reinicializar após mudanças AJAX (se necessário)
window.reinitTableSorter = function() {
    new TableSorter('.lista-vagas');
};

////// FIM SISTEMA DE ORDENAÇÃO ///////


</script>
@endpush

@push('css-custom')
<style>
    td,tr{
        font-size: 12px;
    }
    .btInt{
    flex-wrap: nowrap;
}

.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.status-aberta{
    background-color: #ffff00 !important;
}
.status-fechada{
    background-color: #008000 !important;
}
.status-espera{
    background-color: #808080 !important;
}
.status-cancelada{
    background-color: #ff0000 !important;
}


/* .status-aberta{
    background-color: #008000 !important;
}
.status-fechada{
    background-color: #ff0000 !important;
}
.status-espera{
    background-color: #ffff00 !important;
}
.status-cancelada{
    background-color: #808080 !important; 
} */

.btn-deletar-entidades{    
    z-index: 0;
    background-color: #e4e4e4;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    -ms-border-radius: 50px;
    width: 34px;
    height: 34px;
    transition: all 0.25s ease-in-out;
}
.btn-deletar-entidades:hover{    
   background-color: #fff;
}

.table-container.lista-vagas{
    height: 450px;
    overflow: auto;
}
.table-container.lista-vagas ul{
    flex-wrap: nowrap;
    width: fit-content;
}
.table-container.lista-vagas .tit-lista{
    width: fit-content;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
    min-width: 100%;
}

.col1, .col2{
    width: 300px !important;
    justify-content: start !important;
}
.col3, .col5{
    width: 200px !important;
    justify-content: start !important; 
}
.col5{
    width: 150px !important;
    justify-content: start !important; 
}
.col4, .col6, .col7,.col8, .col9, .col10{
    width: 100px !important;
    justify-content: start !important;
}

/******** CSS Personalizado sortable **********/
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


/******** FIM CSS Personalizado sortable **********/


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

.btn.btn-padrao.btn-cancelar{
    padding: 8px 20px;
}


</style>
@endpush