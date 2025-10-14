@extends('layouts.app')

@section('content')
<section class="cabecario">

    <h1>Empresas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroEmpresas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-companies" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroEmpresas">

                <div class="row d-flex flex-column">

                    <div class="col d-flex flex-wrap justify-content-start">

                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <label class="form-check-label" for="status1">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status1" value="ativo" checked>Ativo
                            </label>
                        </div>
                        

                        <div class="form-check">
                            <label class="form-check-label" for="status2">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status2" value="inativo" checked>Inativo
                            </label>
                        </div>

                    </div>
                    <div class="col">
                            <label for="empresa" class="form-label">Empresa</label>
                            <input type="text" name="empresa" id="empresa" class="form-control" value="{{ request('empresa') }}" placeholder="Nome da empresa">
                        </div>

                    <div class="col">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select">
                            <option>Todas</option>
                            @php
                            echo get_cidades($companies);
                            @endphp
                        </select>
                    </div>

                    <div class="col">
                        <label for="cidade" class="form-label">UF:</label>
                        <select name="uf" id="uf" class="form-select">
                            <option>Todos</option>
                            @php
                            echo get_estados();
                            @endphp
                        </select>
                    </div>

                    <div class="col mb-4">
                        <label for="filtro_data" class="form-label">Data:</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col mt-1 d-flex justify-content-between">
                        {{-- <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button> --}}
                        <button type="submit" class="btn btn-padrao btn-cadastrar">Filtrar</button>                        
                        <a href="{{ route('companies.index') }}" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</a>
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

        <div class="table-container lista-empresas">
            @php
                $isAdmin = Auth::user()->role == 'admin' ? true : false;                        
            @endphp 
            <ul class="tit-lista">
                <li class="col1 sortable" data-column="nome" data-type="text">Nome</li>
                <li class="col2 sortable" data-column="email" data-type="text">E-mail</li>
                <li class="col3 sortable" data-column="telefone" data-type="text">Telefone</li>
                <li class="col4 sortable" data-column="endereco" data-type="text">Endereço</li>
                <li class="col5 sortable" data-column="status" data-type="text">Status</li>  
                
                @if ($isAdmin)
                    <li class="col6">Ações</li>                            
                @endif            
            </ul>

            @if ($companies->count() > 0)

                @foreach ($companies as $company)
                {{-- <a href="{{ route('companies.edit', $company) }}"{!! ($company->status === 'inativo') ? ' class="inativo"' : '' !!} data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Empresa"> --}}
                    <ul class="row-list" onclick="window.open('{{ route('companies.edit', $company) }}', '_blank')" title="Ver vaga"> 
                        <li class="col1">
                            <b>Nome</b>
                           
                            @if ($company->logotipo)
                                @if (file_exists(public_path('documents/companies/images/'.$company->logotipo)))
                                    <img src="{{ asset("documents/companies/images/{$company->logotipo}") }}" alt="{{ $company->nome_fantasia }}" title="{{ $company->nome_fantasia }}">
                                @else
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="{{ asset("documents/companies/images/{$company->logotipo}") }}" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                @endif
                            @else
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            @endif
                            <span>
                                <strong>{{ $company->nome_fantasia }}</strong><br>{{ $company->cnpj }}
                            </span>
                        </li>
                        <li class="col2">
                            <b>E-mail</b>
                            {{ $company->contacts->email }}
                        </li>
                        <li class="col3">
                            <b>Telefone</b>
                            {{ $company->contacts->telefone }}
                        </li>
                        <li class="col4">
                            <b>Endereço</b>
                            {{ $company->location->logradouro.', '.$company->location->numero }}
                        </li>
                        <li class="col5">
                            <b>Status</b>
                            <i title="{{ $company->status === 'inativo' ? 'Inativo' : 'Ativo' }}"></i>
                        </li>
                        @if ($isAdmin) 
                        <li class="col6">
                            <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-deletar-entidades" data-bs-toggle="tooltip" data-bs-placement="top" title="Deletar Empresa" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir esta Empresa? Junto você deletará as vagas associadas a ela.')){this.closest('form').submit()}">
                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                   
                                </button>
                            </form>
                        </li>
                        @endif                     

                    </ul>
                {{-- </a> --}}
                @endforeach

            @else
            <span class="sem-resultado">Nenhuma empresa encontrada</span>
            @endif

        </div>
        <!-- No final da página, após a tabela ou lista de empresas -->
        <div class="pagination-wrapper mt-3">
            {{ $companies->appends(request()->query())->links('vendor.pagination.custom') }}
            <p class="pagination-info mt-3">Mostrando {{ $companies->firstItem() }} a {{ $companies->lastItem() }} de {{ $companies->total() }} empresas</p>
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="{{ route('companies.create') }}" class="btInt btCadastrar">Cadastrar <small>Crie uma nova empresa</small></a>
        @if (Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com')
            <a href="{{ route('reports.export.companies') }}" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>            
        @endif
        
        <a href="{{ route('companies.create') }}" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

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

    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });

    // if(envio === 'limpar'){
    //     $('.bloco-filtros-ativos').slideUp(150);
    //     setTimeout(function(){
    //         $('.bloco-filtros-ativos span').html('');
    //     }, 170);
    // }

    // $('#filter-form-companies').on('submit', function(e) {

    //     e.preventDefault();
    //     let formData = (envio === 'filtrar') ? $(this).serialize() : '';

    //     get_form_filters($(this).serializeArray());

    //     $.ajax({
    //         url: "{{ route('companies.index') }}",
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
    const sorter = new TableSorter('.lista-empresas');
    
    console.log('Sistema de ordenação inicializado!');
});

// Função auxiliar para reinicializar após mudanças AJAX (se necessário)
window.reinitTableSorter = function() {
    new TableSorter('.lista-empresas');
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
.col1, .col2, .col4{
    width: 400px !important;
    justify-content: start !important;
    
}
.col3{
    width: 200px !important;
    justify-content: start !important; 
}

.col5, .col6{
    width: 100px !important;
    justify-content: center !important; 
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

.table-container.lista-empresas{
    height: 450px;
    overflow: auto;
}

.table-container.lista-empresas ul{
    flex-wrap: nowrap;
    width: fit-content;
}

.table-container.lista-empresas .tit-lista {
    width: fit-content;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
    min-width: 100%;
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
.lista-empresas ul {
    transition: all 0.3s ease;
}

/* Destaque visual durante ordenação */
.sorting {
    opacity: 0.7;
}


/******** FIM CSS Personalizado sortable **********/

.btn.btn-padrao.btn-cancelar{
    padding: 8px 20px;
}

</style>

@endpush