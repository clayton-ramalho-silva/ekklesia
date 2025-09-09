@extends('layouts.app')

@section('content')
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Entrevista</a></li>
          <li class="breadcrumb-item active" aria-current="page">Candidato: {{ $resume->informacoesPessoais->nome }}</li>
        </ol>
      </nav>

      {{--Componente Botão voltar --}}
      @php
          // Guarda a rota na variável
          $rota = route('interviews.index');
      @endphp

      <x-voltar :rota="$rota"/>
      {{--Componente Botão voltar --}}

</section>

{{-- Botões Ação --}}
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                @if (!$resume->interview)         
                    <!--<div class="box-entrevistar"> -->
                        <a href="{{ route('interviews.interviewResume', $resume) }}#form-interview"  class="link-entrevista d-flex align-items-center" >Iniciar Entrevista</a>       
                    <!--</div>-->   
                 @endif
            </div>
            <div class="col">
                 <!-- Button trigger modal -->
                <button type="button" class="btn-padrao btn-associar-vaga" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Associar a uma vaga
                </button>
                @include('components.modal-associar-vaga')
            </div>
            @if (Auth::user()->role === 'admin')
            <div class="col">

                <form action="{{ route('resumes.destroy', $resume) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-padrao btn-cancelar ms-3 d-flex align-items-center justify-content-center" 
                            onclick="return confirm('Tem certeza que deseja deletar este currículo? Esta ação não pode ser desfeita.')" 
                            id="delete-resume">
                        Deletar Currículo
                    </button>
                </form>

            </div>
            @endif
        </div>
    </div>

</section>

{{-- Fim Botões Ação --}}


{{-- Sessão Edição Currículo --}}
<section class="sessao">

    <article class="f1 container-form-create">

        <div class="container">

            <div class="row form-padrao">
                <div class="col-12 py-0 pe-5 form-1">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-between">
                            
                            {{-- Botão mudar status --}}
                            
                            <x-status-button :id="$resume->id" :status="$resume->status" />                                           
                            {{-- Fim Botão mudar status --}}               

                            
                        </div>
                        <div class="col-6">
                            <div class="col-12 bloco-ativo d-flex mb-3">

                                <p class="fw-bold">Currículo Cadastrado em: {{$resume->created_at->format('d/m/Y') }}</p>
                            </div>

                        </div>
                        
                    </div>
        
                   
                   
                </div>
                
                
                
            </div>
            
        </div>

    </article>

</section>

{{-- Fim Sessão Edição Currículo --}}

{{-- Entrevista --}}
<section class="sessao mt-5">

    <article class="f1">

        <div class="container">

            <form class="form-padrao" id="form-interview" action="{{ route('interviews.update', $interview)}}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Formulário Edição Currículo --}}                    
                <x-resume-edit-form 
                    :resume="$resume"
                    :editResume="false" 
                />
                {{-- Fim Formulário Edição Currículo --}}
                <div class="row mb-3 mt-3">
                <input type="hidden" name="resume_id" value="{{ $resume->id }}">

                <div class="row mb-3 mt-3">

                    <div class="col-12">
                        <h4>Entrevista</h4>
                    </div>

                    <div class="col-12 d-flex flex-wrap">

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Data Entrevista:</b> {{ $interview->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Hora Entrevista:</b> {{ $interview->created_at->format('H:i:s') }}
                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>                                
                                <b>Entrevistador:</b> 
                                {{ $interview->recruiter ? $interview->recruiter->name : Auth::user()->name }}
                            </p>
                        </div>

                    </div>

                </div>
                <div class="row mb-3 mt-3">

                    <!-- Inicio -->
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="outros_idiomas" class="label-floatlabel" class="form-label floatlabel-label">Fala outro idioma?</label>
                                <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" >{{ $interview->outros_idiomas }}</textarea>
                                @error('outros_idiomas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="apresentacao_pessoal" class="label-floatlabel" class="form-label floatlabel-label">Sobre sua apresentação pessoal (Tem piercing? Pode Tirar? Tatto?)</label>
                                <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" >{{ $interview->apresentacao_pessoal }}</textarea>
                                @error('apresentacao_pessoal') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="saude_candidato" class="label-floatlabel" class="form-label floatlabel-label">Sobre A Sua Saúde? (Saúde Física: Toma Medicação? / Faz Algum Tratamento? / Tem Alguma Restrição De Mobilidade? Alguma Cirurgia Realizada Ou À Realizar? – Saúde Mental: Faz Terapia? Já Fez? Toma Medicação?)</label>
                                <textarea class="form-control" id="saude_candidato" name="saude_candidato" style="padding-top: 43px !important" >{{ $interview->saude_candidato }}</textarea>
                                @error('saude_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>                            
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Vacina COVID</label>
                                <select name="vacina_covid" id="vacina_covid" class="form-select active-floatlabel altura-75" >
                                    <option></option>
                                    <option value="Não pretende tomar" {{ $interview->vacina_covid === 'Não pretende tomar' ? 'selected' : ''}}> Não pretende tomar</option>
                                    <option value="Pretende tomar" {{ $interview->vacina_covid === 'Pretende tomar' ? 'selected' : ''}}> Pretende tomar</option>
                                    <option value="1 dose" {{ $interview->vacina_covid === '1 dose' ? 'selected' : ''}}> 1 dose</option>
                                    <option value="2 doses" {{ $interview->vacina_covid === '2 doses' ? 'selected' : ''}}> 2 doses</option>
                                    <option value="3 doses" {{ $interview->vacina_covid === '3 doses' ? 'selected' : ''}}> 3 doses</option>
                                    <option value="4 doses" {{ $interview->vacina_covid === '4 doses' ? 'selected' : ''}}> 4 doses ou mais</option>
                                    <option value="Não tomou" {{ $interview->vacina_covid === 'Não tomou' ? 'selected' : ''}}> Não tomou</option>
                                </select>
                                @error('vacina_covid') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="ja_foi_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Já foi jovem aprendiz?</label>
                                <select name="ja_foi_jovem_aprendiz" id="ja_foi_jovem_aprendiz" class="form-select active-floatlabel altura-75" disabled>
                                    <option></option>
                                    <option value="Sim, da ASPPE" {{ $resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'selected' : ''}}> Sim, da ASPPE</option>
                                    <option value="Sim, de Outra Qualificadora" {{ $resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'selected' : ''}}> Sim, de Outra Qualificadora</option>
                                    <option value="Não" {{ $resume->foi_jovem_aprendiz === 'Não' ? 'selected' : ''}}> Não</option>                                    
                                </select>
                                @error('ja_foi_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-5 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel altura-75" id="qual_formadora" name="qual_formadora" placeholder="Qual a formadora?(Caso já tenha sido jovem aprendiz.)" value="{{ $interview->qual_formadora }}">
                            @error('qual_formadora') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="experiencia_profissional" class="label-floatlabel" class="form-label floatlabel-label">Experiência profissional (nome da empresa, tempo de empresa, motivo da saída, que atividades exercia)</label>
                                <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" >{{ $interview->experiencia_profissional }}</textarea>
                                @error('experiencia_profissional') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="qual_motivo_demissao" class="label-floatlabel" class="form-label floatlabel-label">Por qual motivo você pediria demissão?</label>
                                <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" >{{ $interview->qual_motivo_demissao }}</textarea>
                                @error('qual_motivo_demissao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="caracteristicas_positivas" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas características positivas?</label>
                                <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" >{{ $interview->caracteristicas_positivas    }}</textarea>
                                @error('caracteristicas_positivas') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="habilidades" class="label-floatlabel" class="form-label floatlabel-label">Quais são suas habilidades?</label>
                                <textarea class="form-control" id="habilidades" name="habilidades" >{{ $interview->habilidades }}</textarea>
                                @error('habilidades') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pontos_melhoria" class="label-floatlabel" class="form-label floatlabel-label">Um ponto de melhoria?</label>
                                <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" >{{ $interview->pontos_melhoria }}</textarea>
                                @error('pontos_melhoria') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sobre_candidato" class="label-floatlabel" class="form-label floatlabel-label">Fale um pouco sobre você.</label>
                                <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" >{{ $interview->sobre_candidato }}</textarea>
                                @error('sobre_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="rotina_candidato" class="label-floatlabel" class="form-label floatlabel-label">Qual sua rotina, me fale um pouco sobre você (hobbies, compromissos religosos, esportivos)</label>
                                <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" >{{ $interview->rotina_candidato }}</textarea>
                                @error('rotina_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="disponibilidade_horario" class="label-floatlabel" class="form-label floatlabel-label">Disponibilidade Para O Trabalho (Total, Horario Comercial, Disp Aos Finais De Semana?)</label>
                                <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" >{{ $interview->disponibilidade_horario }}</textarea>
                                @error('disponibilidade_horario') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="familia" class="label-floatlabel" class="form-label floatlabel-label">Me fale da sua famila (mora com quem? O que os pais fazem?)</label>
                                <textarea class="form-control" id="familia" name="familia" >{{ $interview->familia }}</textarea>
                                @error('familia') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel altura-75" id="renda_familiar" name="renda_familiar" placeholder="Qual a renda familiar da sua casa?"  value="{{ $interview->renda_familiar }}">
                            @error('renda_familiar') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-4 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Recebe algum benefício do governo?</label>
                                <select name="familia_cras" id="familia_cras" class="form-select active-floatlabel" >
                                    <option value="Sim" {{ $interview->familia_cras === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ $interview->familia_cras === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('familia_cras') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Campo de Tipo Benefcio -->
                    <div class="col-4 form-campo" id="tipoBeneficioContainer" >
                        <div class="mb-3">
                            <div class="floatlabel-wrapper">
                                <input type="text" class="floatlabel form-control altura-75" id="tipo_beneficio" name="tipo_beneficio" placeholder="Tipo Benefício: Bolsa Família, CRAS, CREAS." value="{{ $interview->tipo_beneficio }}" disabled>
                                @error('tipo_beneficio') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pretencao_candidato" class="label-floatlabel" class="form-label floatlabel-label">Pretenções do candidato</label>
                                <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" >{{ $interview->pretencao_candidato }}</textarea>
                                @error('pretencao_candidato') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="objetivo_longo_prazo" class="label-floatlabel" class="form-label floatlabel-label">Quais são seus objetivos profissionais para o futuro?</label>
                                <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" >{{ $interview->objetivo_longo_prazo }}</textarea>
                                @error('objetivo_longo_prazo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="curso_extracurricular" class="label-floatlabel" class="form-label floatlabel-label">Cursos Extracurriculares</label>
                                <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" >{{ $interview->curso_extracurricular }}</textarea>
                                @error('curso_extracurricular') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="porque_ser_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Porque gostaria de ser Jovem Aprendiz?</label>
                                <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" >{{ $interview->porque_ser_jovem_aprendiz    }}</textarea>
                                @error('porque_ser_jovem_aprendiz') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="fonte_curriculo" name="fonte_curriculo" placeholder="Fonte de Captação(Como soube da ASPPE?)"  value="{{ $interview->fonte_curriculo }}">
                            @error('fonte_curriculo') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Perfil Santa Casa?</label>
                                <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="Sim" {{ $interview->perfil_santa_casa === 'Sim' ? 'selected' : ''}}> Sim</option>
                                    <option value="Não" {{ $interview->perfil_santa_casa === 'Não' ? 'selected' : ''}}> Não</option>
                                </select>
                                @error('perfil_santa_casa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-3 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper ">
                                <label for="classificacao" class="label-floatlabel" class="form-label floatlabel-label">Classificação?</label>
                                <select name="classificacao" id="classificacao" class="form-select active-floatlabel" >
                                    <option></option>
                                    <option value="A" {{ $interview->classificacao === 'A' ? 'selected' : ''}}> A</option>
                                    <option value="B" {{ $interview->classificacao === 'B' ? 'selected' : ''}}> B</option>
                                    <option value="C" {{ $interview->classificacao === 'C' ? 'selected' : ''}}> C</option>
                                    <option value="D" {{ $interview->classificacao === 'D' ? 'selected' : ''}}> D</option>
                                </select>
                                @error('classificacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    
                    {{-- <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil" class="label-floatlabel" class="form-label floatlabel-label">Perfil</label>
                                <select name="perfil" id="perfil" class="form-select active-floatlabel" required>
                                    <option value="" selected disabled>Escolher</option>
                                    <option value="Administrativo" {{ strtolower($interview->perfil) === 'administrativo' ? 'selected' : ''}}> Administrativo</option>
                                    <option value="Operacional" {{ strtolower($interview->perfil) === 'operacional' ? 'selected' : ''}}> Operacional</option>
                                    <option value="Adm / Operacional" {{ strtolower($interview->perfil) === 'adm / operacional' ? 'selected' : ''}}> Adm / Operacional</option>
                                </select>
                                @error('perfil') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div> --}}

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Sugestão Empresa</label>
                                <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" >{{ $interview->sugestao_empresa }}</textarea>
                                @error('sugestao_empresa') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>                     --}}

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Parecer do RH</label>
                                <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador" placeholder="Parecer do Entrevistador">{{ $interview->parecer_recrutador }}</textarea>
                                @error('parecer_recrutador') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="observacoes" class="label-floatlabel" class="form-label floatlabel-label">Entrevistas</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" >{{ $interview->observacoes }}</textarea>
                                @error('observacoes') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="obs_rh" class="label-floatlabel" class="form-label floatlabel-label">Observações RH</label>
                                <textarea class="form-control" id="obs_rh" name="obs_rh" >{{ $interview->obs_rh }}</textarea>
                                @error('obs_rh') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="pontuacao" name="pontuacao" placeholder="Pontuação" required value="{{ $interview->pontuacao }}">
                            @error('pontuacao') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div> --}}

                    <!-- Fim -->  
                    

                    <div class="mt-3 bloco-submit">
                        <button type="submit" class="btn btn-primary btn-padrao btn-cadastrar">Atualizar</button>
                    </div>

                    <div class="col-8"></div>

                </div>

            </form>

        </div>

    </article>



</section>

{{-- Fim Entrevista --}}

<section class="sessao my-5">   

    {{-- Componente Tabela Vagas Associadas --}}
    <x-resume-jobs-table :resume="$resume" />

    {{-- Fim Componente Tabela Vagas Associadas --}}

   
    {{-- Componente Tabela Processos Seletivos --}}
    <x-resume-selections-table :resume="$resume" />
    {{-- Fim Componente Tabela Processos Seletivos --}}   
   
</section>




@endsection

@push('scripts-custom')
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

document.addEventListener("DOMContentLoaded", function () {

    // Upload Foto Candidato
    document.getElementById('foto_candidato').addEventListener('change', function(event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview_foto_candidato').src = e.target.result; // Atualiza a imagem
        };
        reader.readAsDataURL(file);

    });



    // Upload Curriculo
    document.getElementById('file-upload').addEventListener('change', function (event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        // Verifica se o arquivo é um PDF
        if (file.type !== "application/pdf") {
            alert("Por favor, selecione um arquivo PDF.");
            event.target.value = ""; // Limpa o campo
            return;
        }

        // Atualiza a prévia do documento
        document.getElementById("file-name").textContent = file.name;
        document.getElementById("file-download").href = URL.createObjectURL(file);
        document.getElementById("preview-doc").style.display = "block";
    });
});

$('#estado_civil').select2({
    placeholder: "Selecione",
});
$('#possui_filhos').select2({
    placeholder: "Selecione",
});
$('#sexo').select2({
    placeholder: "Selecione",
});
$('#cnh').select2({
    placeholder: "Selecione",
});
$('#tipo_cnh').select2({
    placeholder: "Selecione",
});
$('#vacina_covid').select2({
    placeholder: "Selecione",
});
$('#familia_cras').select2({
    placeholder: "Selecione",
});
$('#perfil').select2({
    placeholder: "Selecione",
});
$('#perfil_santa_casa').select2({
    placeholder: "Selecione",
});
$('#classificacao').select2({
    placeholder: "Selecione",
});

$('#nacionalidade').select2({
    placeholder: "Selecione",
});

$('#fundamental_select_periodo, #fundamental_select_modalidade, #medio_select_periodo, #medio_select_modalidade, #tecnico_select_periodo, #tecnico_select_modalidade, #superior_select_periodo, #superior_select_modalidade, #outro_select_periodo, #outro_select_modalidade ').select2({
    placeholder: "Selecione",
});

$('#rg').mask('00.000.000-A');
$('#cpf').mask('000.000.000-00');
$('#cep').mask('00000-000');
$('#telefone_celular').mask('(00) 00000-0000');
$('#telefone_residencial').mask(SPMaskBehavior, spOptions);

$('#cep').on('input', function(){

    var cep     = $(this).val(),
        digitos = cep.length;

    if(digitos === 9){

        $('.fa-spinner').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url : "{{ url('getCep') }}",
            data : {'cep': cep},
            type : 'POST',
            dataType : 'json',
            success : function(result){

                $('.fa-spinner').hide();

                if(result.msg === '1'){

                    $('#cidade').val(result.cidade);
                    $('#bairro').val(result.bairro);
                    $('#uf').val(result.uf);
                    $('#logradouro').val(result.rua);

                    setTimeout(function(){
                        $('.floatlabel').trigger('change');
                    }, 150)

                } else if(result.msg === '3'){

                    $.message('CEP enválido, por favor verifique o número informado', 2);

                } else {

                    $.message('CEP não encontrado, por favor verifique o número informado', 2);

                }

            }
        });

    }

});

$('#escolaridade3').on('click', function(){

    if($(this).is(':checked')){
        $('.check-escolaridade').slideDown(150);
        $('#escolaridade_outro').prop('disabled', false);
    } else {
        $('.check-escolaridade').slideUp(150);
        $('#escolaridade_outro').prop('disabled', true);
    }

});

$('#experiencia_profissional10').on('click', function(){

    console.dir('aaa');

    if($(this).is(':checked')){
        $('.check-experiencia').slideDown(150);
        $('#experiencia_profissional_outro').prop('disabled', false);
    } else {
        $('.check-experiencia').slideUp(150);
        $('#experiencia_profissional_outro').prop('disabled', true);
    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        // escolaridade:"required",
        // nome:"required",
        // email:"required",
        // rg:"required",
        // cpf:"required",
        // telefone_celular:"required",
        // telefone_residencial:"required",
        // nome_contato:"required",
        // data_nascimento:"required",
        // estado_civil:"required",
        // possui_filhos:"required",
        // sexo:"required",
        // cnh:"required",
        // cep:"required",
        // logradouro:"required",
        // numero:"required",
        // complemento:"required",
        // bairro:"required",
        // cidade:"required",
        // uf:"required",
        // informatica:"required",
        // ingles:"required",
        // tamanho_uniforme:"required",
    }
});

$("#form-interview").validate({
    ignore: [],
    rules:{
        // saude_candidato:"required",
        // vacina_covid:"required",
        // perfil:"required",
        // perfil_santa_casa:"required",
        // classificacao:"required",
        // qual_formadora:"required",
        // familia_cras:"required",
        // fonte_curriculo:"required",
        // pontuacao:"required",
    }
});

// Validação inicial
var validator1 = $( "#form-companies-create" ).validate();
validator1.form();

var validator2 = $( "#form-interview" ).validate();
validator2.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})

// Atualização de status
function updateStatus(newStatus) {
    const statusInput = document.getElementById('statusInput');
    
    // Se for mudar para inativo, pede confirmação especial
    if (newStatus === 'inativo') {
        if (!confirm("Se o currículo estiver associado a alguma vaga, será automaticamente desassociado. Deseja continuar?")) {
            return false; // Cancela se o usuário não confirmar
        }
    }
    
    // Atualiza o valor do campo hidden
    statusInput.value = newStatus;
    
    // Envia o formulário
    document.getElementById('statusForm').submit();
    
    return true;
}
</script>
@endpush

@push('css-custom')
<style>
/* Esconde o input original */
.file-input {
    display: none;
}

/* Estiliza o botão */
.file-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

/* Efeito hover */
.file-label:hover {
    background-color: #0056b3;
}

/* Estiliza o texto do nome do arquivo */
.file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}

/* Estiliza a prévia da imagem */
.preview-container {
    text-align: center;
    margin-top: 15px;
}

.preview-image {
    display: block;
    max-width: 200px;
    max-height: 200px;
    width: auto;
    height: auto;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.btn-select-file{
    cursor: pointer;
    height: 38px;
    padding: 12px 20px !important;
    background-color: gray;
}

.btn-select-file:hover{
    background-color: #a7a7a7;
}
        .btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}

.breadcrumb-item{
    font-size: 23px;
    font-weight: 500;
}

.breadcrumb-item a{

    color: grey !important;
}

.breadcrumb-item.active{
    color: #009cff !important;
}

.table-container.lista-processos-seletivos .col4,
.table-container.lista-processos-seletivos .col5{
    width: 10%;
}

.table-container.lista-processos-seletivos .col6{
    width: 5%;
}

/* #qual_formadora{
    padding-top: 45px !important;
} */

.bloco-submit{
    position: fixed;
    bottom: 0;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 3px 8px #c7c7c7;
    border-radius: 20px;
    z-index: 999999;
    width: 74%;
}

</style>
@endpush