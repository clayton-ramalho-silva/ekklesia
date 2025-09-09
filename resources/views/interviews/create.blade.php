@extends('layouts.app')

@section('content')
<section class="cabecario">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('interviews.index') }}">Nova Entrevista</a></li>
            </ol>
        </nav>

        <div class="d-flex">
            <div class="cabExtras me-5">
            
                <div class="dropdown">
                    <button class="dropdown-toggle" id="dropdownFiltroEntrevistas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                        <div class="btFiltros filtros">
                            <figure>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            </figure>
                            <span>Filtros</span>
                        </div>
                    </button>
            
                    <form id="filter-form-interviews" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroInterview">
            
                        <div class="row d-flex flex-column">
            
                            <div class="col">
                                <label for="nome" class="form-label">Nome do Candidato</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ request('nome') }}" placeholder="Buscar por nome...">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option>Todos</option>
                                    <option value="ativo"> Ativo</option>
                                    <option value="inativo"> Inativo</option>
                                    <option value="processo"> Em processo</option>
                                    <option value="contratado"> Contratado</option>
                                </select>
                            </div>
            
                            <div class="col">
                                <label for="entrevistado" class="form-label">Entrevistado</label>
                                <select name="entrevistado" id="entrevistado" class="form-select">
                                    <option>Todos</option>
                                    <option value="1">Já entrevistado</option>
                                    <option value="0">Não entrevistado</option>
                                </select>
                            </div>
            
                            <div class="col mb-4">
                                <label for="filtro_data" class="form-label">Filtrar por Data</label>
                                <select name="filtro_data" id="filtro_data" class="form-select">
                                    <option>Todas</option>
                                    <option value="">Selecione</option>
                                    <option value="7">Últimos 7 dias</option>
                                    <option value="15">Últimos 15 dias</option>
                                    <option value="30">Últimos 30 dias</option>
                                    <option value="90">Últimos 90 dias</option>
                                </select>
                            </div>
            
                            <div class="col mt-1 d-flex justify-content-between">
                                <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                                <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
                            </div>
            
                        </div>
            
                    </form>
            
                </div>
            
            </div>
    
          {{--Componente Botão voltar --}}
          @php
              // Guarda a rota na variável
              $rota = route('interviews.index');
          @endphp
    
          <x-voltar :rota="$rota"/>
          {{--Componente Botão voltar --}}

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
                <li class="col1">Nome</li>
                <li class="col2">Tipo de vaga</li>
                <li class="col3">Entrevistado</li>
                <li class="col4">Obs.</li>
                <li class="col5">Status</li>
            </ul>

            @if ($resumes->count() > 0)

                @foreach ($resumes as $resume)
                {{-- <ul onclick="window.location='{{ route('resumes.edit', $resume) }}'" title="Editar currículo"> --}}
                <ul onclick="window.location='{{ $resume->interview ? route('interviews.show', $resume->interview->id) : route('interviews.interviewResume', $resume)    }}'" title="Ver ou Editar Entrevista">
                    <li class="col1">
                        <b>Nome</b>
                        <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                        <span>
                            <strong>{{ $resume->informacoesPessoais->nome ?? 'N/A' }}</strong>
                        </span>
                    </li>
                    <li class="col2">
                        <b>Tipo de vaga</b>
                        
                        @foreach ($resume->vagas_interesse ?? [] as $vaga)
                            {{$vaga}},
                        @endforeach
                    </li>
                    <li class="col3">
                        <b>Entrevistado</b>
                        @if ($resume->interview)
                            <a href="{{ route('interviews.show', $resume->interview->id) }}" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        @else
                            <a href="{{ route('interviews.interviewResume', $resume) }}"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        @endif
                    </li>
                    <li class="col4">
                        <b>Obs.</b>
                        {{-- Precisa lógica para puxar informação --}}
                        Não
                    </li>
                    <li class="col5">
                        <b>Status</b>
                        @switch($resume->status)
                        @case('inativo')
                            <i class="status-inativo" title="Inativo"></i>
                            @break

                        @case('em processo')
                            <i class="status-em-processo" title="Em processo"></i>
                            @break
                        @case('efetivado')
                            <i class="status-efetivado" title="Efetivado"></i>
                            @break

                        @default
                            <i class="status-ativo" title="Ativo"></i>
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
            <p class="pagination-info">Mostrando {{ $resumes->firstItem() }} a {{ $resumes->lastItem() }} de {{ $resumes->total() }} currículos</p>
        </div>

    </article>

    {{-- <article class="f4 bts-interna">
        <a href="{{ route('interviews.create') }}" class="btInt btCadastrar">Entrevistar <small>Realize uma entrevista</small></a>
        <a href="{{ route('reports.export.interviews') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article> --}}

</section>
@endsection

@push('scripts-custom')
<script>
var envio   = '',
    filtros = [];

$(document).ready(function() {

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('.bloco-filtros select').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-interviews').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "{{ route('interviews.index') }}",
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

@push('scripts-custom')
<script>
var envio   = '',
    filtros = [];

$(document).ready(function() {

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-companies').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "{{ route('companies.index') }}",
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

$('#rg').mask('00.000.000-A');
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

/* Estilo responsivo */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
    }
    
    .page-item {
        margin-bottom: 5px;
    }
}
</style>

@endpush
