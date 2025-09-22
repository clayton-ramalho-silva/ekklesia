@extends('layouts.app')

@section('content')

<section class="cabecario">

    <h1>Logs</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroUsuarios" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            {{-- <form id="filter-form-users" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroUsuarios">

                <div class="row d-flex flex-column">

                    <div class="col">
                        <label for="funcao" class="form-label">Ação:</label>
                        <select name="funcao" id="funcao" class="form-select">
                            <option>Todas</option>
                            <option value="update">Atualização</option>
                            <option value="create">Criação</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="funcao" class="form-label">Tabela:</label>
                        <select name="funcao" id="funcao" class="form-select">
                            <option>Todas</option>
                            <option value="admin">Administrador</option>
                            <option value="recruiter">Recrutador</option>
                        </select>
                    </div>

                    <div class="col">
                        <label for="funcao" class="form-label">Usuário:</label>
                        <select name="funcao" id="funcao" class="form-select">
                            <option>Todas</option>
                            <option value="admin">Administrador</option>
                            <option value="recruiter">Recrutador</option>
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
                        <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
                    </div>

                </div>

            </form> --}}

        </div>

    </div>

</section>

<section class="sessao">

    <article class="f-interna">

        <div class="table-container lista-logs">

            <ul class="tit-lista">
                <li class="col1">ID</li>
                <li class="col2">Data</li>
                <li class="col3">Ação</li>
                <li class="col4">Tabela</li>
                <li class="col5">ID do Registro</li>
                <li class="col6">Descrição</li>
                <li class="col7">Usuário</li>
            </ul>

            @if ($logs->count() > 0)

                @foreach ($logs as $log)
                <ul>
                    <li class="col1">
                        <b>ID</b>
                        {{ $log->id }}
                    </li>
                    <li class="col2">
                        <b>Data</b>
                        {{ $log->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}
                    </li>
                    <li class="col3">
                        <b>Ação</b>
                        {{ $log->action }}
                    </li>
                    <li class="col4">
                        <b>Tabela</b>
                        {{ $log->table_name }}
                    </li>
                    <li class="col5">
                        <b>ID do Registro</b>
                        {{ $log->record_id }}
                    </li>
                    <li class="col6">
                        <b>Descrição</b>
                        {{ $log->description }}
                    </li>
                    <li class="col7">
                        <b>Usuário</b>
                        {{ $log->user ? $log->user->name : 'Sistema'}}
                    </li>

                </ul>
                @endforeach

            @else
            <span class="sem-resultado">Nenhum item encontrado</span>
            @endif

        </div>
         <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper">
            {{ $logs->appends(request()->query())->links('vendor.pagination.custom') }}
            <p class="pagination-info">Mostrando {{ $logs->firstItem() }} a {{ $logs->lastItem() }} de {{ $logs->total() }} currículos</p>
        </div>

        <table class="table" style="display: none">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Ação</td>
                    <td>Tabela</td>
                    <td>ID do Registro</td>
                    <td>Descrição</td>
                    <td>Usuário</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->table_name }}</td>
                        <td>{{ $log->record_id }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->user ? $log->user->name : 'Sistema'}}</td>
                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </article>

    <article class="f4 bts-interna">
        @if (Auth::user()->email === 'marketing@asppe.org' || Auth::user()->email === 'clayton@email.com')
            <a href="#" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        @endif
    </article>

</section>
@endsection

@push('css-custom')
<style>
    td,tr{
        font-size: 12px;
    }

    .table-container.lista-logs{
        width: 100%;
        overflow: auto;
        height: 450px;
    }
    .table-container.lista-logs .tit-lista{
    width: fit-content;
    position: sticky;
    top: 0;
    background-color: #fff;
    z-index: 4;
    min-width: 100%;
}
</style>

@endpush