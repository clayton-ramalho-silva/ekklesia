
    <!-- Vagas Associadas do candidato -->
    <article class="f1">

        <h4>Vagas Associadas a este Currículo</h4>        

        <div class="table-container lista-processos-seletivos">

            <ul class="tit-lista">
                <li class="w-30">Empresa</li>
                <li class="w-15">Título</li>
                <li class="w-10">Dt. Associação</li>
                <li class="w-15">Vagas</li>                
                <li class="w-10">Recrutador</li>
                <li class="w-10">Status</li>
                <li class="w-10">Ações</li>
            </ul>
            
            {{-- {{ dd($vagasAssociadas)}} --}}
            @if ($vagasAssociadas)            
                @foreach ($vagasAssociadas as $job)                  

                    <ul data-bs-toggle="modal" data-bs-target="#modal-selection-{{$job->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Processo Seletivo desta vaga">
                        <li class="w-30">
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
                        <li class="w-15">
                            <b>Título</b>
                            {{ $job->setor }}
                        </li>
                        <li class="w-10">
                            <b>Data Associação</b>
                            @if($job->pivot->created_at)
                                {{ $job->pivot->created_at->format('d/m/Y') }}
                            @else
                                <span class="text-muted">Não disponível</span>
                            @endif
                        </li>
                        <li class="w-15" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                        </li>                        
                        <li class="w-10">
                            <b>Recrutador</b>
                            @if (count($job->recruiters) <= 0)
                            Nenhum recrutador associado
                            @else
                            @foreach ($job->recruiters as $recruiter)
                            {{ $recruiter->name }}
                            @endforeach
                            @endif
                        </li>
                        <li class="w-10">
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
                        <li class="w-10">
                            
                            {{-- Componente Botão Desassociar Vaga --}}
                           <x-button-desassociar-vaga :resume="$resume" />                            
                           {{-- Componente Botão Desassociar Vaga --}}
                        </li>

                    </ul>

                    <!-- Modal -->
                    <div class="modal fade modal-vagas" id="modal-selection-{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4>Vaga - Nº {{ $job->id}}</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="table-container lista-info-vaga">

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
                                                        <b>Setor</b>
                                                        {{ $job->setor }}
                                                    </li>
                                                    <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                                                        <b>Vagas</b>
                                                        {{$job->filled_positions}} / {{ $job->qtd_vagas }}
                                                        @if ($job->filled_positions >= $job->qtd_vagas)
                                                            <span>Todas as vagas preenchidas, o candidato "Contratado" será encaminhado para fila de espera.</span>
                                                        @endif
                                                    </li>
                                                    <li class="col4">
                                                        <b>Recrutador</b>
                                                        @if (count($job->recruiters) <= 0)
                                                            Nenhum recrutador associado
                                                        @else
                                                            @foreach ($job->recruiters as $recruiter)
                                                            {{ $recruiter->name }}
                                                            @endforeach
                                                        @endif
                                                    </li>

                                                </ul>

                                            </div>

                                        </div>

                                        <div class="col-12">

                                            <h4>Processo Seletivo</h4>

                                            {{-- @if (!$selection) --}}

                                                <form class="form-padrao d-flex" action="{{ route('selections.storeSelection') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="job_id" value="{{$job->id}}">
                                                    <input type="hidden" name="resume_id" value="{{$resume->id}}">

                                                    <div class="col-6">

                                                        <div class="mb-3 col-12">

                                                            <div class="floatlabel-wrapper required">
                                                                <label for="status_selecao" class="label-floatlabel" class="form-label floatlabel-label">Status da Seleção</label>
                                                                <select name="status_selecao" id="status_selecao" class="form-select active-floatlabel" required>
                                                                    <option value="aguardando" selected> Aguardando</option>
                                                                    <option value="aprovado" > Contratado</option>
                                                                    <option value="reprovado" > Reprovado</option>
                                                                    <option value="desistente" > Desistente</option>
                                                                    <option value="cancelada" > Vaga Cancelada</option>
                                                                    {{-- <option value="Fila de Espera" > Fila de Espera</option> --}}
                                                                </select>
                                                                @error('status_selecao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                        <div class="col-12">

                                                            <div class="floatlabel-wrapper required col-12">
                                                                <label for="avaliacao" class="label-floatlabel" class="form-label floatlabel-label">Avaliação</label>
                                                                <select name="avaliacao" id="avaliacao" class="form-select active-floatlabel" required>                                                                    
                                                                    <option value="1" selected> Positiva</option>
                                                                    <option value="0" > Negativa</option>
                                                                </select>
                                                                @error('avaliacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="col-6">

                                                        <div class="floatlabel-wrapper form-textarea">
                                                            <label for="observacao" class="label-floatlabel" class="form-label floatlabel-label">Observação</label>
                                                            <textarea name="observacao" id="observacao" cols="30" rows="10" class="form-control"></textarea>
                                                            @error('observacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                                                        </div>

                                                    </div>

                                                    <div class="col-12 d-flex justify-content-center">

                                                        <button class="btn btn-primary btn-padrao btn-cadastrar" type="submit">Salvar</button>

                                                    </div>

                                                </form>                                            

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach
            @else
            <span class="sem-resultado">Candidato não associado a vagas ainda</span>
            @endif

        </div>

    </article>
    <!-- Fim Vagas Associadas do candidato -->


@push('css-custom')
    <style>
        .w-30{
            width: 30% !important;
        }
        .w-10{
            width: 10% !important;
        }
        .w-15{
            width: 15% !important;
        }
        .w-5{
            width: 5% !important;
        }
    </style>
@endpush