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
                            <option value="aberta"> Aberta</option>
                            <option value="fechada"> Fechada</option>
                            <option value="espera"> Espera</option>
                            <option value="cancelada"> Cancelada</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cargo" class="form-label">Setor</label>
                        <select name="cargo" id="cargo" class="form-select" >
                            <option>Todos</option>
                            <option value="Copa & Cozinha">Copa & Cozinha</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                            <option value="Construção e Reparos">Construção e Reparos</option>
                            <option value="Conservação e Limpeza">Conservação e Limpeza</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="recruiters" class="form-label" >Recrutador</label>
                        <select name="recruiters" id="recruiters" class="form-select">
                            <option>Todos</option>
                            @foreach ($recruiters as $recruiter)
                                <option value="{{ $recruiter->name }}" > {{ $recruiter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select">
                            <option>Todos</option>
                            <option value="Masculino"> Masculino</option>
                            <option value="Feminino"> Feminino</option>
                            <option value="Indiferente"> Indiferente</option>
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
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select">
                            <option>Todos</option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="company" class="form-label">Empresa</label>
                        <select name="company" id="company_id" class="form-select" >
                            <option>Todas</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->nome_fantasia }}" > {{ $company->nome_fantasia }}</option>
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

                    <div class="col mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
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
                <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">Empresa</li>
                <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">Título</li>
                <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}">Vagas</li>
                <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">Recrutador</li>
                <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Início processo contratação">Início</li>
                <li class="col6 {{ $isAdmin ? 'col6-admin' : ''}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Fim processo contratação">Fim</li>
                <li class="col7 {{ $isAdmin ? 'col7-admin' : ''}}">Data Entrevista Empresa</li>
                <li class="col7 {{ $isAdmin ? 'col7-admin' : ''}}">Status</li>
                 @if ($isAdmin)
                    <li class="col8 {{ $isAdmin ? 'col8-admin' : ''}}">Ações</li>                            
                @endif 
            </ul>

            @if ($jobs->count() > 0)

            @foreach ($jobs as $job)
                <a href="{{ route('jobs.edit', $job) }}">
                    <ul>
                        <li class="col1 {{ $isAdmin ? 'col1-admin' : ''}}">
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
                        <li class="col2 {{ $isAdmin ? 'col2-admin' : ''}}">
                            <b>Título</b>
                            {!! limite($job->cargo, 28) !!}
                        </li>
                        <li class="col3 {{ $isAdmin ? 'col3-admin' : ''}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{ $job->filled_positions }} / {{ $job->qtd_vagas }}
                        </li>
                        <li class="col4 {{ $isAdmin ? 'col4-admin' : ''}}">
                            <b>Recrutador</b>
                            @if (count($job->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($job->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="col5 {{ $isAdmin ? 'col5-admin' : ''}}">
                            <b>Início</b>
                            @if (!$job->data_inicio_contratacao)
                                Processo não iniciado
                            @else
                                {{ $job->data_inicio_contratacao->format('d/m/Y') }}

                            @endif
                        </li>
                        <li class="col6 {{ $isAdmin ? 'col6-admin' : ''}}">
                            <b>Fim</b>
                            @if ($job->data_fim_contratacao && $job->data_fim_contratacao !== null)
                                {{ $job->data_fim_contratacao->format('d/m/Y') }}

                            @elseif (!$job->data_inicio_contratacao)

                            @else
                                Em andamento
                            @endif
                        </li>
                        <li class="col7 {{ $isAdmin ? 'col7-admin' : ''}}">
                            {{$job->data_entrevista_empresa ? $job->data_entrevista_empresa->format('d/m/Y') : '' }}
                        </li>
                        <li class="col7 {{ $isAdmin ? 'col7-admin' : ''}}">
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
                        <li class="col8 {{ $isAdmin ? 'col8-admin' : ''}}">
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
                </a>
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
var envio   = '',
    filtros = [];

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
    $('#cargo').select2({
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

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-jobs').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "{{ route('jobs.index') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                $('.table-container').html($(response).find('.table-container').html());
                $('.dropdown-menu').removeClass('show');
            },
            error: function(xhr, status, error) {
                console.error("Erro ao buscar dados:", error);
            }
        });

    });

    


});


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
}

.col4, .col5, .col6, .col7{
    width: 10% !important;
}


.col1-admin{
width: 25% !important;
}
.col2-admin{
    width: 10% !important;
}
.col3-admin{
    width: 6% !important;
}
.col4-admin{
    width: 10% !important;
}
.col5-admin{
    width: 10% !important;
}
.col6-admin{
    width: 10% !important;
}
.col7-admin{
    width: 10% !important;
}
.col8-admin{
    width: 5% !important;
}

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

.table-container.lista-vagas .tit-lista{
    width: fit-content;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
    min-width: 100%;
}

</style>
@endpush