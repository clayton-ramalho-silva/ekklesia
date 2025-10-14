<div class="container">

    <div class="row">

        <div class="col-12">

            <div class="modal fade modal-associar-vaga" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-xl">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h4>Vagas abertas</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="table-container lista-associar-vaga">

                                <ul class="tit-lista">
                                    <li class="col1">Empresa</li>
                                    <li class="col2">Área</li>
                                    <li class="col3">Vagas</li>
                                    <li class="col4">Cidade</li>
                                    <li class="col5">Candidatos Selecionados</li>
                                    <li class="col6">Ações</li>
                                </ul>

                                @if ($jobs->count() > 0)

                                    @foreach ($jobs as $job)
                                    <ul>
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
                                        <li class="col2">
                                            <b>Título</b>
                                            {!! limite($job->setor, 28) !!}
                                        </li>
                                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                            <b>Vagas</b>
                                            {{ $job->filled_positions }} / {{ $job->qtd_vagas }}
                                        </li>
                                        <li class="col4">
                                            <b>Cidade</b>
                                            {{ $job->cidade }}
                                        </li>
                                        <li class="col5">
                                            <b>Candidatos Selecionados</b>
                                            @if ($job->resumes->count() > 0)
                                                {{$job->resumes->count()}} candidatos
                                            @else
                                                Nenhum candidato selecionado
                                            @endif
                                        </li>
                                        <li class="col6">
                                            <b>Ações</b>
                                            @php
                                            $resumeAssociado = false;

                                            foreach ($job->resumes as $curriculo) {
                                                if ($curriculo->id == $resume->id) {
                                                    $resumeAssociado = true;
                                                }
                                            }
                                            @endphp

                                            @if ($resumeAssociado)
                                                <button disabled="disabled" class="btn btn-primagy btn-sm d-inline">Associado</button>
                                            @else

                                            <form action="{{ route('interviews.associarVaga') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                <input type="hidden" name="resume_id" value="{{ $resume->id }}">
                                                <button type="submit" class="btn btn-success btn-sm">Associar</button>
                                            </form>
                                            @endif
                                        </li>

                                    </ul>
                                    @endforeach

                                @else
                                <span class="sem-resultado">Nenhuma vaga encontrada</span>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


@push('css-custom')
    <style>
        .modal-associar-vaga.show{
            z-index: 9999999;
        }

        .lista-associar-vaga {
            max-height: 500px;
            overflow-y: scroll;
        }
    </style>
@endpush